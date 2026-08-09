<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akreditasis', function (Blueprint $table) {
            $table->id();

            // Kolom utama
            $table->string('program');                  // Jenjang
            $table->string('program_studi');            // Program Studi
            $table->string('nomor_sk');                 // SK Akreditasi
            $table->date('tanggal_sk');                 // Tanggal SK (untuk ambil tahun)
            $table->string('peringkat_akreditasi');     // Peringkat (A, B, C, Unggul)
            $table->date('tanggal_kadaluarsa');         // Tgl. Daluwarsa
            $table->string('status_akreditasi');        // Status Daluwarsa (Aktif, Perhatian, Kritis)
            $table->string('sisa_kadaluarsa')->nullable(); // Sisa Kadaluarsa (bisa dihitung)
            $table->string('akreditasi_nasional');      // Akreditasi Nasional
            $table->string('akreditasi_internasional')->nullable(); // Akreditasi Internasional
            $table->text('keterangan')->nullable();     // Keterangan

            // Kolom tambahan (TS, pendampingan, LED, LKPT)
            $table->date('upcoming_ts3')->nullable();
            $table->date('upcoming_ts2')->nullable();
            $table->date('upcoming_ts1')->nullable();
            $table->date('upcoming_ts')->nullable();
            $table->date('tanggal_pendampingan')->nullable();
            $table->text('led')->nullable();
            $table->text('lkpt')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akreditasis');
    }
};