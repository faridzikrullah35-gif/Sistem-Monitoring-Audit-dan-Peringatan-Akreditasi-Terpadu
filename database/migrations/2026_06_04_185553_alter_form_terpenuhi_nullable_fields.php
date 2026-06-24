<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_terpenuhi', function (Blueprint $table) {

            $table->text('discussed_with')
                ->nullable()
                ->change();

            $table->text('rekomendasi')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('form_terpenuhi', function (Blueprint $table) {

            $table->text('discussed_with')
                ->nullable(false)
                ->change();

            $table->text('rekomendasi')
                ->nullable(false)
                ->change();
        });
    }
};