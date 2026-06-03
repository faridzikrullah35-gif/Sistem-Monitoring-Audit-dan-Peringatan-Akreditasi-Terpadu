<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standar extends Model
{
    protected $table = 'standar';

    protected $fillable = [
        'nama',
    ];

    /**
     * Relasi ke sub kriteria
     */
    public function kriteria()
    {
        return $this->hasMany(KriteriaAudit::class, 'standar_id');
    }

    public function kriteriaAudit()
    {
        return $this->hasMany(KriteriaAudit::class);
    }
}