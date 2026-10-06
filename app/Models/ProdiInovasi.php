<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiInovasi extends Model
{
    use HasFactory;

    protected $table = 'prodi_inovasi';

    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'nama_dosen',
        'nama_inovasi',
        'jenis_inovasi',
        'hki',
        'nomor_hki',
        'produk_prototype',
        'pengguna_mitra',
        'link_bukti'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Scope filters
    public function scopeTahunAkademik($query, $tahun)
    {
        return $query->where('tahun_akademik', $tahun);
    }

    public function scopeJenisInovasi($query, $jenis)
    {
        return $query->where('jenis_inovasi', $jenis);
    }

    // Accessor untuk badge warna (opsional)
    public function getHkiLabelAttribute(): string
    {
        return $this->hki ?: '-';
    }

    public function getHasLinkBuktiAttribute(): bool
    {
        return !empty($this->link_bukti);
    }
}