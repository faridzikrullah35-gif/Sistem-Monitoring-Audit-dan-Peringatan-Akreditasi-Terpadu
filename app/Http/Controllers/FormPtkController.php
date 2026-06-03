<?php

namespace App\Http\Controllers;

use App\Models\AuditPtk;
use App\Models\TahunAkademik;
use App\Models\PertanyaanAmiProdi;
use App\Models\SettingScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormPtkController extends Controller
{
    public function index(Request $request)
    {
        $ptkList = AuditPtk::with([
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiProdi.tahunAkademik',
            'auditPeriksa'
        ])
        ->orderBy('id', 'asc')
        ->get();

        $tahunAkademiks = TahunAkademik::orderBy('tahun_akademik', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        $kategoriTemuan = SettingScore::where('generate_ncr', 1)
            ->orderBy('id', 'asc')
            ->get();

        if ($request->ajax()) {
            return view('pages.auditee-form-ptk', [
                'ptkList'        => $ptkList,
                'tahunAkademiks' => $tahunAkademiks,
                'kategoriTemuan' => $kategoriTemuan,
            ]);
        }

        return view('pages.auditee-form-ptk', [
            'ptkList'        => $ptkList,
            'tahunAkademiks' => $tahunAkademiks,
            'kategoriTemuan' => $kategoriTemuan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $ptk = AuditPtk::findOrFail($id);

        $validated = $request->validate([
            'no_ncr'                             => 'nullable|string|max:255',
            'klausul_dokumen'                    => 'nullable|string',
            'deskripsi_uraian_temuan'            => 'required|string',
            'kategori_temuan'                    => 'required|string|max:100',
            'status_ncr'                         => 'required|string|max:100',
            'tanggal_selesai'                    => 'nullable|date',
            'rencana_tindakan_perbaikan_auditee' => 'nullable|string',
            'tindakan_pencegahan_auditee'        => 'nullable|string',
            'tanggal_target_perbaikan_auditee'   => 'nullable|date',
            
            'file_auditee'                       => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $allowedTags = '<b><i><u><strong><em><ul><ol><li><p><br><span><div><h1><h2><h3><h4><h5><h6>';

        if (!empty($validated['rencana_tindakan_perbaikan_auditee'])) {
            $validated['rencana_tindakan_perbaikan_auditee'] = strip_tags($validated['rencana_tindakan_perbaikan_auditee'], $allowedTags);
        }
        if (!empty($validated['tindakan_pencegahan_auditee'])) {
            $validated['tindakan_pencegahan_auditee'] = strip_tags($validated['tindakan_pencegahan_auditee'], $allowedTags);
        }
        if (!empty($validated['deskripsi_uraian_temuan'])) {
            $validated['deskripsi_uraian_temuan'] = strip_tags($validated['deskripsi_uraian_temuan'], $allowedTags);
        }

        // Handle file upload
        if ($request->hasFile('file_auditee')) {
            // Hapus file lama kalau ada
            if ($ptk->file_auditee && Storage::disk('public')->exists($ptk->file_auditee)) {
                Storage::disk('public')->delete($ptk->file_auditee);
            }
            $validated['file_auditee'] = $request->file('file_auditee')
                ->store('ptk-files', 'public');
        } else {
            // Tidak ada file baru — jangan overwrite, hapus dari validated
            unset($validated['file_auditee']);
        }

        $ptk->update($validated);

        $ptk->load([
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiProdi.tahunAkademik',
            'auditPeriksa'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data PTK berhasil diperbarui.',
            'data'    => $ptk,
        ]);
    }
}