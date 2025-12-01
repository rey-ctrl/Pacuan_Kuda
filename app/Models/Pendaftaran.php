<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pendaftaran';

    // Kolom-kolom yang dapat diisi (jika Anda memiliki operasi penambahan/pengubahan)
    protected $fillable = [
        'nama_lengkap',
        'nomor_wa',
        'tempat_tinggal',
        'jadwal_latihan',
        'trainer',
        'program_latihan',
        'kategori_anggota',
        'metode_pembayaran',
        'nominal',
        'bukti_pembayaran_path',
        'tgl_pendaftaran',
    ];

    // Menghilangkan kolom created_at dan updated_at jika tidak ada di tabel pendaftaran
    public $timestamps = false;
}