<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     * Secara default Laravel akan menganggap tabelnya bernama 'artikels'.
     */
    protected $table = 'artikels';

    /**
     * Kolom-kolom yang dapat diisi secara massal (Mass Assignment).
     * Pastikan kolom ini sesuai dengan field yang ada di migration Anda.
     */
    protected $fillable = [
        'judul',
        'link',
        'gambar',
        'deskripsi',
    ];

    /**
     * Jika Anda ingin melakukan casting pada kolom tertentu, 
     * misalnya timestamps atau format data lainnya.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}