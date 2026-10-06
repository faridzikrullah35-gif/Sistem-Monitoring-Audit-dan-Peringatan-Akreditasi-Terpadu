<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiPrestasiAkademikMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'prodi_prestasi_akademik_mahasiswa';

    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'nama_kegiatan',
        'waktu_perolehan',
        'tingkat',
        'prestasi_dicapai',
        'link' // Added link to fillable
    ];

    protected $casts = [
        'waktu_perolehan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the prestasi.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Scope a query to filter by tahun akademik.
     */
    public function scopeTahunAkademik($query, $tahun)
    {
        return $query->where('tahun_akademik', $tahun);
    }

    /**
     * Scope a query to filter by tingkat.
     */
    public function scopeTingkat($query, $tingkat)
    {
        return $query->where('tingkat', $tingkat);
    }

    /**
     * Scope a query to filter by waktu perolehan.
     */
    public function scopeWaktuPerolehan($query, $tahun)
    {
        return $query->where('waktu_perolehan', $tahun);
    }

    /**
     * Scope a query to filter by dosen.
     */
    public function scopeDosen($query, $dosenId)
    {
        return $query->where('users_id', $dosenId);
    }

    /**
     * Accessor for tingkat badge color.
     */
    public function getTingkatBadgeAttribute(): string
    {
        return match ($this->tingkat) {
            'Internasional' => 'purple',
            'Nasional' => 'blue',
            'Lokal/Wilayah' => 'green',
            default => 'gray',
        };
    }

    /**
     * Get formatted tahun akademik.
     */
    public function getTahunAkademikFormattedAttribute(): string
    {
        return $this->tahun_akademik;
    }

    /**
     * Get formatted waktu perolehan.
     */
    public function getWaktuPerolehanFormattedAttribute(): string
    {
        return (string) $this->waktu_perolehan;
    }

    /**
     * Get the link with a default value if null.
     */
    public function getLinkAttribute($value): string
    {
        return $value ?? '#';
    }

    /**
     * Check if link exists and is valid.
     */
    public function hasLink(): bool
    {
        return !empty($this->link) && $this->link !== '#';
    }
}