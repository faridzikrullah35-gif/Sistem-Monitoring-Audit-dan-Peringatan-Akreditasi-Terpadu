<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_observasi', function (Blueprint $table) {

            $table->longText('discussed_with')
                ->nullable()
                ->change();

            $table->longText('rekomendasi')
                ->nullable()
                ->change();

            $table->string('status_observasi')
                ->nullable()
                ->change();

            $table->text('catatan')
                ->nullable()
                ->change();

            $table->string('kategori_observasi')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('audit_observasi', function (Blueprint $table) {

            $table->longText('discussed_with')
                ->nullable(false)
                ->change();

            $table->longText('rekomendasi')
                ->nullable(false)
                ->change();

            $table->string('status_observasi')
                ->nullable(false)
                ->change();

            $table->text('catatan')
                ->nullable(false)
                ->change();

            $table->string('kategori_observasi')
                ->nullable(false)
                ->change();
        });
    }
};
