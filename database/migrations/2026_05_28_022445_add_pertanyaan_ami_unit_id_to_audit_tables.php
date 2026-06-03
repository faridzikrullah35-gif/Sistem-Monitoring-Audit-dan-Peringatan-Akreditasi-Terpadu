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
        /*
        |--------------------------------------------------------------------------
        | AUDIT PERIKSA
        |--------------------------------------------------------------------------
        */

        Schema::table('audit_periksa', function (Blueprint $table) {

            // bikin nullable
            $table->foreignId('pertanyaan_ami_prodi_id')
                ->nullable()
                ->change();

        });

        /*
        |--------------------------------------------------------------------------
        | AUDIT PTK
        |--------------------------------------------------------------------------
        */

        Schema::table('audit_ptk', function (Blueprint $table) {

            $table->foreignId('pertanyaan_ami_prodi_id')
                ->nullable()
                ->change();

        });

        /*
        |--------------------------------------------------------------------------
        | FORM OBSERVASI
        |--------------------------------------------------------------------------
        */

        Schema::table('audit_observasi', function (Blueprint $table) {

            $table->foreignId('pertanyaan_ami_prodi_id')
                ->nullable()
                ->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};