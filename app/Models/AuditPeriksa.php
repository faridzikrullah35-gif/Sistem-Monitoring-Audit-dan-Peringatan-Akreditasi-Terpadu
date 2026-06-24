<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditPeriksa extends Model
{
    protected $table = 'audit_periksa';

    protected $fillable = [

        'users_id',
        'pertanyaan_ami_prodi_id',
        'pertanyaan_ami_unit_id',

        'uraian_temuan',
        'analisis_penyebab',
        'akibat',

        'setting_score_id',
        'panduan_pengisian',
    ];

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

    public function score()
    {
        return $this->belongsTo(
            SettingScore::class,
            'setting_score_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function ptk()
    {
        return $this->hasOne(
            AuditPtk::class,
            'audit_periksa_id'
        );
    }

    public function observasi()
    {
        return $this->hasOne(FormObservasi::class);
    }

    public function terpenuhi()
    {
        return $this->hasOne(FormTerpenuhi::class, 'audit_periksa_id');
    }

    public function settingScore()
    {
        return $this->belongsTo(SettingScore::class, 'setting_score_id');
    }
}