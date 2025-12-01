<?php

namespace App\Http\Controllers;

use App\Models\GaleriGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Untuk operasi file

class AdminGaleriController extends Controller
{
    // Konfigurasi path
    protected $uploadPath = 'img/galeri/';

    /**
     * Menampilkan daftar galeri (READ).
     */
    public function index()
{
    // Mengambil semua data galeri
    $galeri = GaleriGambar::orderBy('id', 'desc')->get();

    // Mengambil pesan status dan msg dari session flash data. 
    // Jika tidak ada di session, nilainya akan menjadi null (aman).
    $status = session('status');
    $msg = session('msg'); 

    // Mengirimkan data dan status/msg ke view
    return view('admin.admin_galeri', compact('galeri', 'status', 'msg'));
}

    /**
     * Menyimpan gambar baru (CREATE).
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
            'deskripsi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $deskripsi = $request->deskripsi ?? '';

            // 2. Buat Nama Unik dan Pindahkan File
            $filename = uniqid('img_', true) . '.' . $image->getClientOriginalExtension();
            
            // Pindahkan file ke folder public/img/imggaleri/gambar bawah/
            $image->move(public_path($this->uploadPath), $filename);
            
            $dbPath = $this->uploadPath . $filename;

            // 3. Simpan Path ke Database
            GaleriGambar::create([
                'path_gambar' => $dbPath,
                'deskripsi' => $deskripsi,
            ]);

            return redirect()->route('admin.galeri.index')->with('status', 'added');
        }

        return redirect()->route('admin.galeri.index')->with('msg', 'Silakan pilih file gambar.');
    }

    /**
     * Menghapus gambar (DELETE).
     */
    public function destroy($id)
    {
        $gambar = GaleriGambar::find($id);

        if (!$gambar) {
            return redirect()->route('admin.galeri.index')->with('msg', 'Gambar tidak ditemukan.');
        }

        // 1. Hapus File Fisik
        $filePath = public_path($gambar->path_gambar);
        
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // 2. Hapus dari Database
        $gambar->delete();

        return redirect()->route('admin.galeri.index')->with('status', 'deleted');
    }
}