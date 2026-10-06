<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            /*
             * parent_id:
             * Menentukan siapa atasan dari struktur ini.
             *
             * NULL = struktur paling atas / root.
             */
            $table->foreignId('parent_id')
                ->nullable()
                ->after('users_id')
                ->constrained('struktur_organisasi')
                ->nullOnDelete();

            /*
             * Menentukan apakah struktur ditampilkan
             * pada struktur organisasi publik.
             */
            $table->boolean('is_active')
                ->default(true)
                ->after('urutan');

            /*
             * Index untuk mempercepat pencarian
             * berdasarkan parent.
             */
            $table->index('parent_id');
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropColumn(['parent_id', 'is_active']);
        });
    }
};