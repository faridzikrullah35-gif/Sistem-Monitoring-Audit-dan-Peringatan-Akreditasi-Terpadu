<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenProdi extends Model
{
    use HasFactory;

    protected $table = 'dokumen_prodi';

    protected $fillable = [
        'profil_prodi_id',
        'jenis',
        'nama_dokumen',
        'file',
        'tanggal_penetapan',
        'tanggal_revisi',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_penetapan' => 'date',
        'tanggal_revisi' => 'date',
    ];

    public function profil()
    {
        return $this->belongsTo(ProfilProdi::class);
    }
}