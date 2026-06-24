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
        Schema::table('form_terpenuhi', function (Blueprint $table) {

            $table->foreignId('audit_periksa_id')
                ->nullable()
                ->after('id')
                ->constrained('audit_periksa')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_terpenuhi', function (Blueprint $table) {

            $table->dropForeign(['audit_periksa_id']);

            $table->dropColumn('audit_periksa_id');
        });
    }
};