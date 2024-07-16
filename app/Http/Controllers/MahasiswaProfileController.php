<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaProfileRequest;
use App\Http\Requests\UpdateMahasiswaProfileRequest;
use App\Models\AkademikProfile;
use App\Models\MahasiswaProfile;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        //
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
    public function update(UpdateMahasiswaProfileRequest $request, MahasiswaProfile $mahasiswaProfile)
    {
        //
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

    public function profile()
    {
        $idUser = Auth::user()->id;
        $mahasiswas = User::with(['akademikProfile', 'mahasiswaProfile', 'alamat', 'sosmed'])
        ->where('id', $idUser)
        ->get();

        return view('mahasiswa.profile');
    }
    public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function status() {
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
