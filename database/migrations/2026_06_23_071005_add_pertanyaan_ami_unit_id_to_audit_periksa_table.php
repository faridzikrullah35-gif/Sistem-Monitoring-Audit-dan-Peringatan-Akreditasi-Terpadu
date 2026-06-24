<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_periksa', function (Blueprint $table) {
            $table->foreignId('pertanyaan_ami_unit_id')
                ->nullable()
                ->after('pertanyaan_ami_prodi_id');
        });
    }

    public function down(): void
    {
        Schema::table('audit_periksa', function (Blueprint $table) {
            $table->dropColumn('pertanyaan_ami_unit_id');
        });
    }
};