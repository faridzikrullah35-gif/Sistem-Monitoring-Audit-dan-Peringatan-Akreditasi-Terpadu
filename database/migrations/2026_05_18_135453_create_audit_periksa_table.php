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
        Schema::create('audit_periksa', function (Blueprint $table) {

            $table->id();

            // auditor yg input
            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // sumber indikator audit
            $table->foreignId('pertanyaan_ami_prodi_id')
                ->constrained('pertanyaan_ami_prodi')
                ->cascadeOnDelete();

            // hasil audit
            $table->text('uraian_temuan');

            $table->text('analisis_penyebab');

            $table->text('akibat');

            $table->foreignId('setting_score_id')
                ->nullable()
                ->constrained('setting_scores')
                ->nullOnDelete();

            $table->longText('panduan_pengisian')
                ->nullable();

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_periksa');
    }
};