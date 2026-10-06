<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'struktur_organisasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'parent_id',
        'nama',
        'jabatan',
        'foto',
        'urutan',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'parent_id' => 'integer',
        'urutan' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke User
     * (admin yang menginput data).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Relasi ke parent / atasan.
     *
     * Contoh:
     * Sekretaris -> parent = Ketua LPM
     */
    public function parent()
    {
        return $this->belongsTo(
            StrukturOrganisasi::class,
            'parent_id'
        );
    }

    /**
     * Relasi ke children / bawahan.
     *
     * Contoh:
     * Ketua LPM -> children = Sekretaris, Kepala Divisi, dst.
     */
    public function children()
    {
        return $this->hasMany(
            StrukturOrganisasi::class,
            'parent_id'
        )->orderBy('urutan', 'asc');
    }

    /**
     * Scope untuk mengurutkan berdasarkan urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Scope untuk mengambil struktur yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor untuk URL foto.
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset(
                'storage/struktur_organisasi/' . $this->foto
            );
        }

        return asset('images/default-avatar.png');
    }
}