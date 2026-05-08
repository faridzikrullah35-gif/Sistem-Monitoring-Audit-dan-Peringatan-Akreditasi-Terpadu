<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanAmiProdi extends Model
{
    protected $table = 'pertanyaan_ami_prodi';

    protected $fillable = [
        'isi_indikator_id',
        'tahun_akademik_id',
    ];

    // Relasi ke IsiIndikator
    public function isiIndikator()
    {
        return $this->belongsTo(IsiIndikator::class);
    }

    // Relasi ke Tahun Akademik
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }
}