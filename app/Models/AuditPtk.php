<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditPtk extends Model
{
    protected $table = 'audit_ptk';

    protected $fillable = [
        'audit_periksa_id',
        'users_id',
        'pertanyaan_ami_prodi_id',
        'pertanyaan_ami_unit_id',

        'no_ncr',
        'klausul_dokumen',
        'deskripsi_uraian_temuan',
        'kategori_temuan',
        'tanggal_selesai',
        'status_ncr',
        'analisis_penyebab',
        'akibat',

        // Kolom baru untuk PTK Auditee
        'rencana_tindakan_perbaikan_auditee',
        'tindakan_pencegahan_auditee',
        'file_auditee',
        'tanggal_target_perbaikan_auditee',
    ];

    public function auditPeriksa()
    {
        return $this->belongsTo(
            AuditPeriksa::class,
            'audit_periksa_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'users_id'
        );
    }

    public function pertanyaanAmiProdi()
    {
        return $this->belongsTo(
            PertanyaanAmiProdi::class,
            'pertanyaan_ami_prodi_id'
        );
    }

    public function pertanyaanAmiUnit()
    {
        return $this->belongsTo(
            PertanyaanAmiUnit::class,
            'pertanyaan_ami_unit_id'
        );
    }
}