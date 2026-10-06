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
        Schema::create('setting_header_cetak', function (Blueprint $table) {
            $table->id();
            
            // Kolom untuk auditor/unit kerja
            $table->unsignedBigInteger('auditor_id')->nullable();
            $table->string('role')->nullable();
            
            // Kolom existing
            $table->string('no_dokumen');
            $table->date('tanggal_terbit');
            $table->string('no_revisi')->default('00');
            
            $table->timestamps();
            
            // Foreign key ke users
            $table->foreign('auditor_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_header_cetak');
    }
};