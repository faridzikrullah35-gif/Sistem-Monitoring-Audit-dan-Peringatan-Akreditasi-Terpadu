<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fakultas_data_lulusans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nama_prodi');

            $table->unsignedInteger('ta_3')->default(0);
            $table->unsignedInteger('ta_2')->default(0);
            $table->unsignedInteger('ta_1')->default(0);
            $table->unsignedInteger('ta')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fakultas_data_lulusans');
    }
};