<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiDataDosen extends Model
{
    use HasFactory;

    protected $table = 'prodi_data_dosen';

    protected $fillable = [
        'nama',
        'latar_pendidikan',
        'nama_instansi_asal',
        'sertifikasi',
        'jabatan_akademik',
        'posisi_jabatan',
        'terhitung_mulai_tanggal',
        'sk_dosen_tetap',
        'status',
        'nidn',
        'nuptk',
        'doktor',
        'magister',
        'sarjana',
        'users_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'terhitung_mulai_tanggal' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}