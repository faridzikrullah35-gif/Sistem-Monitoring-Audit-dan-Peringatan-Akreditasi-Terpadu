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
        Schema::create('prodi_prestasi_akademik_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->string('tahun_akademik');
            $table->string('nama_kegiatan');
            $table->year('waktu_perolehan');
            $table->enum('tingkat', ['Lokal/Wilayah', 'Nasional', 'Internasional']);
            $table->text('prestasi_dicapai');
            $table->timestamps();

            // Add indexes for better performance
            $table->index('tahun_akademik');
            $table->index('tingkat');
            $table->index('waktu_perolehan');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_prestasi_akademik_mahasiswa');
    }
};