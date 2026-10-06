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
        Schema::create('setting_profile_admin', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel users
            $table->foreignId('users_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->string('dibuat_oleh')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('tujuan')->nullable();
            
            // Status aktif (hanya 1 yang bisa aktif)
            $table->boolean('is_active')->default(false);
            
            // Timestamps
            $table->timestamps();
            
            // Index untuk mempercepat query
            $table->index('is_active');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_profile_admin');
    }
};