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
        Schema::create('setting_scores', function (Blueprint $table) {
            $table->id();

            // Bisa isi:
            // 4
            // 0 - 1
            // 1 - 2
            $table->string('nilai_score');

            $table->text('keterangan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_scores');
    }
};