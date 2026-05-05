<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_auditor', function (Blueprint $table) {
            // rename kolom nidn → identity_number
            $table->renameColumn('nidn', 'identity_number');
        });

        Schema::table('data_auditor', function (Blueprint $table) {
            // tambahin type
            $table->enum('identity_type', ['nidn', 'nik'])
                  ->after('identity_number')
                  ->default('nidn');
        });
    }

    public function down(): void
    {
        Schema::table('data_auditor', function (Blueprint $table) {
            $table->dropColumn('identity_type');
        });

        Schema::table('data_auditor', function (Blueprint $table) {
            $table->renameColumn('identity_number', 'nidn');
        });
    }
};