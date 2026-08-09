<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AksesPertanyaanUnit extends Model
{
    protected $table = 'akses_pertanyaan_unit';

    protected $fillable = [
        'pertanyaan_id',
        'role',
        'unit',
        'sub_unit',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanAmiUnit::class, 'pertanyaan_id');
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