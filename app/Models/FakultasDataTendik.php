<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakultasDataTendik extends Model
{
    use HasFactory;

    protected $table = 'fakultas_data_tendik';

    protected $fillable = [
        'users_id',
        'nama',
        'latar_pendidikan',
        'sertifikasi',
        'sk_pegawai_tetap',
    ];

    /**
     * User yang menginput data tendik.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}