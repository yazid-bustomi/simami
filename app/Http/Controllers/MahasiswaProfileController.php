<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaProfileRequest;
use App\Http\Requests\UpdateMahasiswaProfileRequest;
use App\Models\MahasiswaProfile;

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
}
