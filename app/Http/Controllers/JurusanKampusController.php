<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJurusanKampusRequest;
use App\Http\Requests\UpdateJurusanKampusRequest;
use App\Models\AkademikProfile;
use App\Models\JurusanKampus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanKampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUser = Auth::user()->id;
        $jurusans = JurusanKampus::where('user_id', $idUser)->with('akademikProfile')->get();

        return view('admin_kampus.jurusan.index', compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin_kampus.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJurusanKampusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $jurusan = new JurusanKampus();
        $jurusan->user_id = $idUser;
        $jurusan->nama_jurusan = $request->nama_jurusan;
        $jurusan->save();

        return response()->json(['success' => 'Jurusan berhasil ditambahkan']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJurusanKampusRequest  $request
     * @param  \App\Models\JurusanKampus  $jurusanKampus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJurusanKampusRequest $request, $id)
    {
        $jurusan = JurusanKampus::findOrFail($id);
        $jurusan->nama_jurusan = $request->nama_jurusan;
        $jurusan->save();
        return response()->json(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JurusanKampus  $jurusanKampus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = JurusanKampus::findOrFail($id);
        $jurusan->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
