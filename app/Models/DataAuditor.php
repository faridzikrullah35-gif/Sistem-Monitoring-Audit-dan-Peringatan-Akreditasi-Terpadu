<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAuditor extends Model
{
    use HasFactory;

    protected $table = 'data_auditor';

    protected $fillable = [
        'identity_number',
        'identity_type',
        'nama_auditor',
        'unit',
        'sub_unit',
        'tahun_aktif',
        'status',
        'tahun_non_aktif',
    ];

    public function isiAksesAuditors()
    {
        return $this->hasMany(IsiAksesAuditor::class, 'auditor_id');
    }
}