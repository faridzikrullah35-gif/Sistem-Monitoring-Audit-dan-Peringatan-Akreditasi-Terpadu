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
        Schema::create('auditiees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')
                ->constrained('users')
                ->onDelete('cascade');

            // RELASI KE TAHUN AKADEMIK
            $table->foreignId('tahun_akademik_id')
                ->constrained('tahun_akademik')
                ->onDelete('cascade');

            $table->string('nama_auditiee');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditiees');
    }
};