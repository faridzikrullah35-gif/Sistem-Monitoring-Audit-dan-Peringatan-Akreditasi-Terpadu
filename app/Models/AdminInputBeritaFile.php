<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminInputBeritaFile extends Model
{
    use HasFactory;

    protected $table = 'admin_input_berita_files';

    protected $fillable = [
        'admin_input_berita_id',
        'users_id',
        'nama_file',
        'file',
    ];

    /**
     * Relasi ke berita
     *
     * Banyak file dimiliki oleh satu berita.
     */
    public function berita()
    {
        return $this->belongsTo(
            AdminInputBerita::class,
            'admin_input_berita_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'users_id'
        );
    }
}