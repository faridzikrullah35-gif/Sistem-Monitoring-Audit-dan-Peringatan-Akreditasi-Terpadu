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
        Schema::create('fakultas_data_dosen', function (Blueprint $table) {
            $table->id();

            // User yang menginput / memiliki data
            $table->foreignId('users_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Identitas Dosen
            $table->string('nama');
            $table->string('nidn')->nullable();
            $table->string('nuptk')->nullable();

            // Pendidikan
            $table->string('latar_pendidikan')->nullable();
            $table->string('doktor')->nullable();
            $table->string('magister')->nullable();
            $table->string('sarjana')->nullable();
            $table->string('nama_instansi_asal')->nullable();

            // Sertifikasi & Jabatan
            $table->string('sertifikasi')->default('Tidak');
            $table->string('jabatan_akademik')->nullable();
            $table->string('sk_dosen_tetap')->nullable();

            // Status
            $table->string('status')->default('Aktif');

            $table->timestamps();

            // Index
            $table->index('nidn');
            $table->index('nuptk');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas_data_dosen');
    }
};