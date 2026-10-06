<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiDataLulusan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prodi_data_lulusan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_prodi',
        'ta_3',
        'ta_2',
        'ta_1',
        'ta',
        'persentase_penurunan',
        'users_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ta_3' => 'integer',
        'ta_2' => 'integer',
        'ta_1' => 'integer',
        'ta' => 'integer',
        'persentase_penurunan' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the data lulusan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get total lulusan from all years.
     */
    public function getTotalLulusanAttribute(): int
    {
        return $this->ta_3 + $this->ta_2 + $this->ta_1 + $this->ta;
    }

    /**
     * Hitung persentase penurunan otomatis dari TA-1 ke TA.
     * Rumus: ((TA-1 - TA) / TA-1) * 100
     */
    public function calculatePersentasePenurunan(): float
    {
        if ($this->ta_1 == 0) {
            return 0;
        }
        $penurunan = $this->ta_1 - $this->ta;
        return round(($penurunan / $this->ta_1) * 100, 2);
    }

    /**
     * Boot method untuk auto-calculate persentase penurunan sebelum save.
     */
    protected static function booted()
    {
        static::saving(function ($model) {
            // Jika persentase_penurunan belum diisi manual, hitung otomatis
            if (empty($model->persentase_penurunan) || $model->persentase_penurunan == 0) {
                $model->persentase_penurunan = $model->calculatePersentasePenurunan();
            }
        });
    }
}