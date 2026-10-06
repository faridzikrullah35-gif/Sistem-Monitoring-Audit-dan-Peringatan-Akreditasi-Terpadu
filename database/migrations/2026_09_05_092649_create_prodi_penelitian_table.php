<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prodi_penelitian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->enum('ketua_anggota', ['Ketua', 'Anggota'])->default('Ketua');
            $table->string('nama_dosen', 255);
            $table->string('judul_penelitian', 500);
            $table->string('lembaga_mitra', 255)->nullable();
            $table->enum('tingkat', ['Internasional', 'Nasional', 'Lokal'])->default('Nasional');
            $table->string('skema', 100)->nullable();
            $table->string('sumber_dana', 100)->nullable();
            $table->string('luaran', 255)->nullable();
            $table->string('link_bukti', 500)->nullable();
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('users_id');
            $table->index('tingkat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_penelitian');
    }
};