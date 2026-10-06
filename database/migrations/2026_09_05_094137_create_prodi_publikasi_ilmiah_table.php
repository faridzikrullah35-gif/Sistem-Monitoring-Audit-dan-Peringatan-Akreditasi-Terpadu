<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prodi_publikasi_ilmiah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_dosen', 255);
            $table->string('nidn', 20)->nullable();
            $table->string('judul_artikel', 500);
            $table->string('jenis_publikasi', 100);
            $table->string('nama_jurnal_prosiding', 255);
            $table->string('issn', 50)->nullable();
            $table->string('volume_no', 50)->nullable();
            $table->string('sinta_scopus', 50)->nullable();
            $table->string('penulis_ke', 10)->nullable();
            $table->string('link_artikel', 500)->nullable();
            $table->timestamps();

            $table->index('users_id');
            $table->index('jenis_publikasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prodi_publikasi_ilmiah');
    }
};