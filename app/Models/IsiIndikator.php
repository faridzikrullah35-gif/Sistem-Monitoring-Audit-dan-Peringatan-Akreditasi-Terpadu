<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsiIndikator extends Model
{
    protected $table = 'isi_indikator';

    protected $fillable = [
        'matrixs_id',
        'indikator',
    ];

    // Relasi ke Matrix
    public function matrix()
    {
        return $this->belongsTo(Matrix::class, 'matrixs_id');
    }

    public function pertanyaanAmiProdi()
    {
        return $this->hasMany(PertanyaanAmiProdi::class, 'isi_indikator_id');
    }
}