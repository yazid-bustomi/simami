<?php

namespace App\Http\Controllers;

use App\Models\AkademikProfile;
use App\Models\JurusanKampus;
use App\Models\MahasiswaProfile;
use App\Models\Pendaftar;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\fileExists;

class KampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Memanggil user id admin untuk di tampilkan
        $admin_kampus_id = Auth::user()->id;

        // menampilkan semua data mahasiswa hanya yang menjadi user mahasiswanya sesuai id admin
        $users = User::with(['alamat', 'jurusanKampus', 'sosmed', 'akademikProfile.jurusanKampus', 'mahasiswaProfile'])
            ->whereHas('akademikProfile', function ($query) use ($admin_kampus_id) {
                $query->where('admin_kampus_id', $admin_kampus_id);
            })
            ->get();
        // dd($admin);
        return view('admin_kampus.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $jurusan = JurusanKampus::where('user_id', $id)->get();
        return view('admin_kampus.users.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|string|min:3',
            'nama_belakang' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'jurusan' => 'required|integer',
            'nim' => 'required|integer',
            'password' => 'required|min:8', // Ensure password is at least 8 characters
        ], [
            'nama_depan.required' => 'Nama depan wajib diisi.',
            'nama_depan.string' => 'Nama depan harus berupa string.',
            'nama_depan.min' => 'Nama depan harus memiliki minimal 3 karakter.',
            'nama_belakang.string' => 'Nama belakang harus berupa string.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nim.required' => 'Nim Harus di isi',
            'nim.integer' => 'Nim tidak boleh diawali dari 0 atau minus',
            'jurusan.required' => 'Jurusan Harus di isi',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa'
        ]);

        AkademikProfile::create([
            'user_id' => $user->id,
            'admin_kampus_id' => Auth::user()->id,
            'nim' => $request->nim,
            'jurusan_id' => $request->jurusan,
        ]);
        return redirect()->route('user.index')->with('success', 'Mahasiswa berhasil di tambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhs = User::with(['akademikProfile'])->find($id); // Retrieve the user by primary key

        $adminId = Auth::user()->id;
        $jurusan = JurusanKampus::where('user_id', $adminId)->get();

        if (is_null($mhs)) {
            return redirect()->route('admin_kampus.users.index')->with('error', 'User not found.');
        }

        return view('admin_kampus.users.edit', compact('mhs', 'jurusan'));
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
        $mhs = User::with('akademikProfile')->findOrFail($id);

        // jika ada perubahan email maka harus di rubah dan verifikasi
        if ($request->email !== $mhs->email) {
            $validator = Validator::make($request->all(), [
                'nama_depan' => 'required|string|min:3',
                'nama_belakang' => 'nullable|string',
                'jurusan' => 'integer|nullable',
                'email' => 'required|email|unique:users,email',
                'nim' => 'integer|nullable',
                'password' => 'min:8', // Ensure password is at least 8 characters
            ], [
                'nama_depan.required' => 'Nama depan wajib diisi.',
                'nama_depan.string' => 'Nama depan harus berupa string.',
                'nama_depan.min' => 'Nama depan harus memiliki minimal 3 karakter.',
                'nama_belakang.string' => 'Nama belakang harus berupa string.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Email harus berupa alamat email yang valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'nim.required' => 'Nim Harus di isi',
                'nim.integer' => 'Nim tidak boleh diawali dari 0 atau minus',
                'jurusan.required' => 'Nim Harus di isi',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password harus memiliki minimal 8 karakter.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        if ($request->nama_depan == null) {
            return redirect()->back()->withErrors(['nama_depan' => 'Nama depan harus di isi'])->withInput();
        }
        $mhs->nama_depan = $request->nama_depan;
        $mhs->email = $request->email;
        $mhs->nama_belakang = $request->nama_belakang;
        $mhs->akademikProfile->nim = $request->nim;

        // jika ada password maka di perbarui, jika tidak ada maka di lompati aja
        if ($request->password != null) {
            $mhs->password = Hash::make($request->password);
        }
        // jika jurusan di perbarui, jika tidak maka tetap dari pembuatan pertama
        if ($request->jurusan != null) {
            $mhs->akademikProfile->jurusan_id = $request->jurusan;
        }

        $mhs->akademikProfile->save();
        $mhs->save();
        return redirect()->route('user.index')->with('success', 'Mahasiswa berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhs = User::findOrFail($id);
        $mhs->delete();
        return redirect()->route('user.index')->with('success', 'Mahasiswa Berhasil di hapus');
    }

    public function dashboard()
    {
        return view('admin_kampus.dashboard');
    }

    public function profile()
    {
        $idUser = Auth::user()->id;
        $kampus = User::with('jurusanKampus', 'alamat', 'sosmed', 'mahasiswaProfile')->findOrFail($idUser);
        $countApprove = 0;

        // mencari semua mahasiswa dan di hitung jumlahnya
        $allMahasiswa = AkademikProfile::where('admin_kampus_id', $idUser)->get()->count();

        // mencari dari akademik profile yang admin kampus id nya sama dengan id user sekarang dan dipilih semua user pendaftar
        $approved = User::whereHas('akademikProfile', function ($query) use ($idUser){
            $query->where('admin_kampus_id', $idUser);
        })->with('pendaftar')->get();

        foreach ($approved as $approve){
            foreach($approve->pendaftar as $data){
                if($data->status == 'select'){
                    $countApprove++;
                }
            }
        }


        return view('admin_kampus.profile', compact('kampus', 'allMahasiswa', 'approved', 'countApprove'));
    }


    public function profileUpdate(Request $request, $id)
    {
        $user = User::with('jurusanKampus', 'alamat', 'sosmed', 'mahasiswaProfile')->findOrFail($id);

        if ($request->email !== $user->email) {
            $validated = Validator::make($request->all(), [
                'email' => 'unique:users,email',
            ]);

            if ($validated->fails()) {
                return redirect()->back()->withErrors(['email' => 'Email sudah ada'])->withInput();
            }

        }
        $user->nama_depan = $request->nama_depan;
        $user->email = $request->email;
        $user->save();

        $user->alamat->provinsi = $request->provinsi;
        $user->alamat->kab_kot = $request->kab_kot;
        $user->alamat->kecamatan = $request->kecamatan;
        $user->alamat->desa = $request->desa;
        $user->alamat->kode_pos = $request->kode_pos;
        $user->alamat->alamat = $request->alamat;
        $user->alamat->save();

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

            if (!$user->mahasiswaProfile){
                MahasiswaProfile::create([
                    'user_id' => $id,
                    'no_hp' => $request->no_hp,
                ]);
            }else {
                $user->mahasiswaProfile->no_hp = $request->no_hp;
                $user->mahasiswaProfile->save();
            }

        return redirect()->route('kampus.profile')->with('success', 'Data berhasil di update');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::with('mahasiswaProfile')->findOrFail($id);
        $validated = Validator::make($request->all(),[
            'img' => 'required|image|mimes:png,jpg|max:1024',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput();
        }
        $file = $request->file('img');
        $fileName = time() . '_' . $file->getClientOriginalName();

        if(!$user->mahasiswaProfile){
            MahasiswaProfile::make([
                'user_id' => $id,
                'img' => $fileName,
            ]);

            $file->move(public_path('/img/profile/'), $fileName);

        } else {
            $filePath = public_path('/img/profile/' . $fileName);

            if($user->mahasiswaProfile->img && fileExists($filePath)){
                $removeFile = public_path('/img/profile/') . $user->mahasiswaProfile->img;
                unlink($removeFile);
            }

            $file->move(public_path('/img/profile/'), $fileName);
            $user->mahasiswaProfile->img = $fileName;
            $user->mahasiswaProfile->save();
        }

        return redirect()->back()->with('updateFoto', 'Foto Profile Berhasil di Update');
    }
}
