<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; 
use Illuminate\Support\Facades\File;

class PendaftaranController extends Controller
{
    protected $uploadPath = 'uploads/bukti_pembayaran/'; 

    /**
     * UNTUK USER: Form Pendaftaran
     */
    public function index()
    {
        $status = session('status'); 
        return view('pages.pendaftaran', compact('status'));
    }

    /**
     * UNTUK ADMIN: Menampilkan Tabel Data Keuangan & Pendaftar
     */
    public function adminIndex()
    {
        // Mengambil semua data pendaftaran urut terbaru
        $pendaftaran = Pendaftaran::orderBy('tgl_pendaftaran', 'desc')->get();
        
        // Sesuaikan nama view dengan lokasi file blade admin Anda
        // Misal: resources/views/admin/data_keuangan.blade.php
        return view('admin.data_keuangan', compact('pendaftaran'));
    }

    /**
     * PROSES SIMPAN (Store)
     */
    public function store(Request $request)
    {
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
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $bukti_pembayaran_path = "Tidak Ada Bukti";
        
        if ($request->hasFile('bukti_pembayaran')) {
            $image = $request->file('bukti_pembayaran');
            $filename = uniqid('bukti_', true) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->uploadPath), $filename);
            $bukti_pembayaran_path = $this->uploadPath . $filename;
        }

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

            return redirect()->route('pendaftaran.index')->with('status', 'sukses');

        } catch (\Exception $e) {
            if ($bukti_pembayaran_path != "Tidak Ada Bukti" && File::exists(public_path($bukti_pembayaran_path))) {
                File::delete(public_path($bukti_pembayaran_path));
            }
            return redirect()->route('pendaftaran.index')->with('status', 'gagal');
        }
    }

    /**
     * UNTUK ADMIN: Hapus Data
     */
    public function destroy($id)
    {
        $data = Pendaftaran::findOrFail($id);

        // Hapus file gambar jika ada
        if ($data->bukti_pembayaran_path != "Tidak Ada Bukti" && File::exists(public_path($data->bukti_pembayaran_path))) {
            File::delete(public_path($data->bukti_pembayaran_path));
        }

        $data->delete();
        return redirect()->back()->with('status', 'Data pendaftaran berhasil dihapus!');
    }

    /**
     * UNTUK ADMIN: Form Edit (Jika diperlukan)
     */
    public function edit($id)
    {
        $data = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran_edit', compact('data'));
    }

    /**
     * UNTUK ADMIN: Proses Update Data
     */
    public function update(Request $request, $id)
    {
        $data = Pendaftaran::findOrFail($id);

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
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Nullable karena user mungkin tidak ganti gambar
        ]);

        $bukti_pembayaran_path = $data->bukti_pembayaran_path;

        // Cek jika ada upload gambar baru
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus gambar lama jika ada dan bukan string default
            if ($data->bukti_pembayaran_path != "Tidak Ada Bukti" && File::exists(public_path($data->bukti_pembayaran_path))) {
                File::delete(public_path($data->bukti_pembayaran_path));
            }

            // Upload gambar baru
            $image = $request->file('bukti_pembayaran');
            $filename = uniqid('bukti_', true) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->uploadPath), $filename);
            $bukti_pembayaran_path = $this->uploadPath . $filename;
        }

        $data->update([
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
        ]);

        // Redirect kembali ke halaman index admin
        return redirect()->route('admin.data_keuangan')->with('status', 'Data berhasil diperbarui!');
    }
}