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
        Schema::create('galeri_gambar', function (Blueprint $table) {
            $table->id(); 
            $table->string('path_gambar', 255); 
            $table->text('deskripsi')->nullable(); 
            $table->string('alt_text', 255)->nullable(); 
            
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_gambar');
    }
};