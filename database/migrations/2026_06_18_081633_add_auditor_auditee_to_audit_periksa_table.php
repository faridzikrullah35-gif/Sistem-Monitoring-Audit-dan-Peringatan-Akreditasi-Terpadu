<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('audit_periksa', function (Blueprint $table) {
            $table->foreignId('auditor_id')->nullable()->after('users_id');
            $table->foreignId('auditee_id')->nullable()->after('auditor_id');

            $table->index('auditor_id');
            $table->index('auditee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_periksa', function (Blueprint $table) {
            $table->foreignId('auditor_id')->nullable()->after('users_id');
            $table->foreignId('auditee_id')->nullable()->after('auditor_id');

            $table->index('auditor_id');
            $table->index('auditee_id');
        });
    }
};
