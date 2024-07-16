<?php

namespace App\Http\Controllers;

use App\Models\AkademikProfile;
use App\Models\JurusanKampus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        ->whereHas('akademikProfile', function ($query) use ($admin_kampus_id){
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
            'jurusan.required' => 'Nim Harus di isi',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
        ]);

       if ($validator->fails()){
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

        if ($request->email !== $mhs->email){
            $validator = Validator::make($request->all(), [
                'nama_depan' => 'required|string|min:3',
                'nama_belakang' => 'nullable|string',
                'jurusan' => 'required|integer',
                'email' => 'required|email|unique:users,email',
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
                'jurusan.required' => 'Nim Harus di isi',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password harus memiliki minimal 8 karakter.',
            ]);

            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $mhs->nama_depan = $request->nama_depan;
        $mhs->nama_belakang = $request->nama_belakang;
        $mhs->email = $request->email;
        $mhs->password = Hash::make($request->password);
        $mhs->akademikProfile->jurusan_id = $request->jurusan;

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
        return view('admin_kampus.profile');
    }

}
