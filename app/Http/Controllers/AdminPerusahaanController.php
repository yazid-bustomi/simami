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
        //
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
            'password' => 'required',
        ], [
            'nama_depan.required' => 'Nama perusahaan harus di isi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email harus berupa email yang valid',
            'password.required' => 'Password harus di isi',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'nama_depan' => $request->nama_depan,
            'email' => $request->email,
            'role' => 'kampus',
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
        //
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
}
