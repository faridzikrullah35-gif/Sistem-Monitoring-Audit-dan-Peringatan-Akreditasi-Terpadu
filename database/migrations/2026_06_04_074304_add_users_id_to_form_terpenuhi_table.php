<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('form_terpenuhi', function (Blueprint $table) {
            $table->foreignId('users_id')->after('id')->constrained('users');
        });
    }

    public function down()
    {
        Schema::table('form_terpenuhi', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropColumn('users_id');
        });
    }
};