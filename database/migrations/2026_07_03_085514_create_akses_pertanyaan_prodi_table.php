<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('akses_pertanyaan_prodi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertanyaan_id')
                  ->constrained('pertanyaan_ami_prodi')
                  ->onDelete('cascade');
            $table->string('role');
            $table->string('unit');
            $table->string('sub_unit')->nullable();
            $table->timestamps();

            // Biar ga duplikat akses yang sama
            $table->unique(['pertanyaan_id', 'role', 'unit', 'sub_unit'], 'unique_akses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('akses_pertanyaan_prodi');
    }
};