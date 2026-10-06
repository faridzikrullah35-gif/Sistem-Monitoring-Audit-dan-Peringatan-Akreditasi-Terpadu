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
        Schema::create('prodi_data_dosen', function (Blueprint $table) {
            $table->id();

            // Identitas Dosen
            $table->string('nama', 100)->nullable()->comment('Nama dosen');
            $table->text('latar_pendidikan')->nullable()->comment('Latar belakang pendidikan (isi teks)');
            $table->string('nama_instansi_asal', 150)->nullable()->comment('Nama instansi asal');
            $table->string('sertifikasi', 100)->nullable()->comment('Sertifikasi yang dimiliki');
            $table->string('jabatan_akademik', 100)->nullable()->comment('Jabatan akademik');
            $table->string('sk_dosen_tetap', 100)->nullable()->comment('SK Dosen Tetap');
            $table->string('status', 50)->nullable()->comment('Status dosen: Aktif, Tugas Belajar, Non Aktif');
            $table->string('nidn', 20)->nullable()->comment('NIDN');
            $table->string('nuptk', 20)->nullable()->comment('NUPTK');
            
            // Pendidikan per jenjang (teks, bisa diisi nama gelar atau "-")
            $table->string('doktor', 100)->nullable()->comment('Pendidikan Doktor (isi teks)');
            $table->string('magister', 100)->nullable()->comment('Pendidikan Magister (isi teks)');
            $table->string('sarjana', 100)->nullable()->comment('Pendidikan Sarjana (isi teks)');

            // Foreign key ke users (siapa yang menginput)
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('set null');

            // Timestamps
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('nama');
            $table->index('nidn');
            $table->index('nuptk');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_data_dosen');
    }
};