<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 255);
            $table->string('nomor_wa', 20);
            $table->string('tempat_tinggal', 100);
            $table->string('jadwal_latihan', 100);
            $table->string('trainer', 100);
            $table->string('program_latihan', 100);
            $table->string('kategori_anggota', 50);
            $table->string('metode_pembayaran', 50);
            $table->decimal('nominal', 10, 0)->nullable(); // Nominal bisa null
            $table->string('bukti_pembayaran_path', 255)->nullable(); // Path bisa null
            $table->dateTime('tgl_pendaftaran');
            // Karena Model Pendaftaran Anda menggunakan $timestamps = false,
            // kolom created_at dan updated_at tidak perlu dibuat.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};