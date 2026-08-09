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

    public function akses()
    {
        return $this->hasMany(AksesPertanyaanUnit::class, 'pertanyaan_id');
    }

    /**
     * Scope untuk auditor berdasarkan data user yang login
     */
    public function scopeForAuditor($query, $user)
    {
        return $query->whereHas('akses', function ($q) use ($user) {
            $q->where('role', $user->role)
              ->where('unit', $user->unit)
              ->where(function ($sub) use ($user) {
                  $sub->where('sub_unit', $user->sub_unit)
                      ->orWhereNull('sub_unit');
              });
        });
    }
}