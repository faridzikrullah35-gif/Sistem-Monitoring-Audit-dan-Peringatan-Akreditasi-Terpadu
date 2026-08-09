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
        return $this->belongsTo(
            IsiIndikator::class,
            'isi_indikator_id'
        );
    }

    // Relasi ke Tahun Akademik
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
        return $this->hasMany(AksesPertanyaanProdi::class, 'pertanyaan_id');
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
                // Kalau sub_unit di akses null, artinya berlaku untuk semua sub_unit di unit tsb
                $sub->where('sub_unit', $user->sub_unit)
                    ->orWhereNull('sub_unit');
            });
        });
    }
}