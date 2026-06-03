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
        Schema::create('pertanyaan_ami_unit', function (Blueprint $table) {
            $table->id();

            $table->foreignId('isi_indikator_id')
                ->constrained('isi_indikator')
                ->onDelete('cascade');

            $table->foreignId('tahun_akademik_id')
                ->constrained('tahun_akademik')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_ami_unit');
    }
};
