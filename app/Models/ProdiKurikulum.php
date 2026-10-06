<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiKurikulum extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan model ini.
     * Laravel default-nya "prodi_kurikulums" (plural dari ProdiKurikulum),
     * jadi perlu di-override.
     */
    protected $table = 'prodi_kurikulum';

    /**
     * Kolom yang boleh diisi massal.
     */
    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'dokumen',
        'tgl_penetapan',
        'peninjauan_kurikulum',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'tgl_penetapan' => 'date',
    ];

    /**
     * Relasi ke User (pemilik data).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}