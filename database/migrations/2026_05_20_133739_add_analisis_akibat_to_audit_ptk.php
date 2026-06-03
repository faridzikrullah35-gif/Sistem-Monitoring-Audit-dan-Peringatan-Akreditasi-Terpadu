<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            $table->text('analisis_penyebab')->nullable()->after('deskripsi_uraian_temuan');
            $table->text('akibat')->nullable()->after('analisis_penyebab');
        });
    }

    public function down()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            $table->dropColumn(['analisis_penyebab', 'akibat']);
        });
    }
};