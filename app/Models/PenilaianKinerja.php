<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianKinerja extends Model
{
    protected $table = 'penilaian_kinerja';

    protected $fillable = [
        'users_id',
        'isi_indikator_id',
        'deskripsi',
        'setting_score_id',
        'file_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function isiIndikator(): BelongsTo
    {
        return $this->belongsTo(IsiIndikator::class, 'isi_indikator_id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(SettingScore::class, 'setting_score_id');
    }
}