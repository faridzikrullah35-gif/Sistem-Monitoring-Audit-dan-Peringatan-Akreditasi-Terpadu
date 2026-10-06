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
        Schema::table('setting_header_cetak', function (Blueprint $table) {
            $table->dropForeign(['auditor_id']);
            $table->dropColumn(['auditor_id', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_header_cetak', function (Blueprint $table) {
            $table->unsignedBigInteger('auditor_id')->nullable();
            $table->string('role')->nullable();

            $table->foreign('auditor_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }
};