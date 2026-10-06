<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingProfileAdmin extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'setting_profile_admin';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'users_id',
        'dibuat_oleh',
        'deskripsi',
        'visi',
        'misi',
        'tujuan',
        'sasaran',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke model User (admin yang menginput).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Scope untuk mendapatkan konten yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Mendapatkan konten aktif (singleton).
     */
    public static function getActive()
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Accessor untuk menampilkan nama pembuat.
     */
    public function getPembuatAttribute()
    {
        if ($this->dibuat_oleh) {
            return $this->dibuat_oleh;
        }
        return $this->user ? $this->user->name : 'Tidak diketahui';
    }
}