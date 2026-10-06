<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingHakAksesFakultas extends Model
{
    use HasFactory;

    protected $table = 'setting_hak_akses_fakultas';

    protected $fillable = [
        'user_id',
        'fakultas',
        'sub_unit',
        'level_akses',
        'is_active',
        'keterangan',
    ];

    protected $casts = [
        'sub_unit' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}