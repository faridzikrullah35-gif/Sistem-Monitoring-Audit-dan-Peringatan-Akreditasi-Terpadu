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
        Schema::create('dokumen_prodi', function (Blueprint $table) {

            $table->id();

            /**
             * Relasi ke Profil Prodi
             */
            $table->foreignId('profil_prodi_id')
                ->constrained('profil_prodi')
                ->cascadeOnDelete();

            /**
             * Jenis Dokumen
             */

            $table->string('jenis', 50);

            /**
             * Nama Dokumen
             */

            $table->string('nama_dokumen');

            /**
             * File
             */

            $table->string('file');

            /**
             * Tanggal
             */

            $table->date('tanggal_penetapan');

            $table->date('tanggal_revisi')->nullable();

            /**
             * Catatan
             */

            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Index
            $table->index('profil_prodi_id');
            $table->index('jenis');
            $table->index(['profil_prodi_id', 'jenis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_prodi');
    }
};