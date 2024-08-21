<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminKampusController;
use App\Http\Controllers\AdminKampusController as ControllersAdminKampusController;
use App\Http\Controllers\AdminMahasiswaController;
use App\Http\Controllers\AdminPerusahaanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanKampusController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MahasiswaProfileController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PengalamanController;
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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

// CRUD Users by admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/users', AdminController::class);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/{id}', [AdminController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/password/{id}/update', [AdminController::class, 'updatePassword'])->name('admin.password.update');
    Route::post('/admin/profile/foto/{id}', [AdminController::class, 'updateImage'])->name('admin.foto.update');
    Route::resource('/admin/kampus', ControllersAdminKampusController::class);
    Route::resource('/admin/perusahaan', AdminPerusahaanController::class);
    Route::resource('/admin/mahasiswa', AdminMahasiswaController::class);
});

Route::middleware(['auth', 'perusahaan'])->group(function () {
    // CRUD Lowongan
    Route::resource('/perusahaan/lowongan', PerusahaanController::class);
    // profile perusahaan
    Route::get('/perusahaan/profile', [PerusahaanController::class, 'profile'])->name('perusahaan.profile');
    Route::post('/perusahaan/profile/{id}', [PerusahaanController::class, 'profileUpdate'])->name('perusahaan.profile.update');
    Route::post('/perusahaan/profile/foto/{id}', [PerusahaanController::class, 'fotoUpdate'])->name('perusahaan.foto.update');
    Route::get('/perusahaan/dashboard', [PerusahaanController::class, 'dashboard'])->name('perusahaan.dashboard');
});

Route::middleware(['auth', 'kampus'])->group(function () {
    // CRUD User dari Kampus
    Route::resource('/kampus/user', KampusController::class);
    Route::get('/kampus/profile', [KampusController::class, 'profile'])->name('kampus.profile');
    Route::post('/kampus/profile/{id}', [KampusController::class, 'profileUpdate'])->name('kampus.profile.update');
    Route::post('/kampus/profile/foto/{id}', [KampusController::class, 'updateProfile'])->name('kampus.foto.update');
    Route::get('/kampus/dashboard', [KampusController::class, 'dashboard'])->name('kampus.dashboard');
    Route::resource('/kampus/jurusan', JurusanKampusController::class);
});

Route::middleware(['auth', 'mahasiswa'])->group(function () {
    // Mahasiswa daftar lowongan magang
    Route::resource('/magang', LowonganController::class);
    Route::get('/mahasiswa/status', [MahasiswaProfileController::class, 'status'])->name('mahasiswa.status');
    Route::resource('/mahasiswa/profile', MahasiswaProfileController::class);

    // update foto profile
    Route::post('/mahasiswa/profile/{id}', [MahasiswaProfileController::class, 'profile'])->name('mahasiswa.update.profile');
    // upload CV dan transkip
    Route::post('/mahasiswa/akademik/{id}', [MahasiswaProfileController::class, 'akademik'])->name('mahasiswa.update.akademik');

    Route::get('/mahasiswa/dashboard', [MahasiswaProfileController::class, 'dashboard'])->name('mahasiswa.dashboard');

    // CRUD lamar and approve magang
    Route::resource('/pendaftar', PendaftarController::class);
});


// untuk get jurusan di dalam pendaftaran ketika di pilih kampusnya menampilkan semua jurusan sesuai kampus yang di pilih
Route::GET('/get-jurusan/{kampusId}', [RegisterController::class, 'getJurusan'])->name('getJurusan');
