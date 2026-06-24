<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_terpenuhi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained('kriteria_audit');
            $table->foreignId('matrixs_id')->constrained('matrixs');
            $table->foreignId('isi_indikator_id')->constrained('isi_indikator');
            $table->foreignId('pertanyaan_ami_prodi_id')->nullable()->constrained('pertanyaan_ami_prodi');
            $table->foreignId('pertanyaan_ami_unit_id')->nullable()->constrained('pertanyaan_ami_unit');
            $table->text('discussed_with');
            $table->text('rekomendasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_terpenuhi');
    }
};