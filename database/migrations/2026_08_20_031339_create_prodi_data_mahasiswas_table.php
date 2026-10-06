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
        Schema::create('prodi_data_mahasiswa', function (Blueprint $table) {
            $table->id();
            
            // Tahun Akademik
            $table->string('tahun_akademik', 10)->comment('TA-6, TA-5, TA-4, TA-3, TA-2, TA-1, TA');
            
            // Jumlah Mahasiswa per tahun akademik
            $table->integer('ta_6')->default(0)->comment('Jumlah mahasiswa TA-6');
            $table->integer('ta_5')->default(0)->comment('Jumlah mahasiswa TA-5');
            $table->integer('ta_4')->default(0)->comment('Jumlah mahasiswa TA-4');
            $table->integer('ta_3')->default(0)->comment('Jumlah mahasiswa TA-3');
            $table->integer('ta_2')->default(0)->comment('Jumlah mahasiswa TA-2');
            $table->integer('ta_1')->default(0)->comment('Jumlah mahasiswa TA-1');
            $table->integer('ta')->default(0)->comment('Jumlah mahasiswa TA');
            
            // Jumlah Lulusan Akhir TA
            $table->integer('lulusan_akhir_ta')->default(0)->comment('Jumlah lulusan akhir TA');
            
            // Foreign key ke users (siapa yang menginput/mengelola data)
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Timestamps
            $table->timestamps();
            
            // Index untuk optimasi query
            $table->index('tahun_akademik');
            $table->index('users_id');
            
            // Unique constraint agar tidak ada duplikasi tahun akademik per prodi
            $table->unique(['tahun_akademik']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_data_mahasiswa');
    }
};