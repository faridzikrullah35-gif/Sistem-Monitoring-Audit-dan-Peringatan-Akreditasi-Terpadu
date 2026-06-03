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
        Schema::create('audit_ptk', function (Blueprint $table) {

            $table->id();

            // =========================
            // RELASI
            // =========================

            /*
            |--------------------------------------------------------------------------
            | Data PTK/NCR berasal dari audit_periksa
            | Jika audit_periksa dihapus,
            | maka PTK ikut terhapus otomatis
            |--------------------------------------------------------------------------
            */
            $table->foreignId('audit_periksa_id')
                ->constrained('audit_periksa')
                ->cascadeOnDelete();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('pertanyaan_ami_prodi_id')
                ->constrained('pertanyaan_ami_prodi')
                ->cascadeOnDelete();

            // =========================
            // DATA NCR
            // =========================

            /*
            |--------------------------------------------------------------------------
            | Nomor NCR otomatis generate dari sistem
            |--------------------------------------------------------------------------
            */
            $table->string('no_ncr')
                ->nullable()
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Klausul dokumen audit
            |--------------------------------------------------------------------------
            */
            $table->string('klausul_dokumen')
                ->nullable();
            /*
            |--------------------------------------------------------------------------
            | Deskripsi temuan hasil audit
            |--------------------------------------------------------------------------
            */
            $table->longText('deskripsi_uraian_temuan');

            // =========================
            // KATEGORI TEMUAN
            // =========================

            /*
            |--------------------------------------------------------------------------
            | Dynamic category
            | Mengikuti setting_scores.keterangan
            | Tidak memakai ENUM agar fleksibel
            |--------------------------------------------------------------------------
            */
            $table->string('kategori_temuan');

            // =========================
            // STATUS NCR
            // =========================

            /*
            |--------------------------------------------------------------------------
            | Status tindak lanjut NCR/PTK
            |--------------------------------------------------------------------------
            */
            $table->enum('status_ncr', [
                'Open',
                'Close'
            ])->default('Open');

            // =========================
            // TANGGAL SELESAI
            // =========================

            /*
            |--------------------------------------------------------------------------
            | Tanggal penyelesaian tindak lanjut
            |--------------------------------------------------------------------------
            */
            $table->date('tanggal_selesai')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_ptk');
    }
};