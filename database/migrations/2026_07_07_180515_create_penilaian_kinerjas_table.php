<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('isi_indikator_id')->constrained('isi_indikator')->onDelete('cascade');
            $table->text('deskripsi');
            $table->foreignId('setting_score_id')->constrained('setting_scores')->onDelete('restrict');
            $table->string('file_path')->nullable(); // path file PDF
            $table->timestamps();

            // Unik: satu user + satu indikator hanya boleh satu penilaian
            $table->unique(['users_id', 'isi_indikator_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_kinerja');
    }
};