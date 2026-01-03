<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $column) {
            $column->id();
            $column->string('judul');      // Untuk judul artikel
            $column->text('link');        // Untuk URL artikel luar
            $column->string('gambar');     // Untuk nama file foto
            $column->text('deskripsi');    // Untuk ringkasan artikel
            $column->timestamps();         // created_at & updated_at
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};