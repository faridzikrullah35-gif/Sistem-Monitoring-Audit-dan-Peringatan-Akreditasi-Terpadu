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
        Schema::table('audit_observasi', function (Blueprint $table) {

            $table->foreignId('pertanyaan_ami_unit_id')
                ->nullable()
                ->after('pertanyaan_ami_prodi_id')
                ->constrained('pertanyaan_ami_unit')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('audit_observasi', function (Blueprint $table) {
            $table->dropForeign(['pertanyaan_ami_unit_id']);
            $table->dropColumn('pertanyaan_ami_unit_id');
        });
    }
};
