<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin_input_berita', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }

    public function down(): void
    {
        Schema::table('admin_input_berita', function (Blueprint $table) {
            $table->string('file')->nullable();
        });
    }
};