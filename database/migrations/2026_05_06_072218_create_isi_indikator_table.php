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
        Schema::create('isi_indikator', function (Blueprint $table) {
            $table->id();

            // Relasi ke matrixs
            $table->foreignId('matrixs_id')
                ->constrained('matrixs')
                ->cascadeOnDelete();

            // Isi indikator
            $table->text('indikator');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('isi_indikator');
    }
};
