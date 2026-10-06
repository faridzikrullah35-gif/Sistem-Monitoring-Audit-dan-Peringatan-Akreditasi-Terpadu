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
        Schema::table('prodi_data_tendik', function (Blueprint $table) {
            // Menambahkan kolom posisi/jabatan
            $table->string('posisi')->nullable()->after('nama');
            
            // Menambahkan kolom terhitung mulai tanggal
            $table->date('terhitung_mulai_tanggal')->nullable()->after('posisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodi_data_tendik', function (Blueprint $table) {
            $table->dropColumn(['posisi', 'terhitung_mulai_tanggal']);
        });
    }
};