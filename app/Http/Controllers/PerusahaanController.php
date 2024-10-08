<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Lowongan;
use App\Models\MahasiswaProfile;
use App\Models\Pendaftar;
use App\Models\Sosmed;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
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
        $dateNow = Carbon::today();

        if (Auth::user()->role == 'perusahaan') {
            // menampilkan hanya yang di upload sendiri lowongannya
            $lowongans = Lowongan::with('pendaftar')->where('user_id', $idPt)->get();
            return view('admin_perusahaan.lowongan.index', compact('lowongans'));
        } else {
            // menampilkan semua data yang di upload oleh perusahaan
            $lowongans = Lowongan::with('pendaftar', 'user')->get();
            return view('admin_perusahaan.lowongan.index', compact('lowongans', 'dateNow'));
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
            'close_lowongan' => 'required|date|after_or_equal:today',
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

        $dateNow = Carbon::today();


        // simpan data
        $lowongans = new Lowongan([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'kriteria' => $request->kriteria,
            'rincian' => $request->rincian,
            'pemagang' => $request->pemagang,
            'durasi_magang' => $request->durasi_magang,
            'open_lowongan' => $dateNow,
            'close_lowongan' => $request->close_lowongan,
            'img' => $fileName,
        ]);
        $lowongans->save();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan magang berhasil di tambahkan.');
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
            'close_lowongan' => 'required|date|after:open_lowongan',
            'img' => 'image|mimes:jpeg,png,jpg,|max:10120',
        ]);

        // mengecek apakah ada file yang di upload
        if ($request->hasFile('img')) {
            $filePath = public_path('/img/post/' . $lowongan->img);
            // jika file sebelumnya ada maka di hapus dahulu, jika tidak langsung di tambahkan
            // mengecek apakah link img di database dan  file di folder ada maka di hapus dulu
            if ($lowongan->img && fileExists($filePath)) {
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
            if ($filePath && $lowongan->img) {
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
        $dateNow = Carbon::today();

        // query semua lowongan
        $openLowongan = Lowongan::where('user_id', $idPt)->where('close_lowongan', '>=', $dateNow)->count();  // memuat semua lowongan yang sudah di upload oleh user PT

        $closeLowongan = Lowongan::where('user_id', $idPt)->whereDate('close_lowongan', '<', $dateNow)->count();

        // query mahasiswa seleksi perusahaan
        $approved = Lowongan::where('user_id', $idPt) // query lowongan sesuai dengan user idnya   => logikanya ketika sudah di pilih sesuai status maka di load masukkan query dengan with
        ->whereHas('pendaftar', function($query){ // dipilih yang tabel pendaftar dan diseleksi statusnya approve
            $query->where('status', 'approve');
        })
        ->with(['pendaftar' => function($query){ // memuat hasil query sesuai dengan stausnya
            $query->where('status', 'approve');
        }])
        ->get();

        if($approved->count() == 0){
            $approv = 0;
        }else{
            foreach($approved as $approv){
                $approv;
            }
        }

        // mahasiswa masih baru mendaftar ke lowongan
        $pendings = Lowongan::where('user_id', $idPt)
        ->whereHas('pendaftar', function($query){
            $query->where('status', 'pending');
        })
        ->with(['pendaftar' => function($query){
            $query->where('status', 'pending');
        }])
        ->get();

        if($pendings->count() == 0){
            $pending = 0;
        }else{
            foreach($pendings as $pending){
                $pending;
            }

        }



        $rejects = Lowongan::where('user_id', $idPt)
        ->whereHas('pendaftar', function($query){
            $query->whereIn('status', ['rejected_kampus', 'rejected_perusahaan']);
        })->with(['pendaftar' => function($query){
            $query->whereIn('status', ['rejected_kampus', 'rejected_perusahaan']);
        }])
        ->get();
        if($rejects->count() == 0){
            $reject = 0;
        }else{
            foreach($rejects as $reject){
                $reject;
            }
        };

        // query mahasiswa di terima
        $selects = User::where('id', $idPt)
        ->with(['lowongan.pendaftar' => function($query){
            $query->where('status', 'select');
        }])
       ->get();

       $allSelect = 0;
       foreach($selects as $select){
        foreach($select->lowongan as $lowongan){
            foreach($lowongan->pendaftar as $status){
                $allSelect++;
            }
        }
       }

        return view('admin_perusahaan.dashboard', compact('closeLowongan', 'openLowongan', 'approv', 'allSelect', 'pending', 'reject'));
    }

    public function profile()
    {
        $user = User::with('alamat', 'sosmed', 'profile',)->findOrFail(Auth::user()->id);
        return view('admin_perusahaan.profile', compact('user'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::with('alamat', 'sosmed', 'profile')->findOrFail($id);

        if ($request->email !== $user->email) {
            $validated = Validator::make($request->all(), [
                'email' => 'unique:users,email'
            ]);

            if ($validated->fails()) {
                return redirect()->back()->withErrors(['email' => 'email sudah ada'])->withInput();
            }
            $user->email = $request->email;
        }
        $user->nama_depan = $request->nama_depan;
        $user->save();

        if (!$user->alamat) {
            Alamat::create([
                'user_id' => $user->id,
                'provinsi' => $request->provinsi,
                'kab_kot' => $request->kab_kot,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'alamat' => $request->alamat,
                'kode_pos' => $request->kode_pos,
            ]);
        } else {
            $user->alamat->provinsi = $request->provinsi;
            $user->alamat->kab_kot = $request->kab_kot;
            $user->alamat->kecamatan = $request->kecamatan;
            $user->alamat->desa = $request->desa;
            $user->alamat->alamat = $request->alamat;
            $user->alamat->kode_pos = $request->kode_pos;
            $user->alamat->save();
        }

        if (!$user->sosmed) {
            Sosmed::create([
                'user_id' => $user->id,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'tiktok' =>  $request->tiktok,
                'twiter' =>  $request->twiter,
                'linkedin' => $request->linkedin,
                'website' => $request->website,

            ]);
        } else {
            $user->sosmed->instagram = $request->instagram;
            $user->sosmed->facebook =  $request->facebook;
            $user->sosmed->tiktok =   $request->tiktok;
            $user->sosmed->twiter =  $request->twiter;
            $user->sosmed->linkedin = $request->linkedin;
            $user->sosmed->website = $request->website;
            $user->sosmed->save();
        }

        if (!$user->profile) {
            MahasiswaProfile::create([
                'user_id' => $user->id,
                'no_hp' => $request->no_hp,
            ]);
        } else {
            $user->profile->no_hp = $request->no_hp;
            $user->profile->save();
        }

        return redirect()->route('perusahaan.profile')->with('success', 'Data berhasil di update');
    }

    public function fotoUpdate(Request $request, $id)
    {
        $foto = User::with('profile')->findOrFail($id);

        $validated = Validator::make($request->all(),[
            'img' => 'mimes:png,jpg|max:1020'
        ]);
        if($validated->fails()){
            return redirect()->back()->withErrors(['img' => 'Harus file img dan maximal ukuran 10MB']);
        }

        $fileName = time() . '-' . $request->img->getClientOriginalName();  // untuk membuat nama file yang baru di upload
        $file = $request->file('img');                                      // untuk inisialisasi data image yang di upload untuk di move ke local
        $filePath = public_path('/img/profile/') . $foto->profile->img;     // untuk membuat file pathnya buat pengkondisian apakah ada filenya

        // jika tidak ada profile maka buat terlebih dahulu
        if (!$foto->profile) {
            MahasiswaProfile::make([
                'user_id' => $id,
                'img' => $fileName,
            ]);
            $file->move(public_path('/img/profile/'), $fileName);

        } else {
            // jika ada file dengan key img ada yang di upload maka di eksekusi
            if ($request->hasFile('img')) {
                if ($filePath && $foto->profile->img) {
                    unlink($filePath);
                }

                $foto->profile->img = $fileName;
                $foto->profile->save();
                $file->move(public_path('/img/profile/'), $fileName);

            }
        }

        return redirect()->back()->with('uploadSuccess', 'Foto profile berhasil di upload');
    }
}
