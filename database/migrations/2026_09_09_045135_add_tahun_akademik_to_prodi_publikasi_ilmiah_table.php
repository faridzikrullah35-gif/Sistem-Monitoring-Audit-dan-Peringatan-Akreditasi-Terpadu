<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodi_publikasi_ilmiah', function (Blueprint $table) {
            $table->string('tahun_akademik', 20)->after('users_id')->nullable();
            $table->index('tahun_akademik');
        });
    }

    public function down(): void
    {
        Schema::table('prodi_publikasi_ilmiah', function (Blueprint $table) {
            $table->dropIndex(['tahun_akademik']);
            $table->dropColumn('tahun_akademik');
        });
    }
};