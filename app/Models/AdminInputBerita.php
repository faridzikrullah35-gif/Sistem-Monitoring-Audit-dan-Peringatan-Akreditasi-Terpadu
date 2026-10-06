<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminInputBerita extends Model
{
    use HasFactory;

    protected $table = 'admin_input_berita';

    protected $fillable = [
        'users_id',
        'nama_file',
        'thumbnail',
        'diupload_oleh',
    ];

    /**
     * User yang mengupload berita
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * File-file yang dimiliki berita
     */
    public function files()
    {
        return $this->hasMany(
            AdminInputBeritaFile::class,
            'admin_input_berita_id'
        );
    }
}