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
        Schema::create('profil_prodi', function (Blueprint $table) {

            $table->id();

            /**
             * Relasi ke akun Prodi
             * Satu akun Prodi hanya memiliki satu profil.
             */
            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | VMTS
            |--------------------------------------------------------------------------
            */

            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('tujuan')->nullable();
            $table->longText('sasaran')->nullable();

            /*
            |--------------------------------------------------------------------------
            | DTPS
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('jumlah_dtps_magister')->default(0);
            $table->unsignedSmallInteger('jumlah_dtps_doktor')->default(0);

            $table->unsignedSmallInteger('jumlah_aa')->default(0);
            $table->unsignedSmallInteger('jumlah_lk')->default(0);
            $table->unsignedSmallInteger('jumlah_gb')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Mahasiswa
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('jumlah_mahasiswa')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_prodi');
    }
};