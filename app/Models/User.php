<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}