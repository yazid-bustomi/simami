<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companys = User::where('role', 'perusahaan')
            ->with('lowongan', 'lowongan.pendaftar', 'profile', 'sosmed', 'alamat')
            ->get();

        $dateNow = Carbon::today();
        return view('admin.perusahaan.index', compact('companys', 'dateNow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->toArray());

        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'email' => 'unique:users,email|email|required',
            'password' => 'required|min:8',
        ], [
            'nama_depan.required' => 'Nama perusahaan harus di isi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email harus berupa email yang valid',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'nama_depan' => $request->nama_depan,
            'email' => $request->email,
            'role' => 'perusahaan',
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil di tambahkan');
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
        $companys = User::find($id);
        return view('admin.perusahaan.edit', compact('companys'));
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
        //find user
        $company = User::FindOrFail($id);
        if($company->email !== $request->email){
            $rules = [
                'nama_depan' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:8'
            ];

            $message = [
                'nama_depan.required' => 'Nama harus di isi',
                'email.required' => 'Email harus di isi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harus di isi',
                'password.min' => 'Password minimal 8 karakter'
            ];

            $valited = Validator::make($request->all(), $rules, $message);

            if($valited->fails()){
                return redirect()->back()->withErrors($valited)->withInput();
            }
        }
        $company->nama_depan = $request->nama_depan;
        $company->email = $request->email;

        if($request->password != null){
            $company->password = Hash::make($request->password);
        }
        $company->save();

        return redirect()->route('perusahaan.index')->with('success', 'Data berhasil di update');
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
        $user = User::FindOrFail($id);
        $user->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Data berhasil di hapus');
    }
}
