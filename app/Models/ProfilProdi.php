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
        'file',
        'tgl_penetapan',

        // DTPS
        'jumlah_magister',
        'jumlah_doktor',
        'jumlah_total',

        // Jabatan Fungsional
        'jumlah_asisten_ahli',
        'jumlah_lektor',
        'jumlah_lektor_kepala',
        'jumlah_guru_besar',

        // Mahasiswa
        'jumlah_mahasiswa',
        'tahun_akademik',
    ];

    protected $casts = [
        'jumlah_magister'       => 'integer',
        'jumlah_doktor'         => 'integer',
        'jumlah_total'          => 'integer',
        'jumlah_asisten_ahli'   => 'integer',
        'jumlah_lektor'         => 'integer',
        'jumlah_lektor_kepala'  => 'integer',
        'jumlah_guru_besar'     => 'integer',
        'jumlah_mahasiswa'      => 'integer',
        'tahun_akademik'        => 'integer',
        'tgl_penetapan'         => 'date',
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
        $totalDtps = $this->jumlah_total;

        if ($totalDtps === 0) {
            return 0;
        }

        return round($this->jumlah_mahasiswa / $totalDtps, 2);
    }
}