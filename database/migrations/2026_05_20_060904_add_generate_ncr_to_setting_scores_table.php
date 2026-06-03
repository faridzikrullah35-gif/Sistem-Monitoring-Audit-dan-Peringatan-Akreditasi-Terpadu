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
        Schema::table('setting_scores', function (Blueprint $table) {

            // =========================
            // AUTO GENERATE NCR/PTK
            // =========================
            $table->boolean('generate_ncr')
                ->default(false)
                ->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_scores', function (Blueprint $table) {

            $table->dropColumn('generate_ncr');
        });
    }
};