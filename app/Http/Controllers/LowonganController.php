<?php

namespace App\Http\Controllers;

use App\Helpers\TextHelper;
use App\Http\Requests\StoreLowonganRequest;
use App\Http\Requests\UpdateLowonganRequest;
use App\Models\Lowongan;
use App\Models\Pendaftar;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



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
        if (Auth::user()->role == 'mahasiswa') {
            $lowongans = Lowongan::all();


            foreach ($lowongans as $lowongan) {
                $lowongan->short_kriteria = TextHelper::truncateWords($lowongan->kriteria, 10);

                // untuk menghitung hari penutupan dan jika tutup di kasih tanggal close
                $dayRemaining = Carbon::now()->diffInDays($lowongan->close_lowongan, false);
                $lowongan->days_remaining = $dayRemaining;
            }
            return view('mahasiswa.magang.index', compact('lowongans'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLowonganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLowonganRequest $request)
    {
        //  dd($request->lowongan_id);

        $existingApprove = Pendaftar::where('user_id', $request->mahasiswa_id)
            ->where('lowongan_id', $request->lowongan_id)
            ->first();

            if($existingApprove){
                return redirect()->back()->with('error', 'Anda telah mendaftar pada lowongan ini, Silahkan cek status pendaftar');
            };

        $validator = Validator::make($request->all(), [
            'lowongan_id' => 'required|integer',
            'mahasiswa_id' => 'required|integer',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lowongan = new Pendaftar([
            'user_id' => $request->mahasiswa_id,
            'lowongan_id' => $request->lowongan_id,
            'status' => 'pending'
        ]);
        $lowongan->save();
        return redirect()->route('magang.show', $request->lowongan_id)->with('success', 'Berhasil Melamar Magang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lowongan = Lowongan::with('user', 'user.sosmed', 'user.alamat')->find($id);
        // Check if the lowongan exists
        if (!$lowongan) {
            return redirect()->route('magang.index')->withErrors(['error' => 'Lowongan tidak ditemukan.']);
        }

        // Calculate days remaining until close
        $dayRemaining = Carbon::now()->diffInDays($lowongan->close_lowongan, false);
        $lowongan->days_remaining = $dayRemaining;

        return view('mahasiswa.magang.show', compact('lowongan'));
    }

}
