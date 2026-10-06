<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel profil_fakultas
        if (!Schema::hasTable('profil_fakultas')) {
            Schema::create('profil_fakultas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->longText('visi')->nullable();
                $table->longText('misi')->nullable();
                $table->longText('tujuan')->nullable();
                $table->longText('sasaran')->nullable();
                $table->integer('jumlah_magister')->default(0);
                $table->integer('jumlah_doktor')->default(0);
                $table->integer('jumlah_total')->default(0);
                $table->integer('jumlah_asisten_ahli')->default(0);
                $table->integer('jumlah_lektor')->default(0);
                $table->integer('jumlah_lektor_kepala')->default(0);
                $table->integer('jumlah_guru_besar')->default(0);
                $table->integer('jumlah_mahasiswa')->default(0);
                $table->string('tahun_akademik')->nullable();
                $table->timestamps();
            });
        }

        // Tabel dokumen_fakultas
        if (!Schema::hasTable('dokumen_fakultas')) {
            Schema::create('dokumen_fakultas', function (Blueprint $table) {
                $table->id();
                $table->string('kategori');
                $table->string('nama_dokumen');
                $table->date('tanggal_penetapan')->nullable();
                $table->date('tanggal_revisi')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('file_path');
                $table->string('file_name');
                $table->integer('file_size');
                $table->string('file_type');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('profil_fakultas');
        Schema::dropIfExists('dokumen_fakultas');
    }
};