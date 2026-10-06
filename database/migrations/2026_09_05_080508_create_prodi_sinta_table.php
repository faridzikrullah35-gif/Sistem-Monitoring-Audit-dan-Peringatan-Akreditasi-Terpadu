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
        Schema::create('prodi_sinta', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('tahun_akademik');

            $table->unsignedInteger('dosen_terdata_sinta')->default(0);

            $table->decimal('sinta_score_3_tahun', 10, 2)->default(0);

            $table->decimal('sinta_score_overall', 10, 2)->default(0);

            $table->decimal('index', 10, 2)->default(0);

            $table->string('link_sinta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_sinta');
    }
};