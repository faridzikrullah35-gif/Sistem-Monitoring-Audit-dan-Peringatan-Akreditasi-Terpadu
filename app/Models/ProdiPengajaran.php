<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiPengajaran extends Model
{
    use HasFactory;

    // Nama tabel (karena Laravel default plural: prodi_pengajarans)
    protected $table = 'prodi_pengajaran';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'semester',
        'sk_pengajaran',
        'tgl_penetapan',
        'keterangan',
    ];

    // Casting tipe data
    protected $casts = [
        'tgl_penetapan' => 'date',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}