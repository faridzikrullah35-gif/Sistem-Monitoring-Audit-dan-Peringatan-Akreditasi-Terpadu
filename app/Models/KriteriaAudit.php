<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaAudit extends Model
{
    protected $table = 'kriteria_audit';

    protected $fillable = [
        'standar_id',
    ];

    /**
     * Relasi ke Standar
     */
    public function standar()
    {
        return $this->belongsTo(Standar::class);
    }

    public function matrixs()
    {
        return $this->hasMany(Matrix::class, 'kriteria_audit_id');
    }
}