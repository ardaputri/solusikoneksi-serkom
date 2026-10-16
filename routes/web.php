<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// ===================== HALAMAN PUBLIK =====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'show'])->name('profil.show');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/kontak', [KontakController::class, 'show'])->name('kontak.show');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// ===================== AUTH ADMIN =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===================== AREA ADMIN =====================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Profil perusahaan: hanya edit/update (statis, tidak bisa ditambah/dihapus)
    Route::get('/profil', [Admin\ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [Admin\ProfilController::class, 'update'])->name('profil.update');

    Route::resource('produk', Admin\ProdukController::class)->parameters(['produk' => 'produk']);
    Route::resource('artikel', Admin\ArtikelController::class);
    Route::resource('galeri', Admin\GaleriController::class);

    Route::get('/pesan', [Admin\PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{pesan}', [Admin\PesanController::class, 'show'])->name('pesan.show');
    Route::delete('/pesan/{pesan}', [Admin\PesanController::class, 'destroy'])->name('pesan.destroy');
});
