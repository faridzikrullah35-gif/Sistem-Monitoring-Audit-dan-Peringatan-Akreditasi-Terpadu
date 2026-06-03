<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            $table->unsignedBigInteger('audit_periksa_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            $table->unsignedBigInteger('audit_periksa_id')->nullable(false)->change();
        });
    }
};