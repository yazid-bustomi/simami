<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\MahasiswaProfile;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // menampilkan view admin
        $users = User::with(['alamat', 'jurusanKampus', 'sosmed', 'akademikProfile',])->get();
        // dd($user->toArray());
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::with('sosmed', 'alamat', 'profile')->findOrFail($id);

        if ($request->email != $user->email) {
            $rules = [
                'email' => 'unique:users,email|email'
            ];
            $validated = Validator::make($request->all(), $rules, [
                'email.unique' => 'Email sudah ada',
                'email.email' => 'Email harus berupa email valid',
            ]);
            if ($validated->fails()) {
                return redirect()->back()->withErrors($validated)->withInput();
            }
        }

        $user->nama_depan = $request->nama_depan;
        $user->email = $request->email;
        $user->save();

        if ($user->profile) {
            $user->profile->no_hp = $request->no_hp;
            $user->profile->save();
        } else {
            MahasiswaProfile::create([
                'user_id' => $id,
                'no_hp' => $request->no_hp,
            ]);
        }

        if (!$user->alamat) {
            Alamat::create([
                'user_id' => $id,
                'provinsi' => $request->provinsi,
                'kab_kot' => $request->kab_kot,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'alamat' => $request->alamat,
                'kode_pos' => $request->kode_pos,
            ]);
        } else {
            $user->alamat->provinsi = $request->provinsi;
            $user->alamat->kab_kot = $request->kab_kot;
            $user->alamat->kecamatan = $request->kecamatan;
            $user->alamat->desa = $request->desa;
            $user->alamat->alamat = $request->alamat;
            $user->alamat->kode_pos = $request->kode_pos;
            $user->alamat->save();
        }

        if (!$user->sosmed) {
            Sosmed::create([
                'user_id' => $id,
                'linkedin' => $request->linkedin,
                'twiter' => $request->twiter,
                'website' => $request->website,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'tiktok' => $request->tiktok,
            ]);
        } else {
            $user->sosmed->linkedin = $request->linkedin;
            $user->sosmed->twiter = $request->twiter;
            $user->sosmed->website = $request->website;
            $user->sosmed->instagram = $request->instagram;
            $user->sosmed->facebook = $request->facebook;
            $user->sosmed->tiktok = $request->tiktok;
            $user->sosmed->save();
        }

        return redirect()->route('admin.profile')->with('success', 'Profile berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $userId = Auth::user()->id;

        $users = User::where('id', $userId)
            ->with('alamat', 'sosmed', 'profile', 'akademikProfile')
            ->get();

        foreach ($users as $user) {
            $user;
        }
        return view('admin.profile', compact('user'));
    }

    public function updateImage(Request $request, $id)
    {
        $user = User::with('profile')->findOrFail($id);

        $rules = [
            'img' => 'image|mimes:png,jpg,jpeg|max:1020'
        ];
        $validated = Validator::make($request->all(), $rules, [
            'img.image' => 'foto harus berupa image jpg / png',
            'img.max' => 'File maximal 10Mb'
        ]);
        if($validated->fails()){
            return redirect()->back()->withErrors($validated);
        }

        if($request->hasFile('img')){
            $file = $request->file('img');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $request->img->move(public_path('/img/profile/'), $fileName);

            if ($user->profile != null) {
                // untuk mendapatkan file di folder
                $filePath = public_path('/img/profile/' . $user->profile->img);

                // mengecek apakah link img di database dan  file di folder ada maka di hapus dulu
                if ($user->profile->img && $filePath) {
                    unlink($filePath);
                }
                $user->profile->img = $fileName;
                $user->profile->save();
            }
            MahasiswaProfile::create([
                'user_id' => $id,
                'img' => $fileName,
            ]);
        }
        return redirect()->route('admin.profile')->with('profileSuccess', 'Foto profile berhasil di update');
    }
}
