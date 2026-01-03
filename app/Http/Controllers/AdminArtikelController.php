<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Artikel; // Pastikan Model Artikel diimpor

class AdminArtikelController extends Controller
{
    /**
     * Tampilkan halaman manajemen artikel untuk admin.
     */
    public function index()
    {
        // Ambil semua artikel dari database untuk ditampilkan di tabel
        $artikels = Artikel::latest()->get();
        return view('admin.admin_artikel', compact('artikels'));
    }

    /**
     * Proses penyimpanan artikel baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul'     => 'required|string|max:255',
            'link'      => 'required|url',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required',
        ]);

        // 2. Proses Upload Gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            
            // Pastikan folder public/img/artikel sudah ada
            $tujuan_upload = public_path('img/artikel');
            $file->move($tujuan_upload, $nama_file);

            // 3. Simpan Data ke Database
            // Pastikan properti $fillable sudah diatur di file App\Models\Artikel
            Artikel::create([
                'judul'     => $request->judul,
                'link'      => $request->link,
                'gambar'    => $nama_file,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->back()->with('status', 'Artikel berhasil ditambahkan ke database!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    /**
     * Menghapus artikel.
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Hapus file gambar dari folder public
        $path = public_path('img/artikel/' . $artikel->gambar);
        if (File::exists($path)) {
            File::delete($path);
        }

        // Hapus data dari database
        $artikel->delete();

        return redirect()->back()->with('status', 'Artikel berhasil dihapus!');
    }
}