<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendaftarRequest;
use App\Http\Requests\UpdatePendaftarRequest;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;

class PendaftarController extends Controller
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
            $pendaftars = Pendaftar::with(['lowongan', 'user', 'user.mahasiswaProfile', 'user.akademikProfile', 'user.akademikProfile.jurusanKampus', 'user.akademikProfile.adminKampus', 'user.alamat'])
            ->whereHas('user.akademikProfile', function ($query) use ($idUser){
                $query->where('admin_kampus_id', $idUser);
            })
            ->get();

            // dd($pendaftars->toArray());
            return view('mahasiswa.pendaftar.index', compact('pendaftars'));

        } else {
        }

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
     * @param  \App\Http\Requests\StorePendaftarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePendaftarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePendaftarRequest  $request
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePendaftarRequest $request, Pendaftar $pendaftar)
    {
        // update status pendaftar lowongan
        $request ->validate([
            'status' => 'required|in:select,rejected'
        ]);

        $pendaftar = Pendaftar::findOrFile($pendaftar);

        dd($pendaftar);
        // Update status
        $pendaftar->status = $request->input('status');
        $pendaftar->save();

        // Redirect atau berikan respon sesuai kebutuhan
        return redirect()->route('pendaftar.index')->with('success', 'Status berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftar $pendaftar)
    {
        //
    }
}
