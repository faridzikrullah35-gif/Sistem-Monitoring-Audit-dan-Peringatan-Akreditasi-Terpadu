<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilProdi extends Model
{
    use HasFactory;

    protected $table = 'profil_prodi';

    protected $fillable = [
        'user_id',
        'visi',
        'misi',
        'tujuan',
        'sasaran',
        'jumlah_dtps_magister',
        'jumlah_dtps_doktor',
        'jumlah_aa',
        'jumlah_lk',
        'jumlah_gb',
        'jumlah_mahasiswa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenProdi::class);
    }

    public function getRasioAttribute()
    {
        $totalDtps = $this->jumlah_dtps_magister + $this->jumlah_dtps_doktor;

        if ($totalDtps === 0) {
            return 0;
        }

        return round($this->jumlah_mahasiswa / $totalDtps, 2);
    }
}