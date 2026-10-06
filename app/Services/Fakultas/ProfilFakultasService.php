<?php

namespace App\Services\Fakultas;

use App\Models\ProfilFakultas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilFakultasService
{
    /**
     * Store VMTS
     */
    public function storeVmts(array $data)
    {
        $profil = $this->getOrCreateProfil();

        $vmtsData = [
            'visi'          => $data['visi'] ?? null,
            'misi'          => $data['misi'] ?? null,
            'tujuan'        => $data['tujuan'] ?? null,
            'sasaran'       => $data['sasaran'] ?? null,
            'tgl_penetapan' => $data['tgl_penetapan'] ?? null,
        ];

        if (!empty($data['file'])) {
            $file = $data['file'];

            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'profil-fakultas/vmts/' . $fileName;

            Storage::disk('public')->put(
                $filePath,
                file_get_contents($file)
            );

            $vmtsData['file'] = $filePath;
        }

        $profil->update($vmtsData);

        return $profil->fresh();
    }

    /**
     * Find VMTS by id
     */
    public function findVmts($id)
    {
        return ProfilFakultas::findOrFail($id);
    }

    /**
     * Update VMTS
     */
    public function updateVmts(array $data, $id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        $vmtsData = [
            'visi'          => $data['visi'] ?? $profil->visi,
            'misi'          => $data['misi'] ?? $profil->misi,
            'tujuan'        => $data['tujuan'] ?? $profil->tujuan,
            'sasaran'       => $data['sasaran'] ?? $profil->sasaran,
            'tgl_penetapan' => $data['tgl_penetapan'] ?? $profil->tgl_penetapan,
        ];

        if (!empty($data['file'])) {

            // Hapus file lama
            if (
                $profil->file &&
                Storage::disk('public')->exists($profil->file)
            ) {
                Storage::disk('public')->delete($profil->file);
            }

            $file = $data['file'];

            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'profil-fakultas/vmts/' . $fileName;

            Storage::disk('public')->put(
                $filePath,
                file_get_contents($file)
            );

            $vmtsData['file'] = $filePath;
        }

        $profil->update($vmtsData);

        return $profil->fresh();
    }

    /**
     * Delete VMTS (reset ke null)
     */
    public function deleteVmts($id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        // Hapus file VMTS
        if (
            $profil->file &&
            Storage::disk('public')->exists($profil->file)
        ) {
            Storage::disk('public')->delete($profil->file);
        }

        $profil->update([
            'visi'          => null,
            'misi'          => null,
            'tujuan'        => null,
            'sasaran'       => null,
            'file'          => null,
            'tgl_penetapan' => null,
        ]);

        return $profil;
    }

    /**
     * Get or create profil
     */
    private function getOrCreateProfil()
    {
        return ProfilFakultas::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }
}