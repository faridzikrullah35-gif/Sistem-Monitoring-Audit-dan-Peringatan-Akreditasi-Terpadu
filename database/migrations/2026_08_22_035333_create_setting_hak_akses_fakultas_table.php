<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setting_hak_akses_fakultas', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user (fakultas)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Informasi fakultas
            $table->string('fakultas'); // Nama fakultas
            
            // Sub unit yang diakses (bisa multiple)
            $table->string('sub_unit')->nullable();
            
            // Level akses
            $table->enum('level_akses', ['read', 'write', 'admin'])
                  ->default('read');
            
            // Status akses
            $table->boolean('is_active')->default(true);
            
            // Metadata
            $table->text('keterangan')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['user_id', 'fakultas', 'sub_unit']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setting_hak_akses_fakultas');
    }
};