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
            $table->dropColumn('discussed_with');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_terpenuhi', function (Blueprint $table) {
            $table->longText('discussed_with')->nullable()->after('pertanyaan_ami_unit_id');
        });
    }
};