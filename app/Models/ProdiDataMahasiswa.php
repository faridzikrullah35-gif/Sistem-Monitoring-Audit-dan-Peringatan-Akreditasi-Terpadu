<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiDataMahasiswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prodi_data_mahasiswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tahun_akademik',
        'ta_6',
        'ta_5',
        'ta_4',
        'ta_3',
        'ta_2',
        'ta_1',
        'ta',
        'lulusan_akhir_ta',
        'users_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ta_6' => 'integer',
        'ta_5' => 'integer',
        'ta_4' => 'integer',
        'ta_3' => 'integer',
        'ta_2' => 'integer',
        'ta_1' => 'integer',
        'ta' => 'integer',
        'lulusan_akhir_ta' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the data mahasiswa.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get total mahasiswa from all years.
     */
    public function getTotalMahasiswaAttribute(): int
    {
        return $this->ta_6 + $this->ta_5 + $this->ta_4 + $this->ta_3 + $this->ta_2 + $this->ta_1 + $this->ta;
    }

    /**
     * Get all tahun akademik labels as array.
     */
    public static function getTahunAkademikLabels(): array
    {
        return ['TA-6', 'TA-5', 'TA-4', 'TA-3', 'TA-2', 'TA-1', 'TA'];
    }

    /**
     * Scope a query to filter by tahun akademik.
     */
    public function scopeByTahunAkademik($query, string $tahun)
    {
        return $query->where('tahun_akademik', $tahun);
    }

    /**
     * Scope a query to filter by user.
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('users_id', $userId);
    }
}