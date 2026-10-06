<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiSosialMedia extends Model
{
    protected $table = 'prodi_sosial_media';

    protected $fillable = [
        'users_id',
        'instagram',
        'facebook',
        'youtube',
        'tiktok',
        'linkedin',
        'website',
    ];

    /**
     * Relasi ke User/Prodi.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}