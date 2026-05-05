<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsiAksesAuditor extends Model
{
    protected $fillable = [
        'setting_akses_auditor_id',
        'auditor_id',
        'posisi',
    ];

    // relasi ke setting akses
    public function settingAkses()
    {
        return $this->belongsTo(SettingAksesAuditor::class);
    }

    // relasi ke auditor
    public function auditor()
    {
        return $this->belongsTo(DataAuditor::class, 'auditor_id');
    }
}