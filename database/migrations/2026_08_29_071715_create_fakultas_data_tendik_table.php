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
        Schema::create('fakultas_data_tendik', function (Blueprint $table) {
            $table->id();

            // User yang menginput data
            $table->foreignId('users_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Data Tenaga Kependidikan
            $table->string('nama');
            $table->string('latar_pendidikan')->nullable();
            $table->string('sertifikasi')->default('Tidak');
            $table->string('sk_pegawai_tetap')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas_data_tendik');
    }
};