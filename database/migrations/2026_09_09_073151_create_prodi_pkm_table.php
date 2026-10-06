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
        Schema::create('prodi_pkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->string('tahun_akademik');
            $table->string('nama_dosen');
            $table->string('nidn', 20);
            $table->string('judul_pkm');
            $table->text('lokasi_mitra');
            $table->enum('tingkat', ['Internasional', 'Nasional', 'Lokal']);
            $table->string('sumber_dana');
            $table->boolean('melibatkan_mahasiswa')->default(false);
            $table->text('luaran');
            $table->string('link_bukti')->nullable();
            $table->timestamps();

            // Add index for better performance
            $table->index('tahun_akademik');
            $table->index('tingkat');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_pkm');
    }
};