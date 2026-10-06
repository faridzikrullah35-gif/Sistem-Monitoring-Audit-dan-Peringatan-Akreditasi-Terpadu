<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RasioDosenMahasiswaFakultas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rasio_dosen_mahasiswa_fakultas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_tahun_akademik',
        'jumlah_dosen',
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
        'id_tahun_akademik' => 'integer',
        'jumlah_dosen' => 'integer',
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
     * Get the tahun akademik associated with the rasio data.
     */
    public function tahunAkademik(): BelongsTo
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }

    /**
     * Hitung rasio secara otomatis.
     *
     * Rasio = Jumlah Mahasiswa / Jumlah Dosen
     */
    public function calculateRasio(): float
    {
        if ($this->jumlah_dosen == 0) {
            return 0;
        }

        return round(
            $this->jumlah_mahasiswa / $this->jumlah_dosen,
            2
        );
    }

    /**
     * Boot method untuk auto-calculate rasio sebelum save.
     */
    protected static function booted()
    {
        static::saving(function ($model) {

            // Jika rasio belum diisi manual,
            // hitung otomatis dari jumlah mahasiswa dan jumlah dosen.
            if (empty($model->rasio) || $model->rasio == 0) {
                $model->rasio = $model->calculateRasio();
            }
        });
    }
}