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
        Schema::create('audit_observasi', function (Blueprint $table) {

            $table->id();

            /*
            |------------------------------------------------------------------
            | RELASI
            |------------------------------------------------------------------
            */

            $table->foreignId('audit_periksa_id')
                ->nullable()
                ->constrained('audit_periksa')
                ->nullOnDelete();

            /*
            |------------------------------------------------------------------
            | USER
            |------------------------------------------------------------------
            */

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |------------------------------------------------------------------
            | RELASI AUDIT
            |------------------------------------------------------------------
            */

            $table->foreignId('pertanyaan_ami_prodi_id')
                ->constrained('pertanyaan_ami_prodi')
                ->cascadeOnDelete();

            /*
            |------------------------------------------------------------------
            | OPTIONAL FILTERING
            |------------------------------------------------------------------
            */

            $table->foreignId('matrixs_id')
                ->nullable()
                ->constrained('matrixs')
                ->nullOnDelete();

            /*
            |------------------------------------------------------------------
            | KATEGORI OBSERVASI
            |------------------------------------------------------------------
            */

            $table->enum('kategori_observasi', [
                'Observasi',
                'Sesuai'
            ]);

            /*
            |------------------------------------------------------------------
            | DISCUSSED WITH
            |------------------------------------------------------------------
            */

            $table->longText('discussed_with');

            /*
            |------------------------------------------------------------------
            | REKOMENDASI
            |------------------------------------------------------------------
            */

            $table->longText('rekomendasi');

            /*
            |------------------------------------------------------------------
            | STATUS OBSERVASI
            |------------------------------------------------------------------
            */

            $table->enum('status_observasi', [
                'Open',
                'Close'
            ])->default('Open');

            /*
            |------------------------------------------------------------------
            | CATATAN TAMBAHAN
            |------------------------------------------------------------------
            */

            $table->longText('catatan')->nullable();

            /*
            |------------------------------------------------------------------
            | TIMESTAMP
            |------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_observasi');
    }
};