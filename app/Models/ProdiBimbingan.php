<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiBimbingan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'prodi_bimbingan';

    /**
     * Kolom yang dapat diisi (mass assignable).
     */
    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'semester',
        'file',
        'tgl_penetapan',
        'keterangan',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'tgl_penetapan' => 'date',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}