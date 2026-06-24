<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormTerpenuhi;
use App\Models\TahunAkademik;
use App\Models\User;
use App\Models\Auditiee;
use App\Models\SettingAksesAuditor;
use App\Models\IsiAksesAuditor;
use Carbon\Carbon;

class HasilAuditTerpenuhiController extends Controller
{
    /**
     * Query builder dengan filter
     */
    private function getTerpenuhiQuery(Request $request)
    {
        return FormTerpenuhi::with([
                'user.settingAksesAuditor.isiAkses.auditor',
                'pertanyaanAmiProdi.isiIndikator',
                'pertanyaanAmiUnit.isiIndikator',
                'matrix.kriteriaAudit.standar',
            ])
            ->when($request->tahun_akademik_id, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($request) {
                        $sub->where('tahun_akademik_id', $request->tahun_akademik_id);
                    })->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($request) {
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

    /**
     * Ambil daftar nama auditor
     */
    private function getAuditorNames($item)
    {
        $setting = $item->user?->settingAksesAuditor;
        if (!$setting) {
            return '-';
        }

        $auditorList = $setting->isiAkses
            ->filter(function ($isi) {
                return in_array($isi->posisi, ['lead_auditor', 'anggota']);
            })
            ->map(function ($isi) {
                $nama = $isi->auditor?->nama_auditor ?? '-';
                if ($isi->posisi === 'lead_auditor') {
                    return $nama . ' (Lead Auditor)';
                }
                return $nama;
            })
            ->implode(', ');

        return $auditorList ?: '-';
    }

    /**
     * Transformasi data untuk tabel
     */
    private function transformData($data)
    {
        $data->getCollection()->transform(function ($item) {
            // Indikator dari relasi pertanyaan
            $pertanyaan = $item->pertanyaanAmiProdi ?? $item->pertanyaanAmiUnit;
            $indikator = optional($pertanyaan->isiIndikator)->indikator ?? '-';

            return (object) [
                'indikator'      => $indikator,
                'discussed_with' => $item->discussed_with ?? '-',
                'rekomendasi'    => $item->rekomendasi ?? '-',
            ];
        });

        return $data;
    }

    /**
     * Halaman utama
     */
    public function index(Request $request)
    {
        $data = $this->getTerpenuhiQuery($request)
            ->paginate(10)
            ->withQueryString();

        $data = $this->transformData($data);

        // Ambil tahun akademik yang tersedia dari data terpenuhi
        $tahunAkademiks = TahunAkademik::whereIn(
                'id',
                \App\Models\PertanyaanAmiProdi::select('tahun_akademik_id')
                    ->whereIn('id', function ($q) {
                        $q->select('pertanyaan_ami_prodi_id')
                          ->from('form_terpenuhi')
                          ->whereNotNull('pertanyaan_ami_prodi_id');
                    })
                    ->union(
                        \App\Models\PertanyaanAmiUnit::select('tahun_akademik_id')
                            ->whereIn('id', function ($q) {
                                $q->select('pertanyaan_ami_unit_id')
                                  ->from('form_terpenuhi')
                                  ->whereNotNull('pertanyaan_ami_unit_id');
                            })
                    )
            )
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        $units = User::whereNotNull('unit')->distinct()->pluck('unit');
        $subUnits = User::whereNotNull('sub_unit')->distinct()->pluck('sub_unit');

        return view('pages.hasil-audit-terpenuhi', compact(
            'data',
            'tahunAkademiks',
            'units',
            'subUnits'
        ));
    }

    /**
     * Filter via AJAX
     */
    public function filter(Request $request)
    {
        $data = $this->getTerpenuhiQuery($request)
            ->paginate(10);

        $data = $this->transformData($data);

        return view(
            'components.hasil-audit.terpenuhi.table',
            compact('data')
        )->render();
    }

    /**
     * Print PDF
     */
    public function print(Request $request)
    {
        $tahunAkademikId = $request->tahun_akademik_id;

        $data = $this->getTerpenuhiQuery($request)->get();

        if ($data->isEmpty()) {
            return back()->with('error', 'Data Terpenuhi tidak ditemukan.');
        }

        // Transform untuk print
        $items = $data->map(function ($item) {
            $pertanyaan = $item->pertanyaanAmiProdi ?? $item->pertanyaanAmiUnit;
            $indikator = optional($pertanyaan->isiIndikator)->indikator ?? '-';

            return (object) [
                'indikator'      => $indikator,
                'discussed_with' => $item->discussed_with ?? '-',
                'rekomendasi'    => $item->rekomendasi ?? '-',
            ];
        });

        // Data pendukung untuk kop surat
        $first = $data->first();
        $auditorUserId = $first->users_id;
        $auditorUser = User::find($auditorUserId);

        $tahunYangDigunakan = $tahunAkademikId;
        if (!$tahunYangDigunakan && $data->isNotEmpty()) {
            $first = $data->first();
            $tahunYangDigunakan = optional($first->pertanyaanAmiProdi ?? $first->pertanyaanAmiUnit)->tahun_akademik_id;
        }
        $tahun = TahunAkademik::find($tahunYangDigunakan);

        $lokasi_audit = implode(' - ', array_filter([
            $auditorUser?->sub_unit,
            $auditorUser?->unit,
        ])) ?: '-';

        $auditees = Auditiee::where('users_id', $auditorUserId)->get();

        $setting = SettingAksesAuditor::where('user_id', $auditorUserId)->first();
        $auditors = collect();
        $tanggal_audit_print = null;

        if ($setting) {
            $tanggal_audit_print = $setting->tgl_audit
                ? Carbon::parse($setting->tgl_audit)->translatedFormat('d F Y')
                : null;

            $isiAkses = $setting->isiAkses->filter(function ($isi) {
                return in_array($isi->posisi, ['lead_auditor', 'anggota']);
            });

            $auditors = $isiAkses->map(function ($isi) {
                return [
                    'nama' => $isi->auditor?->nama_auditor ?? '-',
                    'role' => $isi->posisi === 'lead_auditor' ? 'Lead Auditor' : 'Anggota',
                    'nidn' => $isi->auditor?->identity_number ?? null,
                ];
            });
        }

        if ($auditors->isEmpty()) {
            $auditors = collect([[
                'nama' => 'Data Auditor Tidak Tersedia',
                'role' => '-',
                'nidn' => null,
            ]]);
        }

        return view('admin.terpenuhi.print', compact(
            'items',
            'tahun',
            'lokasi_audit',
            'auditees',
            'auditors',
            'tanggal_audit_print'
        ));
    }
}