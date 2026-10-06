<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prodi_inovasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->string('tahun_akademik');
            $table->string('nama_dosen');
            $table->string('nama_inovasi');
            $table->string('jenis_inovasi');
            $table->string('hki')->nullable();      // HKI (misal: Paten, Hak Cipta, dll)
            $table->string('nomor_hki')->nullable();
            $table->string('produk_prototype')->nullable();
            $table->string('pengguna_mitra')->nullable();
            $table->string('link_bukti')->nullable();
            $table->timestamps();

            $table->index('tahun_akademik');
            $table->index('users_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prodi_inovasi');
    }
};