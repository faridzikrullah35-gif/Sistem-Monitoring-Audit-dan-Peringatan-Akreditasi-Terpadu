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
        Schema::create('fakultas_sarpras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('users_id');

            $table->string('kode');
            $table->string('nama_sarpras');
            $table->string('status');
            $table->unsignedInteger('jumlah')->default(0);

            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();

            $table->timestamps();

            /**
             * Relasi ke users.
             */
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            /**
             * Satu kode sarpras tidak boleh duplikat.
             */
            $table->unique('kode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas_sarpras');
    }
};