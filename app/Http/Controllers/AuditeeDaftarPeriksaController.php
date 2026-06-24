<?php

namespace App\Http\Controllers;

use App\Models\AuditPeriksa;
use App\Models\PertanyaanAmiProdi;
use App\Models\TahunAkademik;
use App\Models\Auditiee;
use App\Models\SettingAksesAuditor;
use App\Models\IsiAksesAuditor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AuditeeDaftarPeriksaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $tahunAkademiks = TahunAkademik::whereIn(
            'id',
            PertanyaanAmiProdi::select('tahun_akademik_id')->distinct()
        )
        ->orderBy('tahun_akademik', 'desc')
        ->get();

        $daftarPeriksas = AuditPeriksa::with([
            'pertanyaanAmiProdi.indikator.matrix.kriteriaAudit.standar',
            'pertanyaanAmiProdi.tahunAkademik',
            'pertanyaanAmiUnit.indikator.matrix.kriteriaAudit.standar',
            'pertanyaanAmiUnit.tahunAkademik',
            'score',
            'user'
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return view('pages.auditee-daftar-periksa', compact(
            'tahunAkademiks',
            'daftarPeriksas'
        ));
    }

    public function print(Request $request)
    {
        $user = auth()->user();
        $userId = auth()->id();
        $tahunAkademikId = $request->tahun_akademik_id;

        // =======================
        // DATA AUDIT PERIKSA
        // =======================
        $data = AuditPeriksa::with([
            'score',
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiUnit.isiIndikator'
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })
        ->when($tahunAkademikId, function ($query) use ($tahunAkademikId) {
            $query->where(function ($q) use ($tahunAkademikId) {
                $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                })
                ->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                });
            });
        })
        ->orderBy('id', 'desc')
        ->get();

        $lokasi_audit = implode(' - ', array_filter([
            $user->sub_unit,
            $user->unit
        ]));

        // =======================
        // AUDITEE
        // =======================
        $auditees = Auditiee::whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })->get();

        // =======================
        // AMBIL TAHUN AKTIF
        // =======================
        $tahunYangDigunakan = $tahunAkademikId;

        if (!$tahunYangDigunakan && $data->isNotEmpty()) {
            $first = $data->first();

            $tahunYangDigunakan =
                $first->pertanyaanAmiProdi->tahun_akademik_id
                ?? $first->pertanyaanAmiUnit->tahun_akademik_id
                ?? null;
        }

        // =======================
        // AUDITOR
        // =======================
        // Ambil users_id dari data audit pertama (jika ada)
        $firstAudit = $data->first();
        $auditorUserId = $firstAudit ? $firstAudit->users_id : null;

        // Cari setting berdasarkan auditor yang membuat audit
        $setting = null;
        if ($auditorUserId) {
            $setting = SettingAksesAuditor::where('user_id', $auditorUserId)->first();
        }

        // Jika tidak ketemu (misal tidak ada data), fallback ke user login (tapi tidak akan terpakai)
        if (!$setting) {
            $setting = SettingAksesAuditor::where('user_id', $userId)->first();
        }

        $auditors = collect();
        $leadAuditorName = null;
        $leadAuditorNidn = null;
        $tanggal_audit = null;

        if ($setting) {
            $tanggal_audit = $setting?->tgl_audit
                ? Carbon::parse($setting->tgl_audit)->translatedFormat('d F Y')
                : null;
            $isiAkses = IsiAksesAuditor::with('auditor')
                ->where('setting_akses_auditor_id', $setting->id)
                ->whereIn('posisi', ['lead_auditor', 'anggota'])
                ->get();
            $auditors = $isiAkses->map(function ($item) {
                return [
                    'nama' => $item->auditor->nama_auditor ?? '-',
                    'role' => $item->posisi === 'lead_auditor' ? 'Lead Auditor' : 'Anggota',
                    'nidn' => $item->auditor->identity_number ?? null,
                ];
            });
            $lead = $isiAkses->firstWhere('posisi', 'lead_auditor');
                if ($lead && $lead->auditor) {
                    $leadAuditorName = $lead->auditor->nama_auditor;
                    $leadAuditorNidn = $lead->auditor->identity_number;
                }
            }

            // Fallback jika tidak ada lead auditor
            if (!$leadAuditorName) {
                $leadAuditorName = '_________________________';
                $leadAuditorNidn = '_________________';
            }

            $kabalai = IsiAksesAuditor::with('auditor')
                ->where('setting_akses_auditor_id', $setting->id ?? null)
                ->where('posisi', 'posisi_kepala_bidang_internal')
                ->first();

            if (!$kabalai || !$kabalai->auditor) {
                $kabalai = (object) [
                    'auditor' => (object) [
                        'nama_auditor' => '_________________________',
                        'identity_number' => '_________________'
                    ]
                ];
            }

            $kepalaLPM = IsiAksesAuditor::with('auditor')
                ->where('setting_akses_auditor_id', $setting->id ?? null)
                ->where('posisi', 'posisi_kepala_lembaga_penjaminan_mutu')
                ->first();

            if (!$kepalaLPM || !$kepalaLPM->auditor) {
                $kepalaLPM = (object) [
                    'auditor' => (object) [
                        'nama_auditor' => '_________________________',
                        'identity_number' => '_________________'
                    ]
                ];
            }

        // =======================
        // FALLBACK AMAN
        // =======================
        if ($auditors->isEmpty()) {
            $auditors = collect([[
                'nama' => 'Data Auditor Tidak Tersedia',
                'role' => '-',
                'nidn' => null,
            ]]);
        }

        // =======================
        // RETURN VIEW
        // =======================
        return view('auditee.daftar-periksa.print', compact(
            'data',
            'auditees',
            'auditors',
            'tahunAkademikId',
            'lokasi_audit',
            'tanggal_audit',
            'leadAuditorName',
            'leadAuditorNidn',
            'kabalai',
            'kepalaLPM',
        ));
    }
}