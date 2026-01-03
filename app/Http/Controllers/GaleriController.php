<?php

namespace App\Http\Controllers;

use App\Models\GaleriGambar; 
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Menampilkan halaman galeri dengan semua gambar.
     */
    public function index()
    {
        $galeri = GaleriGambar::orderBy('id', 'desc')->get();

        // REVISI DI SINI
        // Ganti 'galeri.index' menjadi 'pages.galeri'
        return view('pages.galeri', compact('galeri')); 
    }
}