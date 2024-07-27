<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaProfileRequest;
use App\Http\Requests\UpdateMahasiswaProfileRequest;
use App\Models\AkademikProfile;
use App\Models\Alamat;
use App\Models\Lowongan;
use App\Models\MahasiswaProfile;
use App\Models\Pendaftar;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $idUser = Auth::user()->id;
        $mahasiswas = User::with(['akademikProfile', 'profile', 'alamat', 'sosmed', 'akademikProfile.adminKampus', 'akademikProfile.jurusanKampus'])
            ->where('id', $idUser)
            ->get();

        foreach ($mahasiswas as $mahasiswa) {
            $tanggalLahir = $mahasiswa->profile->tanggal_lahir ?? '';
            $mahasiswa;
        }


        return view('mahasiswa.profile', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMahasiswaProfileRequest  $request
     * @param  \App\Models\MahasiswaProfile  $mahasiswaProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswaProfileRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ipk' => 'min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        };

        // mencari user di database sesuai dengan id nya yang mau di update untuk di verifikasi email dan nomer hp
        $user = User::with('profile', 'akademikProfile', 'alamat', 'sosmed')->findOrFail($id);

        // mencari nim yang sama dengan satu kampus
        $nimExists = DB::table('akademik_profiles')
            // memfilter data yang di berikan dari request
            ->where('nim', $request->nim)
            // memfilter dari admin kampus apakah ada yang sama dalam satu kampus nim tersebut
            ->where('admin_kampus_id', $user->akademikProfile->admin_kampus_id)
            // nim tidak cocok dengan user lain dalam satu kampus
            ->where('user_id', '!=', $id)
            ->exists();

        // jika email di update / tidak sama dengan user awal maka di validate apakah di dalam database ada yang sama
        if ($request->email !== $user->email || $nimExists) {
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:users,email',
            ]);

            // jika nimExists bernilai true maka ada yang sama dalam satu kampus
            if ($nimExists) {
                $validate->after(function ($validator) {
                    $validator->errors()->add('nim', 'NIM sama dengan user lain');
                });
            }

            // jika error maka kembalikan errornya dan berikan pesan
            if ($validate->fails()) {
                return back()->withErrors($validate)->withInput();
            }
        }

        // update user basic
        $user->nama_depan = $request->nama_depan;
        $user->nama_belakang = $request->nama_belakang;
        $user->email = $request->email;
        $user->save();

        // update akademik profile
        $user->akademikProfile->nim = $request->nim;
        $user->akademikProfile->semester = $request->semester;
        $user->akademikProfile->ipk = $request->ipk;
        $user->akademikProfile->save();

        // jika dari user mahasiswa profile kosong maka di create dahulu
        if (!$user->profile) {
            MahasiswaProfile::create([
                'user_id' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_hp' => $request->no_hp,
            ]);
        } else {
            // update mahasiswa profile
            $user->profile->jenis_kelamin = $request->jenis_kelamin;
            $user->profile->agama = $request->agama;
            $user->profile->tempat_lahir = $request->tempat_lahir;
            $user->profile->tanggal_lahir = $request->tanggal_lahir;
            $user->profile->no_hp = $request->no_hp;
            $user->profile->save();
        }

        // jika alamat masih kosong maka di create terlebih dahulu
        if (!$user->alamat) {
            Alamat::create([
                'user_id' => $user->id,
                'provinsi' =>  $request->provinsi,
                'kab_kot' =>  $request->kab_kot,
                'kecamatan' =>  $request->kecamatan,
                'desa' =>  $request->desa,
                'alamat' =>  $request->alamat,
                'kode_pos' => $request->kode_pos,
            ]);
        } else {
            // update alamat
            $user->alamat->provinsi = $request->provinsi;
            $user->alamat->kab_kot = $request->kab_kot;
            $user->alamat->desa = $request->desa;
            $user->alamat->kecamatan = $request->kecamatan;
            $user->alamat->alamat = $request->alamat;
            $user->alamat->kode_pos = $request->kode_pos;
            $user->alamat->save();
        }

        // jika sosmed masih kosong maka di create terlebih dahulu
        if (!$user->sosmed) {
            Sosmed::create([
                'user_id' => $user->id,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'twiter' => $request->twiter,
                'website' => $request->website,
                'facebook' => $request->facebook,
                'tiktok' => $request->tiktok,
            ]);
        } else {

            // update sosmed
            $sosmed = $user->sosmed;

            $sosmed->instagram = $request->instagram;
            $sosmed->linkedin = $request->linkedin;
            $sosmed->twiter = $request->twiter;
            $sosmed->website = $request->website;
            $sosmed->facebook = $request->facebook;
            $sosmed->tiktok = $request->tiktok;
            $sosmed->save();
        }
        // redirect to profile and message success
        return redirect()->route('profile.index')->with('success', 'Profile berhasil di update');
    }


    // update foto profile
    public function profile(Request $request, $id)
    {
        $user = User::with('profile')->findOrFail($id);

        $request->validate([
            'img' => 'image|mimes:png,jpg,jpeg|max:1020',
        ]);

        if ($request->hasFile('img')) {
            // memberi nama dengan date sekarang dan mendapatkan ekstensi filenya sekalian
            $fileName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('/img/profile/'), $fileName);

            if ($user->profile != null) {
                // untuk mendapatkan file di folder
                $filePath = public_path('/img/profile/' . $user->profile->img);

                // mengecek apakah link img di database dan  file di folder ada maka di hapus dulu
                if ($user->profile->img && $filePath) {
                    unlink($filePath);
                }
                $user->profile->img = $fileName;
                $user->profile->save();
            }
            MahasiswaProfile::create([
                'user_id' => $id,
                'img' => $fileName,
            ]);
        }
        return redirect()->route('profile.index')->with('profileSuccess', 'Foto Profile Berhasil di Update');
    }


    public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function status()
    {
        $idUser = Auth::user()->id;
        $approve = Pendaftar::where('user_id', $idUser)
            ->with([
                'lowongan',
                'user.akademikProfile',
                'user.profile',
                'user.akademikProfile.adminKampus',
                'user.akademikProfile.jurusanKampus'
            ])->get();
        return view('mahasiswa.magang.status', compact('approve'));
    }

    public function akademik(Request $request, $id)
    {
        $user = User::with('akademikProfile')->findOrFail($id);

        if ($request->hasFile('cv')) {
            $request->validate([
                'cv' => 'file|mimes:pdf|max:1020',
            ]);

            $cvPath = public_path('/cv/' . $user->akademikProfile->cv);

            if ($user->akademikProfile->cv && $cvPath) {
                unlink($cvPath);
            }

            $cvName = time() . '.' . $request->cv->extension();
            $request->cv->move(public_path('/cv/'), $cvName);
            $user->akademikProfile->cv = $cvName;
            $user->akademikProfile->save();
        }

        if ($request->hasFile('transkip')) {
            $request->validate([
                'transkip' => 'mimes:pdf|max:1020|file'
            ]);

            $transkipPath = public_path('/transkip/' . $user->akademikProfile->transkip);

            if ($transkipPath && $user->akademikProfile->transkip) {
                unlink($transkipPath);
            }
            $transkipName = time() . '.' . $request->transkip->extension();
            $request->transkip->move(public_path('/transkip/'), $transkipName);
            $user->akademikProfile->transkip = $transkipName;
            $user->akademikProfile->save();
        }

        return redirect()->route('profile.index')->with('upAkademik', 'Update data berhasil');
    }
}
