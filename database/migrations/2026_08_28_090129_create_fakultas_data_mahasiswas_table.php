<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fakultas_data_mahasiswas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('tahun_akademik', 20);

            $table->unsignedInteger('ta_6')->default(0);
            $table->unsignedInteger('ta_5')->default(0);
            $table->unsignedInteger('ta_4')->default(0);
            $table->unsignedInteger('ta_3')->default(0);
            $table->unsignedInteger('ta_2')->default(0);
            $table->unsignedInteger('ta_1')->default(0);
            $table->unsignedInteger('ta')->default(0);

            $table->unsignedInteger('lulusan_akhir_ta')->default(0);

            $table->timestamps();

            $table->unique(
                ['users_id', 'tahun_akademik'],
                'fakultas_mahasiswa_user_tahun_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fakultas_data_mahasiswas');
    }
};