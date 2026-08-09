<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AksesPertanyaanProdi extends Model
{
    protected $table = 'akses_pertanyaan_prodi';

    protected $fillable = [
        'pertanyaan_id',
        'role',
        'unit',
        'sub_unit',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanAmiProdi::class, 'pertanyaan_id');
    }

    public function scopeForUser($query, $user)
    {
        return $query->where('role', $user->role)
                    ->where('unit', $user->unit)
                    ->where(function ($q) use ($user) {
                        $q->where('sub_unit', $user->sub_unit)
                        ->orWhereNull('sub_unit');
                    });
    }
}