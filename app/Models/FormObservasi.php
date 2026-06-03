<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormObservasi extends Model
{
    protected $table = 'audit_observasi';

    protected $fillable = [

        /*
        |------------------------------------------------------------------
        | RELASI
        |------------------------------------------------------------------
        */

        'audit_periksa_id',
        'users_id',
        'pertanyaan_ami_prodi_id',
        'pertanyaan_ami_unit_id',
        'matrixs_id',

        /*
        |------------------------------------------------------------------
        | DATA OBSERVASI
        |------------------------------------------------------------------
        */

        'kategori_observasi',
        'discussed_with',
        'rekomendasi',
        'status_observasi',
        'catatan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function auditPeriksa()
    {
        return $this->belongsTo(AuditPeriksa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
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

    public function matrix()
    {
        return $this->belongsTo(
            Matrix::class,
            'matrixs_id'
        );
    }
}