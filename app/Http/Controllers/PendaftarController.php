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
        // mendapatkan user id
        $idUser = Auth::user()->id;

        // untuk role perusahaan mengambil data sesuai dengan id user perusahaan
        if (Auth::user()->role == 'perusahaan') {
            $pendaftars = Pendaftar::with(['lowongan', 'user', 'user.akademikProfile', 'user.akademikProfile.jurusanKampus', 'user.akademikProfile.adminKampus', 'user.alamat', 'user.profile'])
            ->whereHas('lowongan', function ($query) use ($idUser){
                $query->where('user_id', $idUser);
            })->get();
            return view('mahasiswa.pendaftar.index', compact('pendaftars'));

            // untuk role kampus mengambil data sesuai id by admin kampus
        } elseif (Auth::user()->role == 'kampus') {
            $pendaftars = Pendaftar::with(['lowongan', 'user', 'user.profile', 'user.akademikProfile', 'user.akademikProfile.jurusanKampus', 'user.akademikProfile.adminKampus', 'user.alamat'])
            ->whereHas('user.akademikProfile', function ($query) use ($idUser){
                $query->where('admin_kampus_id', $idUser);
            })
            ->get();
            return view('mahasiswa.pendaftar.index', compact('pendaftars'));

            // untuk role mahasiswa menampilkan semua lowongan magang
        } elseif(Auth::user()->role == 'mahasiswa') {
            $pendaftars = Pendaftar::with(['lowongan', 'user', 'user.profile', 'user.akademikProfile', 'user.akademikProfile.jurusanKampus', 'user.akademikProfile.adminKampus', 'user.alamat'])
            ->get();
            return view('mahasiswa.pendaftar.index', compact('pendaftars'));

        } else // untuk role admin masih belum
        {

        }
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
        $request ->validate([
            'status' => 'required|in:approve,select,rejected_kampus,rejected_perusahaan'
        ]);

        $pendaftar = Pendaftar::findOrFail($pendaftar->id);

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
