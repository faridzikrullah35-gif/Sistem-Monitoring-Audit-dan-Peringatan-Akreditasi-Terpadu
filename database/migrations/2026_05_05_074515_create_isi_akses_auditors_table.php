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
        Schema::create('isi_akses_auditors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('setting_akses_auditor_id')
                ->constrained('setting_akses_auditors')
                ->cascadeOnDelete();

            $table->foreignId('auditor_id')
                ->constrained('data_auditor')
                ->cascadeOnDelete();

            $table->enum('posisi', ['lead_auditor', 'anggota']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_akses_auditors');
    }
};
