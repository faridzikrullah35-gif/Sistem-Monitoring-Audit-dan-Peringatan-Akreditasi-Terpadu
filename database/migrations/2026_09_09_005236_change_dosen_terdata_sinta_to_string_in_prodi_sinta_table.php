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
        Schema::table('prodi_sinta', function (Blueprint $table) {
            // Ubah dari unsignedInteger menjadi string
            $table->string('dosen_terdata_sinta', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodi_sinta', function (Blueprint $table) {
            // Kembalikan ke unsignedInteger
            $table->unsignedInteger('dosen_terdata_sinta')->default(0)->change();
        });
    }
};