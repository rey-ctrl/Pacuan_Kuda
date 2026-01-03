<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ArtikelController;

/*
|--------------------------------------------------------------------------
| I. Rute Publik (Akses Umum)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');

/*
|--------------------------------------------------------------------------
| II. Rute Otentikasi
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| III. Rute Terotentikasi (Middleware 'auth')
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
   
    // Pendaftaran User (Formulir Depan)
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Grup Admin
    // Semua route di sini otomatis diawali URL "/admin/" dan nama "admin."
    Route::prefix('admin')->name('admin.')->group(function () {

        // Dashboard & Keuangan (Read Only / Index)
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Menampilkan tabel data keuangan
        // Pastikan di AdminController methodnya 'dataKeuangan' memanggil view yang benar
        // ATAU kalau mau pakai PendaftaranController langsung juga bisa:
        Route::get('/data-keuangan', [PendaftaranController::class, 'adminIndex'])->name('data_keuangan');

        // --- EDIT & UPDATE DATA PENDAFTARAN ---
        // Perbaikan: Hapus '/admin' dan 'admin.' karena sudah mewarisi dari grup
        
        // 1. Form Edit (URL: /admin/pendaftaran/{id}/edit)
        Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
        
        // 2. Proses Update (URL: /admin/pendaftaran/{id})
        Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
        
        // 3. Proses Hapus (URL: /admin/pendaftaran/{id})
        // Perbaikan: Arahkan ke PendaftaranController@destroy
        Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');


        // Manajemen Galeri
        Route::prefix('galeri')->name('galeri.')->group(function () {
            Route::get('/', [AdminGaleriController::class, 'index'])->name('index');
            Route::post('/store', [AdminGaleriController::class, 'store'])->name('store');
            Route::get('/delete/{id}', [AdminGaleriController::class, 'destroy'])->name('destroy');
        });

        // Manajemen Artikel
        Route::prefix('artikel')->name('artikel.')->group(function () {
            Route::get('/', [AdminArtikelController::class, 'index'])->name('index');
            Route::post('/store', [AdminArtikelController::class, 'store'])->name('store');
            Route::post('/update/{id}', [AdminArtikelController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [AdminArtikelController::class, 'destroy'])->name('delete');
        });
    });
});