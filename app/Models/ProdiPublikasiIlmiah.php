<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiPublikasiIlmiah extends Model
{
    use HasFactory;

    protected $table = 'prodi_publikasi_ilmiah';

    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'nama_dosen',
        'nidn',
        'judul_artikel',
        'jenis_publikasi',
        'nama_jurnal_prosiding',
        'issn',
        'volume_no',
        'sinta_scopus',
        'penulis_ke',
        'link_artikel',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}