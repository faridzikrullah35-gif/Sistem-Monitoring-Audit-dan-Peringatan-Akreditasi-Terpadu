<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            // Hapus unique constraint
            $table->dropUnique('audit_ptk_no_ncr_unique');
        });
    }

    public function down()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            // Kembalikan unique constraint (jika rollback)
            $table->unique('no_ncr');
        });
    }
};