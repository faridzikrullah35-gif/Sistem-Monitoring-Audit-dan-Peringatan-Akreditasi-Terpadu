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
        Schema::create('prodi_bimbingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->string('tahun_akademik', 20);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('file')->nullable();
            $table->date('tgl_penetapan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_bimbingan');
    }
};