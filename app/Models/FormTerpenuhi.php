<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormTerpenuhi extends Model
{
    use HasFactory;

    protected $table = 'form_terpenuhi';

    protected $fillable = [
        'audit_periksa_id',
        'users_id',
        'kriteria_id',
        'matrixs_id',
        'isi_indikator_id',
        'pertanyaan_ami_prodi_id',
        'pertanyaan_ami_unit_id',
        'discussed_with',
        'rekomendasi',
    ];

    // Relasi (sama seperti FormObservasi)
    public function pertanyaanAmiProdi()
    {
        return $this->belongsTo(PertanyaanAmiProdi::class, 'pertanyaan_ami_prodi_id');
    }

    public function pertanyaanAmiUnit()
    {
        return $this->belongsTo(PertanyaanAmiUnit::class, 'pertanyaan_ami_unit_id');
    }

    public function isiIndikator()
    {
        return $this->belongsTo(IsiIndikator::class, 'isi_indikator_id');
    }

    public function kriteriaAudit()
    {
        return $this->belongsTo(KriteriaAudit::class, 'kriteria_id');
    }

    public function matrix()
    {
        return $this->belongsTo(Matrix::class, 'matrixs_id');
    }

    public function auditPeriksa()
    {
        return $this->belongsTo(AuditPeriksa::class, 'audit_periksa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}