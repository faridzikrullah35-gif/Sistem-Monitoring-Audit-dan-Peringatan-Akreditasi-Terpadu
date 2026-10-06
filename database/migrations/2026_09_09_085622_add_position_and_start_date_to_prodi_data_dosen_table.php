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
        Schema::table('prodi_data_dosen', function (Blueprint $table) {
            // Menambahkan kolom posisi/jabatan
            $table->string('posisi_jabatan')->nullable()->after('jabatan_akademik');
            
            // Menambahkan kolom terhitung_mulai_tanggal
            $table->date('terhitung_mulai_tanggal')->nullable()->after('posisi_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodi_data_dosen', function (Blueprint $table) {
            $table->dropColumn(['posisi_jabatan', 'terhitung_mulai_tanggal']);
        });
    }
};