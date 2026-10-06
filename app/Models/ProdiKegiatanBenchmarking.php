<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiKegiatanBenchmarking extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'prodi_kegiatan_benchmarking';

    /**
     * Kolom yang dapat diisi massal
     */
    protected $fillable = [
        'users_id',
        'laporan_kegiatan',
        'file',
        'tgl_pelaksanaan',
        'keterangan',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'tgl_pelaksanaan' => 'date',
    ];

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}