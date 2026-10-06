<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RasioDosenMahasiswaProdi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rasio_dosen_mahasiswa_prodi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tahun_akademik',
        'jumlah_dosen_tetap',
        'jumlah_mahasiswa',
        'rasio',
        'users_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_dosen_tetap' => 'integer',
        'jumlah_mahasiswa' => 'integer',
        'rasio' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the rasio data.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Hitung rasio secara otomatis (jika dibutuhkan).
     * Rasio = Jumlah Mahasiswa / Jumlah Dosen Tetap
     */
    public function calculateRasio(): float
    {
        if ($this->jumlah_dosen_tetap == 0) {
            return 0;
        }
        return round($this->jumlah_mahasiswa / $this->jumlah_dosen_tetap, 2);
    }

    /**
     * Boot method untuk auto-calculate rasio sebelum save.
     */
    protected static function booted()
    {
        static::saving(function ($model) {
            // Jika rasio belum diisi manual, hitung otomatis
            if (empty($model->rasio) || $model->rasio == 0) {
                $model->rasio = $model->calculateRasio();
            }
        });
    }
}