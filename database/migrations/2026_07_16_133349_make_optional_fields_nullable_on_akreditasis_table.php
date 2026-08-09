<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('akreditasis', function (Blueprint $table) {
            $table->string('status_akreditasi')->nullable()->change();

            $table->integer('sisa_kadaluarsa')->nullable()->change();

            $table->date('upcoming_ts3')->nullable()->change();
            $table->date('upcoming_ts2')->nullable()->change();
            $table->date('upcoming_ts1')->nullable()->change();
            $table->date('upcoming_ts')->nullable()->change();

            $table->date('tanggal_pendampingan')->nullable()->change();

            $table->string('led')->nullable()->change();
            $table->string('lkpt')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('akreditasis', function (Blueprint $table) {
            $table->string('status_akreditasi')->nullable(false)->change();

            $table->integer('sisa_kadaluarsa')->nullable(false)->change();

            $table->date('upcoming_ts3')->nullable(false)->change();
            $table->date('upcoming_ts2')->nullable(false)->change();
            $table->date('upcoming_ts1')->nullable(false)->change();
            $table->date('upcoming_ts')->nullable(false)->change();

            $table->date('tanggal_pendampingan')->nullable(false)->change();

            $table->string('led')->nullable(false)->change();
            $table->string('lkpt')->nullable(false)->change();
        });
    }
};