<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FakultasDataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'fakultas_data_mahasiswas';

    protected $fillable = [
        'users_id',
        'tahun_akademik',
        'ta_6',
        'ta_5',
        'ta_4',
        'ta_3',
        'ta_2',
        'ta_1',
        'ta',
        'lulusan_akhir_ta',
    ];

    protected $casts = [
        'users_id' => 'integer',
        'ta_6' => 'integer',
        'ta_5' => 'integer',
        'ta_4' => 'integer',
        'ta_3' => 'integer',
        'ta_2' => 'integer',
        'ta_1' => 'integer',
        'ta' => 'integer',
        'lulusan_akhir_ta' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}