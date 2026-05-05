<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_auditor', function (Blueprint $table) {
            $table->id();
            $table->string('nidn')->unique();
            $table->string('nama_auditor');
            $table->string('unit');
            $table->string('sub_unit')->nullable();
            $table->year('tahun_aktif');

            $table->enum('status', ['Aktif', 'Non Aktif'])->default('Aktif');

            $table->year('tahun_non_aktif')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_auditor');
    }
};