<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class Akreditasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'program',
        'unit',
        'sub_unit',
        'nomor_sk',
        'tanggal_sk',
        'peringkat_akreditasi',
        'tanggal_kadaluarsa',
        'status_akreditasi',
        'sisa_kadaluarsa',
        'akreditasi_nasional',
        'akreditasi_internasional',
        'keterangan',
        'upcoming_ts3',
        'upcoming_ts2',
        'upcoming_ts1',
        'upcoming_ts',
        'tanggal_pendampingan',
        'led',
        'lkpt',
    ];

    protected $casts = [
        'tanggal_sk' => 'date',
        'tanggal_kadaluarsa' => 'date',
        'tanggal_pendampingan' => 'date',
    ];

    public function getSisaKadaluarsaFormatAttribute()
    {
        if (!$this->tanggal_kadaluarsa) {
            return '-';
        }

        $today = Carbon::today();
        $expired = Carbon::parse($this->tanggal_kadaluarsa);

        if ($expired->isPast()) {
            return 'Kadaluarsa';
        }

        $interval = $today->diff($expired);

        $parts = [];

        if ($interval->y > 0) {
            $parts[] = $interval->y . ' Tahun';
        }

        if ($interval->m > 0) {
            $parts[] = $interval->m . ' Bulan';
        }

        if ($interval->d > 0) {
            $parts[] = $interval->d . ' Hari';
        }

        return implode(' ', $parts);
    }

    public function getSisaKadaluarsaAttribute()
    {
        if (!$this->tanggal_kadaluarsa) {
            return null;
        }

        $today = Carbon::today();
        $expired = Carbon::parse($this->tanggal_kadaluarsa);

        return $today->diffInDays($expired, false);
    }

    public function getStatusDaluwarsaAttribute()
    {
        $sisa = $this->sisa_kadaluarsa;

        if ($sisa < 0) {
            return 'Kadaluarsa';
        }

        if ($sisa <= 365) {
            return 'Segera';
        }

        return 'Aktif';
    }
}