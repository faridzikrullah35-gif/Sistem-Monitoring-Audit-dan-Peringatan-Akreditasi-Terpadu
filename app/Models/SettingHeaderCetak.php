<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingHeaderCetak extends Model
{
    protected $table = 'setting_header_cetak';

    protected $fillable = [
        'no_dokumen',
        'tanggal_terbit',
        'no_revisi',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];
}