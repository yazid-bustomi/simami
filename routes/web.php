<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PerusahaanController;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
// Route::get('/verification/verify', 'VerificationController@verify')->name('verification.verify');


Route::get('/tes', function() {
    return view('layouts.new');
});

// CRUD Users by admin
Route::resource('/admin/users', AdminController::class);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboad');

// CRUD Lowongan
Route::resource('/perusahaan/lowongan', PerusahaanController::class);
Route::get('/perusahaan/dashboard', [PerusahaanController::class, 'dashboard'])->name('perusahaan.dashboard');

// CRUD Pendaftar Lowongan untuk di approve
Route::resource('/pendaftar', PendaftarController::class);

// CRUD Admin Kampus
Route::resource('/kampus/user', KampusController::class);
Route::get('/kampus/dashboard', [KampusController::class, 'dashboard'])->name('kampus.dashboard');
