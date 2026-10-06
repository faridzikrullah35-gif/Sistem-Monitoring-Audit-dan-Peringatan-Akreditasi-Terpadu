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
        Schema::create('prodi_data_lulusan', function (Blueprint $table) {
            $table->id();

            // Nama Prodi
            $table->string('nama_prodi', 100)->nullable()->comment('Nama program studi');

            // Jumlah Lulusan per tahun akademik
            $table->integer('ta_3')->default(0)->comment('Jumlah lulusan TA-3');
            $table->integer('ta_2')->default(0)->comment('Jumlah lulusan TA-2');
            $table->integer('ta_1')->default(0)->comment('Jumlah lulusan TA-1');
            $table->integer('ta')->default(0)->comment('Jumlah lulusan TA (tahun sekarang)');

            // Persentase Penurunan
            $table->decimal('persentase_penurunan', 8, 2)->default(0)->comment('Persentase penurunan lulusan');

            // Foreign key ke users (siapa yang menginput)
            $table->foreignId('users_id')->nullable()->constrained('users')->onDelete('set null');

            // Timestamps
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('nama_prodi');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi_data_lulusan');
    }
};