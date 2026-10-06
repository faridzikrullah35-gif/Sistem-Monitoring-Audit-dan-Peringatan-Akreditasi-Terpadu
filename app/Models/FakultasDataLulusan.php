<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakultasDataLulusan extends Model
{
    use HasFactory;

    protected $table = 'fakultas_data_lulusans';

    protected $fillable = [
        'users_id',
        'nama_prodi',
        'ta_3',
        'ta_2',
        'ta_1',
        'ta',
    ];

    protected $casts = [
        'users_id' => 'integer',
        'ta_3' => 'integer',
        'ta_2' => 'integer',
        'ta_1' => 'integer',
        'ta' => 'integer',
    ];

    protected $appends = [
        'persentase_penurunan',
    ];

    /**
     * Persentase penurunan lulusan dari TA-1 ke TA.
     *
     * Rumus:
     * ((TA-1 - TA) / TA-1) × 100
     */
    public function getPersentasePenurunanAttribute(): float
    {
        $ta1 = (int) $this->ta_1;
        $ta = (int) $this->ta;

        if ($ta1 <= 0) {
            return 0;
        }

        return round((($ta1 - $ta) / $ta1) * 100, 2);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}