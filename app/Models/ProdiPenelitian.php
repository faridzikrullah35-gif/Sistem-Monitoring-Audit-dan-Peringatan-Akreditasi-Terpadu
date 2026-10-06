<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiPenelitian extends Model
{
    use HasFactory;

    protected $table = 'prodi_penelitian';

    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'ketua_anggota',
        'nama_dosen',
        'judul_penelitian',
        'lembaga_mitra',
        'tingkat',
        'skema',
        'sumber_dana',
        'luaran',
        'link_bukti',
    ];

    /**
     * Relasi ke tabel users.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}