<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaAudit extends Model
{
    protected $table = 'kriteria_audit';

    protected $fillable = [
        'standar_id',
        'sub_kriteria',
    ];

    /**
     * Relasi ke Standar
     */
    public function standar()
    {
        return $this->belongsTo(Standar::class, 'standar_id');
    }
}