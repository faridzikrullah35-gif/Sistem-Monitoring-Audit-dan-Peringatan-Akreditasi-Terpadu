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
        Schema::create('prodi_data_tendik', function (Blueprint $table) {
            $table->id();

            // Identitas Tendik
            $table->string('nama', 100)->nullable()->comment('Nama tenaga kependidikan');
            $table->text('latar_pendidikan')->nullable()->comment('Latar belakang pendidikan (isi teks)');
            $table->string('sertifikasi', 100)->nullable()->comment('Sertifikasi yang dimiliki');
            $table->string('sk_pegawai_tetap', 100)->nullable()->comment('SK Pegawai Tetap');

            // Foreign key ke users (siapa yang menginput)
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('set null');

            // Timestamps
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('nama');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_data_tendik');
    }
};