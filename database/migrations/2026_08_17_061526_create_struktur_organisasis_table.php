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
        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel users
            $table->foreignId('users_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Kolom untuk data struktur organisasi
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            // Urutan tampilan (untuk sorting)
            $table->integer('urutan')->default(0);
            // Timestamps
            $table->timestamps();
            // Index untuk mempercepat query
            $table->index('users_id');
            $table->index('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi');
    }
};