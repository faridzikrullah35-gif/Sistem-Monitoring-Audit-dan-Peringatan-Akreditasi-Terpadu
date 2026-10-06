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
        Schema::create('prodi_kurikulum', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('tahun_akademik', 20);

            $table->string('dokumen')->nullable();

            $table->date('tgl_penetapan')->nullable();

            $table->string('peninjauan_kurikulum', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_kurikulum');
    }
};