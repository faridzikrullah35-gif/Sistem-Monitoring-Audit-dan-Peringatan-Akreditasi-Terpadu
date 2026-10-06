<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakultasDataDosen extends Model
{
    use HasFactory;

    protected $table = 'fakultas_data_dosen';

    protected $fillable = [
        'users_id',
        'nama',
        'latar_pendidikan',
        'doktor',
        'magister',
        'sarjana',
        'nama_instansi_asal',
        'sertifikasi',
        'jabatan_akademik',
        'sk_dosen_tetap',
        'status',
        'nidn',
        'nuptk',
    ];

    /**
     * User yang menginput data dosen.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}