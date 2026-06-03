<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanAmiUnit extends Model
{
    protected $table = 'pertanyaan_ami_unit';

    protected $fillable = [
        'isi_indikator_id',
        'tahun_akademik_id',
    ];

    public function isiIndikator()
    {
        return $this->belongsTo(IsiIndikator::class);
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function indikator()
    {
        return $this->belongsTo(
            IsiIndikator::class,
            'isi_indikator_id'
        );
    }
}