<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_prodi', function (Blueprint $table) {
            $table->string('tahun_akademik')->nullable()->after('jumlah_mahasiswa');
        });
    }

    public function down(): void
    {
        Schema::table('profil_prodi', function (Blueprint $table) {
            $table->dropColumn('tahun_akademik');
        });
    }
};