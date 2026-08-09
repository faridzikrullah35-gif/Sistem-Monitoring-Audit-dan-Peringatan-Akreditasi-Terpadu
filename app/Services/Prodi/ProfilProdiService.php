<?php

namespace App\Services\Prodi;

use App\Models\ProfilProdi;
use Illuminate\Support\Facades\Auth;

class ProfilProdiService
{
    /**
     * Ambil profil user login.
     */
    public function profil(): ProfilProdi
    {
        return ProfilProdi::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    public function storeVmts(array $data): ProfilProdi
    {
        $profil = $this->profil();

        $profil->update([
            'visi'     => $data['visi'],
            'misi'     => $data['misi'],
            'tujuan'   => $data['tujuan'],
            'sasaran'  => $data['sasaran'],
        ]);

        return $profil->fresh();
    }

    /**
     * Update VMTS.
     */
    public function updateVmts(array $data, $id): ProfilProdi
    {
        $profil = ProfilProdi::findOrFail($id);

        $profil->update([
            'visi'     => $data['visi'],
            'misi'     => $data['misi'],
            'tujuan'   => $data['tujuan'],
            'sasaran'  => $data['sasaran'],
        ]);

        return $profil->fresh();
    }

    public function findVmts($id)
    {
        return ProfilProdi::findOrFail($id);
    }

    /**
     * Update DTPS.
     */
    public function updateDtps(array $data): ProfilProdi
    {
        $profil = $this->profil();

        $profil->update([
            'jumlah_dtps_magister' => $data['jumlah_dtps_magister'],
            'jumlah_dtps_doktor'   => $data['jumlah_dtps_doktor'],
            'jumlah_aa'            => $data['jumlah_aa'],
            'jumlah_lk'            => $data['jumlah_lk'],
            'jumlah_gb'            => $data['jumlah_gb'],
        ]);

        return $profil->fresh();
    }

    /**
     * Update Mahasiswa.
     */
    public function updateMahasiswa(array $data): ProfilProdi
    {
        $profil = $this->profil();

        $profil->update([
            'jumlah_mahasiswa' => $data['jumlah_mahasiswa'],
        ]);

        return $profil->fresh();
    }

    public function deleteVmts($id)
    {
        return ProfilProdi::destroy($id);
    }
    
}