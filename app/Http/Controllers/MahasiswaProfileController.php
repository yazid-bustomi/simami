<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaProfileRequest;
use App\Http\Requests\UpdateMahasiswaProfileRequest;
use App\Models\AkademikProfile;
use App\Models\MahasiswaProfile;
use App\Models\Pendaftar;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MahasiswaProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $idUser = Auth::user()->id;
        $mahasiswas = User::with(['akademikProfile', 'mahasiswaProfile', 'alamat', 'sosmed', 'akademikProfile.adminKampus', 'akademikProfile.jurusanKampus'])
            ->where('id', $idUser)
            ->get();

        foreach ($mahasiswas as $mahasiswa){
            $tanggalLahir = $mahasiswa->mahasiswaProfile->tanggal_lahir;
            $mahasiswa;
        }


        return view('mahasiswa.profile', compact('mahasiswa'));
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
     * @param  \App\Http\Requests\StoreMahasiswaProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMahasiswaProfileRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MahasiswaProfile  $mahasiswaProfile
     * @return \Illuminate\Http\Response
     */
    public function show(MahasiswaProfile $mahasiswaProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MahasiswaProfile  $mahasiswaProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(MahasiswaProfile $mahasiswaProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMahasiswaProfileRequest  $request
     * @param  \App\Models\MahasiswaProfile  $mahasiswaProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswaProfileRequest $request, $id)
    {
        // mencari user di database sesuai dengan id nya yang mau di update untuk di verifikasi email dan nomer hp
        $user = User::with('mahasiswaProfile', 'akademikProfile', 'alamat', 'sosmed')->findOrFail($id);

        // mencari nim yang sama dengan satu kampus
        $nimExists = DB::table('akademik_profiles')
            // memfilter data yang di berikan dari request
            ->where('nim', $request->nim)
            // memfilter dari admin kampus apakah ada yang sama dalam satu kampus nim tersebut
            ->where('admin_kampus_id', $user->akademikProfile->admin_kampus_id)
            // nim tidak cocok dengan user lain dalam satu kampus
            ->where('user_id', '!=', $id)
            ->exists();

        // jika email di update / tidak sama dengan user awal maka di validate apakah di dalam database ada yang sama
        if ($request->email !== $user->email) {
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:users,email',
            ]);

            // jika nimExists bernilai true maka ada yang sama dalam satu kampus
            if ($nimExists) {
                $validate->after(function ($validator) {
                    $validator->errors()->add('nim', 'NIM sama dengan user lain');
                });
            }

            // jika error maka kembalikan errornya dan berikan pesan
            if ($validate->fails()) {
                return back()->withErrors($validate)->withInput();
            }
        }

        // update user basic
        $user->nama_depan = $request->nama_depan;
        $user->nama_belakang = $request->nama_belakang;
        $user->email = $request->email;
        $user->save();


        // update akademik profile
        $user->akademikProfile->nim = $request->nim;
        $user->akademikProfile->save();

        // update mahasiswa profile
        $user->mahasiswaProfile->jenis_kelamin = $request->jenis_kelamin;
        $user->mahasiswaProfile->agama = $request->agama;
        $user->mahasiswaProfile->tempat_lahir = $request->tempat_lahir;
        $user->mahasiswaProfile->tanggal_lahir = $request->tanggal_lahir;
        $user->mahasiswaProfile->no_hp = $request->no_hp;
        $user->mahasiswaProfile->save();

        // update alamat
        $user->alamat->provinsi = $request->provinsi;
        $user->alamat->kab_kot = $request->kab_kot;
        $user->alamat->desa = $request->desa;
        $user->alamat->alamat = $request->alamat;
        $user->alamat->kode_pos = $request->kode_pos;
        $user->alamat->save();

        // jika sosmed masih kosong maka di create terlebih dahulu
        if (!$user->sosmed) {
            Sosmed::create([
                'user_id' => $user->id,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'twiter' => $request->twiter,
                'website' => $request->website,
                'facebook' => $request->facebook,
                'tiktok' => $request->tiktok,
            ]);
        } else {
            // update sosmed
            $sosmed = $user->sosmed;
            $sosmed->instagram = $request->instagram;
            $sosmed->linkedin = $request->linkedin;
            $sosmed->twiter = $request->twiter;
            $sosmed->website = $request->website;
            $sosmed->facebook = $request->facebook;
            $sosmed->tiktok = $request->tiktok;
            $sosmed->save();
        }
        // redirect to profile and message success
        return redirect()->route('profile.index')->with('success', 'Profile berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MahasiswaProfile  $mahasiswaProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(MahasiswaProfile $mahasiswaProfile)
    {
        //
    }

    public function profile(Request $request, $id)
    {
        $user = User::with('mahasiswaProfile')->findOrFail($id);

        // dd($user->toArray());

        $request->validate([
            'img' => 'image|mimes:png,jpg,jpeg|max:1020',
        ]);

        if($request->hasFile('img')){
            // untuk mendapatkan file di folder
            $filePath = public_path('/img/profile/' . $user->mahasiswaProfile->img);

            // mengecek apakah link img di database dan  file di folder ada maka di hapus dulu
            if($user->mahasiswaProfile->img && $filePath){
                unlink($filePath);
            }
            // memberi nama dengan date sekarang dan mendapatkan ekstensi filenya sekalian
            $fileName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('/img/profile/'), $fileName);


            $user->mahasiswaProfile->img = $fileName;
            $user->mahasiswaProfile->save();
        }
        return redirect()->route('profile.index')->with('success', 'Foto Profile Berhasil di Update');
    }


    public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function status()
    {
        $idUser = Auth::user()->id;
        // dd($idUser);
        $approve = Pendaftar::where('mahasiswa_id', $idUser)
            ->with([
                'lowongan',
                'user.akademikProfile',
                'user.mahasiswaProfile',
                'user.akademikProfile.adminKampus',
                'user.akademikProfile.jurusanKampus'
            ])->get();
        return view('mahasiswa.magang.status', compact('approve'));
    }
}
