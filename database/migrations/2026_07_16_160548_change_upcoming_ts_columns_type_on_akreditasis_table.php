<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE akreditasis
            MODIFY upcoming_ts3 VARCHAR(255) NULL,
            MODIFY upcoming_ts2 VARCHAR(255) NULL,
            MODIFY upcoming_ts1 VARCHAR(255) NULL,
            MODIFY upcoming_ts  VARCHAR(255) NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE akreditasis
            MODIFY upcoming_ts3 DATE NULL,
            MODIFY upcoming_ts2 DATE NULL,
            MODIFY upcoming_ts1 DATE NULL,
            MODIFY upcoming_ts DATE NULL
        ");
    }
};