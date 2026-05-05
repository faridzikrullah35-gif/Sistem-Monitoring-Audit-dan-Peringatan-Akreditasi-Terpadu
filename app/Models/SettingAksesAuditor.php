<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingAksesAuditor extends Model
{
    protected $fillable = [
        'user_id',
        'tgl_audit',
        'tahun_akademik_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function isiAkses()
    {
        return $this->hasMany(IsiAksesAuditor::class);
    }

}