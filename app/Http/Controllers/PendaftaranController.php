<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; 
use Illuminate\Support\Facades\File;

class PendaftaranController extends Controller
{
    // Folder tujuan upload di dalam public/
    protected $uploadPath = 'uploads/bukti_pembayaran/'; 

    /**
     * Menampilkan formulir pendaftaran (GET).
     */
    public function index()
    {
        // Mengambil status dari session (untuk modal notifikasi)
        $status = session('status'); 
        
        // Memanggil view yang berada di resources/views/pages/pendaftaran.blade.php
        return view('pages.pendaftaran', compact('status'));
    }

    /**
     * Memproses pengiriman formulir dan menyimpan data (POST).
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_wa' => 'required|string|max:20',
            'tempat_tinggal' => 'required|string|max:100',
            'jadwal_latihan' => 'required|string|max:100',
            'trainer' => 'required|string|max:100',
            'program_latihan' => 'required|string|max:100',
            'kategori_anggota' => 'required|string|max:50',
            'metode_pembayaran' => 'required|string|max:50',
            'nominal' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Maks 5MB (5120KB)
        ], [
            // Pesan error kustom
            'nominal.required' => 'Nominal Pembayaran wajib diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'bukti_pembayaran.max' => 'Ukuran file bukti pembayaran terlalu besar (maks 5MB).',
            'bukti_pembayaran.image' => 'File bukti pembayaran harus berupa gambar (JPG/PNG).',
        ]);

        $bukti_pembayaran_path = "Tidak Ada Bukti";
        
        // 2. Proses Upload File (jika ada)
        if ($request->hasFile('bukti_pembayaran')) {
            $image = $request->file('bukti_pembayaran');
            
            // Membuat nama file unik
            $filename = uniqid('bukti_', true) . '.' . $image->getClientOriginalExtension();
            
            // Pindahkan file ke folder public/uploads/bukti_pembayaran/
            $image->move(public_path($this->uploadPath), $filename);
            
            $bukti_pembayaran_path = $this->uploadPath . $filename;
        }

        // 3. Simpan Data ke Database menggunakan Eloquent
        try {
            Pendaftaran::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nomor_wa' => $request->nomor_wa,
                'tempat_tinggal' => $request->tempat_tinggal,
                'jadwal_latihan' => $request->jadwal_latihan,
                'trainer' => $request->trainer,
                'program_latihan' => $request->program_latihan,
                'kategori_anggota' => $request->kategori_anggota,
                'metode_pembayaran' => $request->metode_pembayaran,
                'nominal' => $request->nominal,
                'bukti_pembayaran_path' => $bukti_pembayaran_path,
                'tgl_pendaftaran' => now(), 
            ]);

            // Sukses: Redirect ke route 'pendaftaran.index' dengan flash session 'status'
            return redirect()->route('pendaftaran.index')->with('status', 'sukses');

        } catch (\Exception $e) {
            // Gagal: Hapus file jika gagal disimpan di DB dan redirect
            if ($bukti_pembayaran_path != "Tidak Ada Bukti" && File::exists(public_path($bukti_pembayaran_path))) {
                File::delete(public_path($bukti_pembayaran_path));
            }

            // Gagal: Redirect ke route 'pendaftaran.index' dengan error
            return redirect()->route('pendaftaran.index')
                             ->with('status', 'gagal')
                             ->withErrors(['db_error' => 'Kesalahan saat menyimpan data ke database.']);
        }
    }
}