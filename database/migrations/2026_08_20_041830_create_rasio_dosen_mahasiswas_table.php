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
        Schema::create('rasio_dosen_mahasiswa_prodi', function (Blueprint $table) {
            $table->id();

            // Tahun Akademik (misal: 2024/2025, TA-6, dsb)
            $table->string('tahun_akademik', 20)->nullable()->comment('Tahun akademik data rasio');

            // Jumlah Dosen Tetap
            $table->integer('jumlah_dosen_tetap')->default(0)->comment('Jumlah dosen tetap');

            // Jumlah Mahasiswa
            $table->integer('jumlah_mahasiswa')->default(0)->comment('Jumlah mahasiswa');

            // Rasio Dosen Terhadap Mahasiswa (otomatis dihitung atau diisi manual)
            $table->decimal('rasio', 8, 2)->default(0)->comment('Rasio dosen : mahasiswa');

            // Foreign key ke users (siapa yang menginput)
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('set null');

            // Timestamps
            $table->timestamps();

            // Index
            $table->index('tahun_akademik');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rasio_dosen_mahasiswa_prodi');
    }
};