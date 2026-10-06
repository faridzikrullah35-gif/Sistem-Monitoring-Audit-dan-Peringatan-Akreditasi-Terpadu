<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Rename kolom lama
        |--------------------------------------------------------------------------
        */
        Schema::table('profil_prodi', function (Blueprint $table) {
            $table->renameColumn(
                'jumlah_dtps_magister',
                'jumlah_magister'
            );

            $table->renameColumn(
                'jumlah_dtps_doktor',
                'jumlah_doktor'
            );

            $table->renameColumn(
                'jumlah_aa',
                'jumlah_asisten_ahli'
            );

            $table->renameColumn(
                'jumlah_lk',
                'jumlah_lektor_kepala'
            );

            $table->renameColumn(
                'jumlah_gb',
                'jumlah_guru_besar'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Tambah kolom baru
        |--------------------------------------------------------------------------
        */
        Schema::table('profil_prodi', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_total')
                ->nullable()
                ->after('jumlah_doktor');

            $table->unsignedInteger('jumlah_lektor')
                ->nullable()
                ->after('jumlah_asisten_ahli');

            /*
            |--------------------------------------------------------------------------
            | Jadikan kolom existing nullable
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('jumlah_magister')
                ->nullable()
                ->change();

            $table->unsignedInteger('jumlah_doktor')
                ->nullable()
                ->change();

            $table->unsignedInteger('jumlah_asisten_ahli')
                ->nullable()
                ->change();

            $table->unsignedInteger('jumlah_lektor_kepala')
                ->nullable()
                ->change();

            $table->unsignedInteger('jumlah_guru_besar')
                ->nullable()
                ->change();
        });

        /*
        |--------------------------------------------------------------------------
        | Reset data awal menjadi NULL
        |--------------------------------------------------------------------------
        */
        DB::table('profil_prodi')->update([
            'jumlah_magister'       => null,
            'jumlah_doktor'         => null,
            'jumlah_total'          => null,
            'jumlah_asisten_ahli'   => null,
            'jumlah_lektor'         => null,
            'jumlah_lektor_kepala'  => null,
            'jumlah_guru_besar'     => null,
        ]);
    }

    public function down(): void
    {
        Schema::table('profil_prodi', function (Blueprint $table) {
            $table->dropColumn([
                'jumlah_total',
                'jumlah_lektor',
            ]);

            $table->renameColumn(
                'jumlah_magister',
                'jumlah_dtps_magister'
            );

            $table->renameColumn(
                'jumlah_doktor',
                'jumlah_dtps_doktor'
            );

            $table->renameColumn(
                'jumlah_asisten_ahli',
                'jumlah_aa'
            );

            $table->renameColumn(
                'jumlah_lektor_kepala',
                'jumlah_lk'
            );

            $table->renameColumn(
                'jumlah_guru_besar',
                'jumlah_gb'
            );
        });
    }
};