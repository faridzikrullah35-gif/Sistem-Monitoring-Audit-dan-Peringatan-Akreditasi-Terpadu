<?php

namespace App\Http\Controllers;

use App\Models\AuditPtk;
use App\Models\TahunAkademik;
use App\Models\PertanyaanAmiProdi;
use App\Models\SettingScore;
use App\Models\user;
use App\Models\auditPeriksa;
use App\Models\Auditiee;
use App\Models\SettingAksesAuditor;
use App\Models\IsiAksesAuditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FormPtkController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $amiModel = $user->role === 'unit_kerja'
            ? \App\Models\PertanyaanAmiUnit::class
            : \App\Models\PertanyaanAmiProdi::class;

        $relasiAmi = $user->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';

        $ptkList = AuditPtk::with([
            $relasiAmi . '.isiIndikator',
            $relasiAmi . '.tahunAkademik',
            'auditPeriksa',
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })
        ->orderBy('id', 'asc')
        ->get();

        $tahunAkademiks = $amiModel::select('tahun_akademik_id')
            ->distinct()
            ->pluck('tahun_akademik_id');

        $tahunAkademiks = \App\Models\TahunAkademik::whereIn('id', $tahunAkademiks)
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        $kategoriTemuan = \App\Models\SettingScore::where('generate_ncr', 1)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.auditee-form-ptk', compact(
            'ptkList',
            'tahunAkademiks',
            'kategoriTemuan'
        ));
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

    public function print(Request $request)
    {
        $user = auth()->user();
        $userId = auth()->id();

        // Tentukan model AMI berdasarkan role
        $amiModel = $user->role === 'unit_kerja'
            ? \App\Models\PertanyaanAmiUnit::class
            : \App\Models\PertanyaanAmiProdi::class;

        $relasiAmi = $user->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';

        /*
        |----------------------------------------
        | DATA PTK
        |----------------------------------------
        */
        $query = AuditPtk::with([
            $relasiAmi . '.isiIndikator',
            $relasiAmi . '.tahunAkademik',
            'auditPeriksa',
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        });

        if ($request->filled('tahun_akademik_id')) {
            $query->whereHas($relasiAmi, function ($q) use ($request) {
                $q->where('tahun_akademik_id', $request->tahun_akademik_id);
            });
        }

        $ptkList = $query->orderBy('id', 'asc')->get();

        /*
        |----------------------------------------
        | LOKASI AUDIT
        |----------------------------------------
        */
        $lokasi_audit = implode(' - ', array_filter([
            $user->sub_unit ?? null,
            $user->unit ?? null
        ]));

        /*
        |----------------------------------------
        | TAHUN AKADEMIK
        |----------------------------------------
        */
        $tahunAkademikId = $request->tahun_akademik_id;

        if (!$tahunAkademikId && $ptkList->isNotEmpty()) {
            $first = $ptkList->first();

            $tahunAkademikId =
                optional($first->{$relasiAmi})->tahun_akademik_id;
        }

        $tahunAkademik = TahunAkademik::find($tahunAkademikId);

        /*
        |----------------------------------------
        | AUDITOR
        |----------------------------------------
        */
        $firstAudit = $ptkList->first();
        $auditorUserId = $firstAudit ? $firstAudit->users_id : null;

        // Cari setting berdasarkan auditor pembuat audit
        $setting = null;

        if ($auditorUserId) {
            $setting = SettingAksesAuditor::where('user_id', $auditorUserId)->first();
        }

        // fallback jika tidak ditemukan
        if (!$setting) {
            $setting = SettingAksesAuditor::where('user_id', $userId)->first();
        }

        $auditors = collect();
        $leadAuditorName = null;
        $leadAuditorNidn = null;
        $tanggal_audit = null;

        if ($setting) {

            $tanggal_audit = $setting->tgl_audit
                ? Carbon::parse($setting->tgl_audit)
                    ->translatedFormat('d F Y')
                : null;

            $isiAkses = IsiAksesAuditor::with('auditor')
                ->where('setting_akses_auditor_id', $setting->id)
                ->whereIn('posisi', ['lead_auditor', 'anggota'])
                ->get();

            $auditors = $isiAkses->map(function ($item) {
                return [
                    'nama' => $item->auditor->nama_auditor ?? '-',
                    'role' => $item->posisi === 'lead_auditor'
                        ? 'Lead Auditor'
                        : 'Anggota',
                    'nidn' => $item->auditor->identity_number ?? null,
                ];
            });

            $lead = $isiAkses->firstWhere('posisi', 'lead_auditor');

            if ($lead && $lead->auditor) {
                $leadAuditorName = $lead->auditor->nama_auditor;
                $leadAuditorNidn = $lead->auditor->identity_number;
            }
        }

        if (!$leadAuditorName) {
            $leadAuditorName = '_________________________';
            $leadAuditorNidn = '_________________';
        }

        /*
        |----------------------------------------
        | AUDITEE
        |----------------------------------------
        */
        $auditees = Auditiee::whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })->get();

        /*
        |----------------------------------------
        | KEPALA BIDANG INTERNAL
        |----------------------------------------
        */
        $kabalai = IsiAksesAuditor::with('auditor')
            ->where('setting_akses_auditor_id', $setting->id ?? null)
            ->where('posisi', 'posisi_kepala_bidang_internal')
            ->first();

        if (!$kabalai || !$kabalai->auditor) {
            $kabalai = (object)[
                'auditor' => (object)[
                    'nama_auditor' => '_________________________',
                    'identity_number' => '_________________',
                ]
            ];
        }

        /*
        |----------------------------------------
        | KEPALA LPM
        |----------------------------------------
        */
        $kepalaLPM = IsiAksesAuditor::with('auditor')
            ->where('setting_akses_auditor_id', $setting->id ?? null)
            ->where('posisi', 'posisi_kepala_lembaga_penjaminan_mutu')
            ->first();

        if (!$kepalaLPM || !$kepalaLPM->auditor) {
            $kepalaLPM = (object)[
                'auditor' => (object)[
                    'nama_auditor' => '_________________________',
                    'identity_number' => '_________________',
                ]
            ];
        }

        /*
        |----------------------------------------
        | RETURN VIEW
        |----------------------------------------
        */
        return view('auditee.ncr.print', compact(
            'ptkList',
            'tahunAkademik',
            'auditors',
            'auditees',
            'leadAuditorName',
            'leadAuditorNidn',
            'kabalai',
            'kepalaLPM',
            'tanggal_audit',
            'lokasi_audit',
            'tahunAkademikId'
        ));
    }

}