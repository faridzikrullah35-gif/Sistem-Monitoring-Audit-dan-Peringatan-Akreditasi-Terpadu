<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenFakultas extends Model
{
    use HasFactory;

    protected $table = 'dokumen_fakultas';

    protected $fillable = [
        'user_id',
        'kategori',
        'nama_dokumen',
        'tanggal_penetapan',
        'tanggal_revisi',
        'keterangan',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
    ];

    protected $casts = [
        'tanggal_penetapan' => 'date',
        'tanggal_revisi' => 'date',
        'file_size' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}