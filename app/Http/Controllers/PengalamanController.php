<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengalamanRequest;
use App\Http\Requests\UpdatePengalamanRequest;
use App\Models\Pengalaman;

class PengalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('mahasiswa.pengalaman.index');
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
     * @param  \App\Http\Requests\StorePengalamanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengalamanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengalaman $pengalaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengalaman $pengalaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengalamanRequest  $request
     * @param  \App\Models\Pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengalamanRequest $request, Pengalaman $pengalaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengalaman $pengalaman)
    {
        //
    }
}
