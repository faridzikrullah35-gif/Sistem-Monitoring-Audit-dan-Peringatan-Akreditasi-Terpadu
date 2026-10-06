<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumen_fakultas', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained('users')
                ->nullOnDelete();

            $table->index(['user_id', 'kategori']);
        });
    }

    public function down(): void
    {
        Schema::table('dokumen_fakultas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id', 'kategori']);
            $table->dropColumn('user_id');
        });
    }
};