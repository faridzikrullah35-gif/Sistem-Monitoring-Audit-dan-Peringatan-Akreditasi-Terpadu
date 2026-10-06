<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiPKM extends Model
{
    use HasFactory;

    protected $table = 'prodi_pkm';

    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'nama_dosen',
        'nidn',
        'judul_pkm',
        'lokasi_mitra',
        'tingkat',
        'sumber_dana',
        'melibatkan_mahasiswa',
        'luaran',
        'link_bukti'
    ];

    protected $casts = [
        'melibatkan_mahasiswa' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the PKM.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Scope a query to filter by tingkat.
     */
    public function scopeTingkat($query, $tingkat)
    {
        return $query->where('tingkat', $tingkat);
    }

    /**
     * Scope a query to filter by tahun akademik.
     */
    public function scopeTahunAkademik($query, $tahun)
    {
        return $query->where('tahun_akademik', $tahun);
    }

    /**
     * Scope a query to filter by dosen.
     */
    public function scopeDosen($query, $dosenId)
    {
        return $query->where('users_id', $dosenId);
    }

    /**
     * Scope a query to filter by melibatkan mahasiswa.
     */
    public function scopeMelibatkanMahasiswa($query, $value = true)
    {
        return $query->where('melibatkan_mahasiswa', $value);
    }

    /**
     * Accessor for tingkat with badge color.
     */
    public function getTingkatBadgeAttribute(): string
    {
        return match ($this->tingkat) {
            'Internasional' => 'purple',
            'Nasional' => 'blue',
            'Lokal' => 'green',
            default => 'gray',
        };
    }

    /**
     * Accessor for melibatkan mahasiswa text.
     */
    public function getMelibatkanMahasiswaTextAttribute(): string
    {
        return $this->melibatkan_mahasiswa ? 'Ya' : 'Tidak';
    }

    /**
     * Accessor for melibatkan mahasiswa badge.
     */
    public function getMelibatkanMahasiswaBadgeAttribute(): string
    {
        return $this->melibatkan_mahasiswa ? 'success' : 'danger';
    }

    /**
     * Get formatted tahun akademik.
     */
    public function getTahunAkademikFormattedAttribute(): string
    {
        return $this->tahun_akademik;
    }

    /**
     * Check if link bukti exists.
     */
    public function getHasLinkBuktiAttribute(): bool
    {
        return !empty($this->link_bukti);
    }
}