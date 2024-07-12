<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Intervention\Image\Facades\Image;
use Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // untuk mendapatkan user id
        $idPt = Auth::user()->id;

        if (Auth::user()->role == 'perusahaan') {
            // menampilkan hanya yang di upload sendiri lowongannya
            $lowongans = Lowongan::with('pendaftar')->where('user_id', $idPt)->get();
            return view('admin_perusahaan.lowongan.index', compact('lowongans'));
        } else {
            // menampilkan semua data yang di upload oleh perusahaan
            $lowongans = Lowongan::with('pendaftar')->get();
            return view('admin_perusahaan.lowongan.index', compact('lowongans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_perusahaan.lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pemagang' => 'required|integer|min:1',
            'durasi_magang' => 'required|integer|min:1',
            'open_lowongan' => 'required|date|after_or_equal:today',
            'close_lowongan' => 'required|date|after:open_lowongan',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
        // ketika user tidak upload image lowongan
        $fileName = null;

        // Upload gambar jika ada
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = time() . '.' . $request->img->extension();
            $file->move(public_path('img/post'), $fileName);
            // Crop the image to fit 1080 x 720 using GD library
        }

        $lowongans = new Lowongan([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'pemagang' => $request->pemagang,
            'durasi_magang' => $request->durasi_magang,
            'open_lowongan' => $request->open_lowongan,
            'close_lowongan' => $request->close_lowongan,
            'img' => $fileName,
        ]);
        $lowongans->save();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan magang berhasil di tambahkan.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dashboard()
    {
        return view('admin_perusahaan.dashboard');
    }

    public function profile()
    {
        return view('admin_perusahaan.profile');
    }

}
