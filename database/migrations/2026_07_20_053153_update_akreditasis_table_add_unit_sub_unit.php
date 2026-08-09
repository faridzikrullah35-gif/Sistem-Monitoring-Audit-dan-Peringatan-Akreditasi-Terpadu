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
        Schema::table('akreditasis', function (Blueprint $table) {

            $table->string('unit')->after('program');
            $table->string('sub_unit')->after('unit');

            $table->dropColumn('program_studi');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akreditasis', function (Blueprint $table) {

            $table->string('program_studi')->after('program');

            $table->dropColumn([
                'unit',
                'sub_unit'
            ]);

        });
    }
};