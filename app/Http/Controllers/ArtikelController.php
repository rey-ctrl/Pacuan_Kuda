<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Mengaktifkan model Artikel agar data diambil langsung dari database
use App\Models\Artikel; 

class ArtikelController extends Controller
{
    /**
     * Menampilkan daftar artikel untuk pengunjung (publik).
     */
    public function index()
    {
        /**
         * Mengambil semua data dari tabel 'artikels'.
         * latest() digunakan agar artikel yang baru diunggah muncul di paling atas.
         */
        $artikels = Artikel::latest()->get();

        /**
         * Mengarahkan ke view 'pages.artikel'.
         * Variabel $artikels dikirim agar bisa di-looping di halaman Blade.
         */
        return view('pages.artikel', compact('artikels'));
    }
}