<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            $table->text('rencana_tindakan_perbaikan_auditee')->nullable()->after('status_ncr');
            $table->text('tindakan_pencegahan_auditee')->nullable()->after('rencana_tindakan_perbaikan_auditee');
            $table->string('file_auditee', 255)->nullable()->after('tindakan_pencegahan_auditee');
            $table->date('tanggal_target_perbaikan_auditee')->nullable()->after('file_auditee');
        });
    }

    public function down()
    {
        Schema::table('audit_ptk', function (Blueprint $table) {
            $table->dropColumn([
                'rencana_tindakan_perbaikan_auditee',
                'tindakan_pencegahan_auditee',
                'file_auditee',
                'tanggal_target_perbaikan_auditee',
            ]);
        });
    }
};