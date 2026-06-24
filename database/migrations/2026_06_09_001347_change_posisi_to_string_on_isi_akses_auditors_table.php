<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('isi_akses_auditors', function (Blueprint $table) {
            $table->string('posisi', 100)->change();
        });
    }

    public function down(): void
    {
        // opsional
    }
};