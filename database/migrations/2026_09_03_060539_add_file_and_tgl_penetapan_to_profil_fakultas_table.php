<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_fakultas', function (Blueprint $table) {
            $table->string('file')->nullable()->after('sasaran');
            $table->date('tgl_penetapan')->nullable()->after('file');
        });
    }

    public function down(): void
    {
        Schema::table('profil_fakultas', function (Blueprint $table) {
            $table->dropColumn([
                'file',
                'tgl_penetapan',
            ]);
        });
    }
};