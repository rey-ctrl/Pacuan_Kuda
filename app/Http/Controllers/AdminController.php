<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran; // Impor Model yang telah dibuat
use Illuminate\Http\Request;
use App\Models\GaleriGambar;
use Illuminate\Support\Facades\DB;
 // Impor Model yang telah dibuat

class AdminController extends Controller
{

    public function dashboard() // Dipanggil oleh Route::get('/admin/dashboard', ...)
    {
        // 1. Ambil Total Pemasukan dan Total Pendaftar (Eloquent/DB)
        $data_total = Pendaftaran::select(
                DB::raw('SUM(nominal) AS total_pemasukan'),
                DB::raw('COUNT(id) AS total_pendaftar')
            )->first();

        $total_pemasukan = $data_total->total_pemasukan ?? 0;
        $total_pendaftar = $data_total->total_pendaftar ?? 0;
        
        // Hitung Rata-rata Pembayaran
        $rata_rata_pembayaran = ($total_pendaftar > 0) ? $total_pemasukan / $total_pendaftar : 0;
        
        // 2. Ambil Total Nominal per Bulan (Query Builder/DB)
        $data_bulanan = Pendaftaran::select(
            DB::raw("DATE_FORMAT(tgl_pendaftaran, '%M') AS bulan"),
            DB::raw("SUM(nominal) AS total_bulan")
        )
        // Tambahkan 'bulan' hasil alias DATE_FORMAT ke GROUP BY
        // dan pertahankan pengelompokan berdasarkan bulan dan tahun (agar data tahun berbeda tidak tercampur)
        ->groupBy(DB::raw('YEAR(tgl_pendaftaran), MONTH(tgl_pendaftaran), bulan')) 
        ->orderBy(DB::raw('MONTH(tgl_pendaftaran)'))
        ->get();

        // Siapkan data untuk Chart.js
        $bulan = $data_bulanan->pluck('bulan')->toArray();
        $nominal = $data_bulanan->pluck('total_bulan')->map(fn($n) => (int)$n)->toArray();

        // Kirim semua variabel ke view
        return view('admin.dashboard', compact(
            'total_pemasukan', 
            'total_pendaftar', 
            'rata_rata_pembayaran', 
            'bulan', 
            'nominal'
        ));
    }


    /**
     * Menampilkan daftar data pendaftaran.
     */
    public function dataKeuangan()
    {
        // Mengambil semua data dari tabel 'pendaftaran', diurutkan berdasarkan tgl_pendaftaran
        $pendaftaran = Pendaftaran::orderBy('tgl_pendaftaran', 'desc')->get();

        // Mengirim data ke view
        return view('admin.data_keuangan', compact('pendaftaran'));
    }

    public function adminGaleri()
    {
        // Mengambil semua data dari tabel 'galeri_gambar', diurutkan berdasarkan id
        $galeri = GaleriGambar::orderBy('id', 'desc')->get();

        // Mengirim data ke view
        return view('admin.admin_galeri', compact('galeri'));
    }
}