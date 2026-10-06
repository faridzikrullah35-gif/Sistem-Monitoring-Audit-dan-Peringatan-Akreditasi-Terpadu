<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rasio_dosen_mahasiswa_fakultas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('tahun_akademik', 20);

            $table->unsignedInteger('jumlah_dosen')->default(0);
            $table->unsignedInteger('jumlah_mahasiswa')->default(0);

            $table->decimal('rasio', 10, 2)->nullable();

            $table->timestamps();

            $table->unique(
                ['users_id', 'tahun_akademik'],
                'fakultas_rasio_user_tahun_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rasio_dosen_mahasiswa_fakultas');
    }
};