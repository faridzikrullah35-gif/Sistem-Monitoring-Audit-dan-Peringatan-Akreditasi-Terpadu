<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auditiee extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'tahun_akademik_id',
        'nama_auditiee',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relasi ke tahun akademik
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }
}