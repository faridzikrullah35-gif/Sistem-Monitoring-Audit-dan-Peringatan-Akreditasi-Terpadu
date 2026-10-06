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
        Schema::create('admin_input_berita', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke users
            $table->foreignId('users_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Kolom untuk file
            $table->string('nama_file'); // Nama asli file
            $table->string('file'); // Path file yang diupload
            
            // Kolom "diupload oleh" (bisa diisi manual atau dari relasi)
            $table->string('diupload_oleh')->nullable();
            
            $table->timestamps();
            
            // Index untuk performa
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_input_berita');
    }
};