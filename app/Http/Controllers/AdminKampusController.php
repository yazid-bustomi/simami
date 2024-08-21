<?php

namespace App\Http\Controllers;

use App\Models\AkademikProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminKampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kampuses = User::where('role', 'kampus')
            ->with('jurusanKampus', 'alamat', 'profile', 'adminKampus')
            ->get();


        // dd($kampuses->toArray());
        return view('admin.kampus.index', compact('kampuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kampus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_depan' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:8'
        ];

        $validated = Validator::make($request->all(), $rules, [
            'nama_depan.required' => 'Nama harus di isi',
            'email.required' => 'Email harus di isi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email harus berupa email valid',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        User::create([
            'nama_depan' => $request->nama_depan,
            'email' => $request->email,
            'role' => 'kampus',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('kampus.index')->with('success', 'Kampus berhasil di tambahkan');
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
        $kampuses = User::find($id);

        return view('admin.kampus.edit', compact('kampuses'));
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
        $users = User::find($id);

        if ($request->email !== $users->email) {

            $rules = [
                'nama_depan' => 'required',
                'email' => 'required|unique:users,email|email',
                'password' => 'min:8|required'
            ];

            $validated = Validator::make($request->all(), $rules, [
                'nama_depan.required' => 'Nama harus di isi',
                'email.required' => 'Email harus di isi',
                'email.unique' => 'Email sudah ada',
                'email.email' => 'Email harus berupa email valid',
                'password.required' => 'Password harus di isi',
                'password.min' => 'Password minimal 8 karakter'
            ]);

            if ($validated->fails()) {
                return redirect()->back()->withInput()->withErrors($validated);
            };
        }

        $users->nama_depan = $request->nama_depan;
        $users->email = $request->email;

        if ($request->password !== null) {
            $users->password = Hash::make($request->password);
        }

        $users->save();

        return redirect()->route('kampus.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::FindOrFail($id);
        $users->delete();

        return redirect()->route('kampus.index')->with('success', 'Data berhasil dihapus');
    }
}
