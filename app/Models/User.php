<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'unit',
        'sub_unit',
        'phone',
        'password',
        'role',
        'bio',
        'country',
        'city',
        'postal_code',
        'tax_id',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Menentukan apakah user memiliki akses Admin.
     *
     * Admin asli:
     * - role = admin
     *
     * Admin LPM:
     * - role = unit_kerja
     * - unit = LPM
     */
    public function isAdminAccess(): bool
    {
        return $this->role === 'admin'
            || (
                $this->role === 'unit_kerja'
                && strtoupper(trim($this->unit ?? '')) === 'LPM'
            );
    }

    // ACCESSOR FOTO (biar clean di blade)
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }

    // Relasi ke auditiee
    public function auditiees()
    {
        return $this->hasMany(Auditiee::class, 'users_id');
    }

    public function settingAksesAuditor()
    {
        return $this->hasOne(SettingAksesAuditor::class, 'user_id');
    }

    /**
     * RELASI KE SETTING HAK AKSES FAKULTAS
     * ============================================
     */
    
    // Relasi ke setting hak akses fakultas (one to many karena satu user bisa punya banyak akses)
    public function settingHakAksesFakultas(): HasMany
    {
        return $this->hasMany(SettingHakAksesFakultas::class);
    }

    /**
     * METHOD UNTUK CEK AKSES FAKULTAS
     * ============================================
     */

    /**
     * Ambil scope akses untuk user fakultas
     * 
     * @return array
     */
    public function getScopeAksesFakultas(): array
    {
        // Jika admin, akses semua
        if ($this->role === 'admin') {
            return ['all'];
        }

        // Jika role fakultas, ambil dari tabel setting
        if ($this->role === 'fakultas') {
            return $this->settingHakAksesFakultas()
                        ->where('is_active', true)
                        ->get()
                        ->map(function ($akses) {
                            return [
                                'fakultas' => $akses->fakultas,
                                'sub_unit' => $akses->sub_unit,
                                'level_akses' => $akses->level_akses,
                            ];
                        })
                        ->toArray();
        }

        // Untuk role lain (auditor, prodi, unit_kerja)
        // Ambil dari data user langsung
        return [
            [
                'fakultas' => $this->unit,
                'sub_unit' => $this->sub_unit,
                'level_akses' => $this->role === 'auditor' ? 'read' : 'write',
            ]
        ];
    }

    /**
     * Cek apakah user punya akses ke sub_unit tertentu
     * 
     * @param string $subUnit
     * @return bool
     */
    public function canAccessSubUnit($subUnit): bool
    {
        // Jika sub_unit null atau kosong, return false
        if (empty($subUnit)) {
            return false;
        }

        // Admin bisa akses semua
        if ($this->role === 'admin') {
            return true;
        }

        // Role fakultas
        if ($this->role === 'fakultas') {
            return $this->settingHakAksesFakultas()
                        ->where('is_active', true)
                        ->get()
                        ->contains(function ($akses) use ($subUnit) {
                            // Jika sub_unit NULL, berarti akses ke semua
                            if (is_null($akses->sub_unit)) {
                                return true;
                            }
                            return $akses->sub_unit === $subUnit;
                        });
        }

        // Untuk role lain (auditor, prodi, unit_kerja)
        return $this->sub_unit === $subUnit;
    }

    /**
     * Ambil daftar sub_unit yang boleh diakses
     * 
     * @return array
     */
    public function getDaftarSubUnitDiizinkan(): array
    {
        // Admin bisa akses semua sub_unit dari database
        if ($this->role === 'admin') {
            return User::whereNotNull('sub_unit')
                       ->distinct()
                       ->pluck('sub_unit')
                       ->toArray();
        }

        // Role fakultas
        if ($this->role === 'fakultas') {
            $allowed = $this->settingHakAksesFakultas()
                            ->where('is_active', true)
                            ->get()
                            ->map(function ($akses) {
                                // Jika sub_unit NULL, ambil SEMUA sub_unit dari fakultas tersebut
                                if (is_null($akses->sub_unit)) {
                                    return User::where('unit', $akses->fakultas)
                                               ->whereNotNull('sub_unit')
                                               ->distinct()
                                               ->pluck('sub_unit')
                                               ->toArray();
                                }
                                return [$akses->sub_unit];
                            })
                            ->flatten()
                            ->unique()
                            ->filter() // Hapus nilai null/empty
                            ->values()
                            ->toArray();

            return $allowed;
        }

        // Untuk role lain (auditor, prodi, unit_kerja)
        return $this->sub_unit ? [$this->sub_unit] : [];
    }

    /**
     * Cek apakah user punya akses ke fakultas tertentu
     * 
     * @param string $fakultasName
     * @return bool
     */
    public function canAccessFakultas($fakultasName): bool
    {
        if (empty($fakultasName)) {
            return false;
        }

        // Admin bisa akses semua
        if ($this->role === 'admin') {
            return true;
        }

        // Role fakultas
        if ($this->role === 'fakultas') {
            return $this->settingHakAksesFakultas()
                        ->where('is_active', true)
                        ->where('fakultas', $fakultasName)
                        ->exists();
        }

        // Untuk role lain
        return $this->unit === $fakultasName;
    }

    /**
     * Cek apakah user punya akses write ke sub_unit tertentu
     * 
     * @param string $subUnit
     * @return bool
     */
    public function canWriteSubUnit($subUnit): bool
    {
        if (empty($subUnit)) {
            return false;
        }

        // Admin bisa write semua
        if ($this->role === 'admin') {
            return true;
        }

        // Role fakultas
        if ($this->role === 'fakultas') {
            return $this->settingHakAksesFakultas()
                        ->where('is_active', true)
                        ->get()
                        ->contains(function ($akses) use ($subUnit) {
                            // Cek akses write/admin
                            if (!in_array($akses->level_akses, ['write', 'admin'])) {
                                return false;
                            }
                            // Cek sub_unit
                            if (is_null($akses->sub_unit)) {
                                return true;
                            }
                            return $akses->sub_unit === $subUnit;
                        });
        }

        // Untuk role lain, cek role-nya
        return in_array($this->role, ['fakultas', 'admin']) || 
               ($this->sub_unit === $subUnit && $this->role !== 'auditor');
    }

    /**
     * Cek apakah user adalah admin di fakultas tertentu
     * 
     * @param string $fakultasName
     * @return bool
     */
    public function isAdminFakultas($fakultasName): bool
    {
        if (empty($fakultasName)) {
            return false;
        }

        if ($this->role === 'admin') {
            return true;
        }

        if ($this->role === 'fakultas') {
            return $this->settingHakAksesFakultas()
                        ->where('is_active', true)
                        ->where('fakultas', $fakultasName)
                        ->where('level_akses', 'admin')
                        ->exists();
        }

        return false;
    }

    /**
     * Ambil daftar fakultas yang bisa diakses
     * 
     * @return array
     */
    public function getDaftarFakultasDiizinkan(): array
    {
        if ($this->role === 'admin') {
            // Admin bisa akses semua fakultas yang ada di database
            return User::whereNotNull('unit')
                       ->distinct()
                       ->pluck('unit')
                       ->toArray();
        }

        if ($this->role === 'fakultas') {
            return $this->settingHakAksesFakultas()
                        ->where('is_active', true)
                        ->distinct()
                        ->pluck('fakultas')
                        ->toArray();
        }

        // Untuk role lain
        return $this->unit ? [$this->unit] : [];
    }

    /**
     * Scope query untuk filter berdasarkan sub_unit yang diizinkan
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column Nama kolom yang difilter (misal: 'sub_unit')
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByAllowedSubUnits($query, $column = 'sub_unit')
    {
        $allowedSubUnits = $this->getDaftarSubUnitDiizinkan();
        
        if (empty($allowedSubUnits)) {
            // Jika tidak ada akses, return empty result
            return $query->whereRaw('1 = 0');
        }

        if ($this->role === 'admin') {
            // Admin ga perlu filter
            return $query;
        }

        return $query->whereIn($column, $allowedSubUnits);
    }

    public function profilProdi()
    {
        return $this->hasOne(ProfilProdi::class, 'user_id');
    }
}