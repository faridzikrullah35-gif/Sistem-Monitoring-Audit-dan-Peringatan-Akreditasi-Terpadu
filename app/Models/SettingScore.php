<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingScore extends Model
{
    protected $table = 'setting_scores';

    protected $fillable = [
        'nilai_score',
        'keterangan',
        'generate_ncr',
    ];
}