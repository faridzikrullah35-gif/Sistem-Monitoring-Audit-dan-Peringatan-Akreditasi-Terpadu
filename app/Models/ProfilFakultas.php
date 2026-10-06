<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilFakultas extends Model
{
    use HasFactory;

    protected $table = 'profil_fakultas';

    protected $fillable = [
        'user_id',

        'visi',
        'misi',
        'tujuan',
        'sasaran',
        'file',
        'tgl_penetapan',

        'jumlah_magister',
        'jumlah_doktor',
        'jumlah_total',

        'jumlah_asisten_ahli',
        'jumlah_lektor',
        'jumlah_lektor_kepala',
        'jumlah_guru_besar',

        'jumlah_mahasiswa',
        'tahun_akademik',
    ];

    protected $casts = [
        'jumlah_magister'      => 'integer',
        'jumlah_doktor'        => 'integer',
        'jumlah_total'         => 'integer',

        'jumlah_asisten_ahli'  => 'integer',
        'jumlah_lektor'        => 'integer',
        'jumlah_lektor_kepala' => 'integer',
        'jumlah_guru_besar'    => 'integer',

        'jumlah_mahasiswa'     => 'integer',

        'tgl_penetapan'        => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}