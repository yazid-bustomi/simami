<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Intervention\Image\Facades\Image;
use Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\fileExists;

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
        // cek validasi create lowongan
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kriteria' => 'required|string',
            'rincian' => 'required|string',
            'pemagang' => 'required|integer|min:1',
            'durasi_magang' => 'required|integer|min:1',
            'open_lowongan' => 'required|date|after_or_equal:today',
            'close_lowongan' => 'required|date|after:open_lowongan',
            'img' => 'image|mimes:jpeg,png,jpg|max:10120',
        ]);

        // jika validasi gagal tampilkan error ini
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
        }

        // simpan data
        $lowongans = new Lowongan([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'kriteria' => $request->kriteria,
            'rincian' => $request->rincian,
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
        $lowongan = Lowongan::find($id);
        return view('admin_perusahaan.lowongan.edit', compact('lowongan'));
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
        $lowongan = Lowongan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kriteria' => 'required|string',
            'rincian' => 'required|string',
            'pemagang' => 'required|integer|min:1',
            'durasi_magang' => 'required|integer|min:1',
            'open_lowongan' => 'required|date|after_or_equal:today',
            'close_lowongan' => 'required|date|after:open_lowongan',
            'img' => 'image|mimes:jpeg,png,jpg,|max:10120',
        ]);

        // mengecek apakah ada file yang di upload
        if($request->hasFile('img')){
            $filePath = public_path('/img/post/' . $lowongan->img);
            // jika file sebelumnya ada maka di hapus dahulu, jika tidak langsung di tambahkan
            // mengecek apakah link img di database dan  file di folder ada maka di hapus dulu
            if($lowongan->img && fileExists($filePath) ){
                unlink($filePath);
            };
            // memberi nama dengan date sekarang dan mendapatkan ekstensi filenya sekalian
            $fileName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('/img/post/'), $fileName);
            $lowongan->img = $fileName;
        };

        $lowongan->judul = $request->input('judul');
        $lowongan->kriteria = $request->input('kriteria');
        $lowongan->rincian = $request->input('rincian');
        $lowongan->pemagang = $request->input('pemagang');
        $lowongan->durasi_magang = $request->input('durasi_magang');
        $lowongan->open_lowongan = $request->input('open_lowongan');
        $lowongan->close_lowongan = $request->input('close_lowongan');

        $lowongan->save();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lowongan = Lowongan::find($id);
        if ($lowongan) {
            $filePath = public_path('/img/post/' . $lowongan->img);
            if($filePath && $lowongan->img){
                unlink($filePath);
            }
            $lowongan->delete();
            return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil di hapus');
        }
    }

    public function dashboard()
    {
        // untuk mendapatkan user id
        $idPt = Auth::user()->id;
        $magang = Lowongan::where('user_id', $idPt);
        return view('admin_perusahaan.dashboard', compact('magang'));
    }

    public function profile()
    {
        return view('admin_perusahaan.profile');
    }
}
