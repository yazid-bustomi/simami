<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJurusanKampusRequest;
use App\Http\Requests\UpdateJurusanKampusRequest;
use App\Models\AkademikProfile;
use App\Models\JurusanKampus;
use App\Models\User;
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
    public function store(StoreJurusanKampusRequest $request)
    {
        $request->validate([
            'jurusan' => 'required|string|max:255',
        ]);

        $idUser = Auth::user()->id;
        JurusanKampus::create([
            'user_id' => $idUser,
            'nama_jurusan' => $request->jurusan,
        ]);
        return redirect()->route('jurusan.index')->with('success', 'Berhasil menambahkan jurusan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JurusanKampus  $jurusanKampus
     * @return \Illuminate\Http\Response
     */
    public function show(JurusanKampus $jurusanKampus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JurusanKampus  $jurusanKampus
     * @return \Illuminate\Http\Response
     */
    public function edit(JurusanKampus $jurusanKampus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJurusanKampusRequest  $request
     * @param  \App\Models\JurusanKampus  $jurusanKampus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJurusanKampusRequest $request, JurusanKampus $jurusanKampus)
    {

        $jurusan = JurusanKampus::findOrFail($jurusanKampus);
        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);
        return response()->json(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JurusanKampus  $jurusanKampus
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurusanKampus $jurusanKampus)
    {
        dd($jurusanKampus->toArray());
    }
}
