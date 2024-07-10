<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLowonganRequest;
use App\Http\Requests\UpdateLowonganRequest;
use App\Models\Lowongan;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mendapatkan user id dari admin kampus hanya bisa melihat mahasiswanya
        $idUser = Auth::user()->id;
        if (Auth::user()->role == 'perusahaan') {
            $pendaftars = Pendaftar::with(['lowongan', 'user', 'user.mahasiswaProfile', 'user.akademikProfile', 'user.akademikProfile.jurusanKampus', 'user.akademikProfile.adminKampus', 'user.alamat'])
            ->whereHas('lowongan', function ($query) use ($idUser){
                $query->where('user_id', $idUser);
            })
            ->get();

            // dd($pendaftars->toArray());
            return view('mahasiswa.pendaftar.index', compact('pendaftars'));

        } elseif (Auth::user()->role == 'kampus') {

        } else {
        }

        // $pendaftars = Pendaftar::with(['lowongan', 'user', 'user.mahasiswaProfile', 'user.akademikProfile', 'user.akademikProfile.jurusanKampus', 'user.akademikProfile.adminKampus', 'user.alamat'])->get();
        // dd($idUser);
        // return view('mahasiswa.pendaftar.index', compact('pendaftars'));
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
     * @param  \App\Http\Requests\StoreLowonganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLowonganRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function show(Lowongan $lowongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function edit(Lowongan $lowongan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLowonganRequest  $request
     * @param  \App\Models\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLowonganRequest $request, Lowongan $lowongan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lowongan $lowongan)
    {
        //
    }
}
