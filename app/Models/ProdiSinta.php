<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiSinta extends Model
{
    protected $table = 'prodi_sinta';

    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'dosen_terdata_sinta',
        'sinta_score_3_tahun',
        'sinta_score_overall',
        'index',
        'link_sinta',
    ];

    protected $casts = [
        'sinta_score_3_tahun' => 'decimal:2',
        'sinta_score_overall' => 'decimal:2',
        'index' => 'decimal:2',
    ];

    /**
     * Relasi ke user/prodi.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}