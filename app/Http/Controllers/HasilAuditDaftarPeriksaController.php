<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\AuditPeriksa;
use App\Models\User;
use App\Models\Auditiee;
use App\Models\SettingAksesAuditor;
use App\Models\IsiAksesAuditor;
use Carbon\Carbon;

class HasilAuditDaftarPeriksaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REUSABLE QUERY BUILDER
    |--------------------------------------------------------------------------
    */
    private function getAuditQuery(Request $request)
    {
        return AuditPeriksa::with([
                'score',
                'user',
                'pertanyaanAmiProdi.indikator.matrix.kriteriaAudit.standar',
                'pertanyaanAmiUnit.indikator.matrix.kriteriaAudit.standar',
            ])
            ->when($request->tahun_akademik_id, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($request) {
                        $sub->where('tahun_akademik_id', $request->tahun_akademik_id);
                    })
                    ->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($request) {
                        $sub->where('tahun_akademik_id', $request->tahun_akademik_id);
                    });
                });
            })
            ->when($request->unit, function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('unit', $request->unit);
                });
            })
            ->when($request->subunit, function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('sub_unit', $request->subunit);
                });
            })
            ->orderBy('created_at', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSFORM DATA
    |--------------------------------------------------------------------------
    */
    private function transformData($data)
    {
        $data->getCollection()->transform(function ($item) {

            $pertanyaan = $item->pertanyaanAmiProdi ?? $item->pertanyaanAmiUnit;
            $indikator = $pertanyaan?->isiIndikator;

            return (object) [
                'deskripsi'         => $item->uraian_temuan ?? '-',
                'analisis_penyebab' => $item->analisis_penyebab ?? '-',
                'akibat'            => $item->akibat ?? '-',
                'indikator'         => $indikator?->nama ?? $indikator?->indikator ?? '-',
                'skor'              => $item->score->nilai_score ?? '-',
                'panduan'           => $item->panduan_pengisian ?? '-',
            ];
        });

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX (PAGE LOAD NORMAL)
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $data = $this->getAuditQuery($request)
            ->paginate(10)
            ->withQueryString();

        $data = $this->transformData($data);

        $tahunAkademiks = TahunAkademik::whereIn(
                'id',
                \App\Models\PertanyaanAmiProdi::select('tahun_akademik_id')
            )
            ->orWhereIn(
                'id',
                \App\Models\PertanyaanAmiUnit::select('tahun_akademik_id')
            )
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        $units = User::whereNotNull('unit')->distinct()->pluck('unit');
        $subUnits = User::whereNotNull('sub_unit')->distinct()->pluck('sub_unit');

        return view('pages.hasil-audit-daftar-periksa', compact(
            'data',
            'tahunAkademiks',
            'units',
            'subUnits'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX FILTER (NO RELOAD PAGE)
    |--------------------------------------------------------------------------
    */
    public function filter(Request $request)
    {
        $data = $this->getAuditQuery($request)
            ->paginate(10);

        $data = $this->transformData($data);

        return view(
            'components.hasil-audit.daftar-periksa.table',
            compact('data')
        )->render();
    }

    /*
    |--------------------------------------------------------------------------
    | PRINT
    |--------------------------------------------------------------------------
    */
    public function print(Request $request)
    {
        $tahunAkademikId = $request->tahun_akademik_id;

        // =======================
        // DATA AUDIT PERIKSA
        // =======================
        $data = $this->getAuditQuery($request)->get();

        if ($data->isEmpty()) {
            return back()->with('error', 'Data audit tidak ditemukan.');
        }

        // =======================
        // AUDITOR PEMILIK AUDIT
        // =======================
        $auditorUserId = $data->first()->users_id;

        $auditorUser = User::find($auditorUserId);

        // =======================
        // TRANSFORM DATA TABEL
        // =======================
        $items = $data->map(function ($item) {

            $pertanyaan = $item->pertanyaanAmiProdi
                ?? $item->pertanyaanAmiUnit;

            $indikator = $pertanyaan?->isiIndikator;

            return (object) [
                'tujuan'             => $indikator?->nama
                                        ?? $indikator?->indikator
                                        ?? '-',

                'indikator'          => $indikator?->nama
                                        ?? $indikator?->indikator
                                        ?? '-',

                'lingkup_pertanyaan' => $item->uraian_temuan ?? '-',

                'skor'               => $item->score?->nilai_score ?? '-',

                'panduan'            => $item->panduan_pengisian ?? '-',
            ];
        });

        // =======================
        // LOKASI AUDIT
        // =======================
        $lokasi_audit = implode(' - ', array_filter([
            $auditorUser?->sub_unit,
            $auditorUser?->unit,
        ]));

        // =======================
        // AUDITEE
        // =======================
        $auditees = Auditiee::where(
            'users_id',
            $auditorUserId
        )->get();

        // =======================
        // TAHUN AKADEMIK
        // =======================
        $tahunYangDigunakan = $tahunAkademikId;

        if (!$tahunYangDigunakan && $data->isNotEmpty()) {

            $first = $data->first();

            $tahunYangDigunakan =
                $first->pertanyaanAmiProdi?->tahun_akademik_id
                ?? $first->pertanyaanAmiUnit?->tahun_akademik_id
                ?? null;
        }

        $tahun = TahunAkademik::find($tahunYangDigunakan);

        // =======================
        // SETTING AKSES AUDITOR
        // =======================
        $setting = SettingAksesAuditor::where(
            'user_id',
            $auditorUserId
        )->first();

        $auditors = collect();

        $leadAuditorName = null;
        $leadAuditorNidn = null;
        $tanggal_audit = null;

        if ($setting) {

            $tanggal_audit = $setting->tgl_audit
                ? Carbon::parse(
                    $setting->tgl_audit
                )->translatedFormat('d F Y')
                : null;

            $isiAkses = IsiAksesAuditor::with('auditor')
                ->where('setting_akses_auditor_id', $setting->id)
                ->whereIn('posisi', [
                    'lead_auditor',
                    'anggota'
                ])
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

            $lead = $isiAkses->firstWhere(
                'posisi',
                'lead_auditor'
            );

            if ($lead && $lead->auditor) {

                $leadAuditorName =
                    $lead->auditor->nama_auditor;

                $leadAuditorNidn =
                    $lead->auditor->identity_number;
            }
        }

        // =======================
        // FALLBACK LEAD AUDITOR
        // =======================
        if (!$leadAuditorName) {

            $leadAuditorName =
                '_________________________';

            $leadAuditorNidn =
                '_________________';
        }

        // =======================
        // KEPALA BIDANG INTERNAL
        // =======================
        $kabalai = IsiAksesAuditor::with('auditor')
            ->where(
                'setting_akses_auditor_id',
                $setting->id ?? null
            )
            ->where(
                'posisi',
                'posisi_kepala_bidang_internal'
            )
            ->first();

        if (!$kabalai || !$kabalai->auditor) {

            $kabalai = (object) [
                'auditor' => (object) [
                    'nama_auditor' =>
                        '_________________________',

                    'identity_number' =>
                        '_________________'
                ]
            ];
        }

        // =======================
        // KEPALA LPM
        // =======================
        $kepalaLPM = IsiAksesAuditor::with('auditor')
            ->where(
                'setting_akses_auditor_id',
                $setting->id ?? null
            )
            ->where(
                'posisi',
                'posisi_kepala_lembaga_penjaminan_mutu'
            )
            ->first();

        if (!$kepalaLPM || !$kepalaLPM->auditor) {

            $kepalaLPM = (object) [
                'auditor' => (object) [
                    'nama_auditor' =>
                        '_________________________',

                    'identity_number' =>
                        '_________________'
                ]
            ];
        }

        // =======================
        // FALLBACK AUDITOR
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
        return view('admin.periksa.print', compact(
            'items',
            'tahun',
            'lokasi_audit',
            'auditees',
            'auditors',
            'tanggal_audit',
            'leadAuditorName',
            'leadAuditorNidn',
            'kabalai',
            'kepalaLPM'
        ));
    }
}