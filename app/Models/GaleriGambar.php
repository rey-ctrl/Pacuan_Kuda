<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriGambar extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'galeri_gambar';

    // Kolom kunci utama
    protected $primaryKey = 'id';

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        'path_gambar',
        'alt_text',
        'deskripsi',
    ];

    // Jika tabel tidak menggunakan created_at dan updated_at
    public $timestamps = false;
}