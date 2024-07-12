<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MahasiswaProfileController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PerusahaanController;
use App\Models\MahasiswaProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// CRUD Users by admin
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('/admin/users', AdminController::class);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
});

Route::middleware(['auth', 'verified', 'perusahaan'])->group(function () {
    // CRUD Lowongan
    Route::resource('/perusahaan/lowongan', PerusahaanController::class);
    // profile perusahaan
    Route::get('/perusahaan/profile', [PerusahaanController::class, 'profile'])->name('perusahaan.profile');
    Route::get('/perusahaan/dashboard', [PerusahaanController::class, 'dashboard'])->name('perusahaan.dashboard');
});

Route::middleware(['auth', 'verified', 'kampus'])->group(function () {
    // CRUD User dari Kampus
    Route::resource('/kampus/user', KampusController::class);
    Route::get('/kampus/profile', [KampusController::class, 'profile'])->name('kampus.profile');
    Route::get('/kampus/dashboard', [KampusController::class, 'dashboard'])->name('kampus.dashboard');
});

Route::middleware(['auth', 'verified', 'mahasiswa'])->group(function () {
    // Mahasiswa daftar lowongan magang
    Route::resource('/pendaftaran', LowonganController::class);
    Route::get('/mahasiswa/profile', [MahasiswaProfileController::class, 'profile'])->name('mahasiswa.profile');
});

// CRUD Pendaftar Lowongan untuk di approve
Route::resource('/pendaftar', PendaftarController::class);



// untuk get jurusan di dalam pendaftaran ketika di pilih kampusnya menampilkan semua jurusan sesuai kampus yang di pilih
Route::GET('/get-jurusan/{kampusId}', [RegisterController::class, 'getJurusan'])->name('getJurusan');
