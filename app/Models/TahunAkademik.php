<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $table = 'tahun_akademik';

    protected $fillable = [
        'tahun_akademik',
        'semester',
        'status',
    ];

    public function auditiees()
    {
        return $this->hasMany(Auditiee::class, 'tahun_akademik_id');
    }

}