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
        Schema::create('matrixs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kriteria_audit_id')
                ->constrained('kriteria_audit')
                ->cascadeOnDelete();

            $table->text('elemen');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrixs');
    }
};
