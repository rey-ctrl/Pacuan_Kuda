<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PendaftaranController; // Tambahkan ini

// ---------------------------------------------------------------------
// I. Rute Publik (Akses Umum)
// ---------------------------------------------------------------------

// Halaman Beranda
Route::get('/', function () {
    return view('pages.index'); 
})->name('home');

// Galeri Publik (User)
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index'); 

// Artikel
Route::get('/artikel', function () {
    return view('pages.artikel'); 
})->name('artikel');

// Kontak
Route::get('/kontak', function () {
    return view('pages.kontak'); 
})->name('kontak');

// ---------------------------------------------------------------------
// II. Rute Otentikasi
// ---------------------------------------------------------------------

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ---------------------------------------------------------------------
// III. Rute Terotentikasi (Membutuhkan Middleware 'auth')
// ---------------------------------------------------------------------

// Mengelompokkan semua rute yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    
    // Pendaftaran User (Formulir Pendaftaran)
    Route::get('/pages/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pages/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); 
    
    // Data Keuangan & Register (Jika AdminController digunakan untuk ini)
    Route::get('/admin/data-keuangan', [AdminController::class, 'dataKeuangan'])->name('admin.data_keuangan');
    
    // Rute Admin Galeri (Mengelompokkan CRUD Galeri Admin)
    Route::prefix('admin')->group(function () {
        // Tampilkan daftar galeri admin (menggantikan Route::get('/admin/admin-galeri', ...) yang lama)
        Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('admin.galeri.index');

        // CRUD Galeri
        Route::post('/galeri/store', [AdminGaleriController::class, 'store'])->name('admin.galeri.store');
        Route::get('/galeri/delete/{id}', [AdminGaleriController::class, 'destroy'])->name('admin.galeri.destroy');
    });
});