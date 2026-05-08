<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matrix extends Model
{
    protected $table = 'matrixs';

    protected $fillable = [
        'kriteria_audit_id',
        'elemen',
    ];

    public function kriteriaAudit()
    {
        return $this->belongsTo(KriteriaAudit::class, 'kriteria_audit_id');
    }

    public function indikator()
    {
        return $this->hasMany(IsiIndikator::class, 'matrixs_id');
    }

    public function isiIndikator()
    {
        return $this->hasMany(IsiIndikator::class, 'matrixs_id');
    }
}