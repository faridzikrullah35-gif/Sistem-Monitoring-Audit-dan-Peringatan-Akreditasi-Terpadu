<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\AuditPtk;
use App\Models\FormObservasi;
use App\Models\FormTerpenuhi;
use App\Models\AuditPeriksa;
use App\Models\SettingScore;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HasilAuditRekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        $tahunAkademiks = TahunAkademik::where('status', 'Aktif')
            ->orderBy('tahun_akademik', 'asc')
            ->orderBy('semester', 'asc')
            ->get();

        $units = User::whereNotNull('unit')->distinct()->pluck('unit');
        $subUnits = User::whereNotNull('sub_unit')->distinct()->pluck('sub_unit');

        return view('pages.hasil-audit-rekapitulasi', compact(
            'tahunAkademiks',
            'units',
            'subUnits'
        ));
    }

    public function filter(Request $request)
    {
        $data = $this->getRekapitulasiData($request);

        $tableHtml = view('components.hasil-audit.rekapitulasi.table', [
            'items' => $data['items'],
            'categories' => $data['categories'],
        ])->render();

        return response()->json([
            'table' => $tableHtml,
            'categories' => $data['categories'],
        ]);
    }

    /**
     * Ambil daftar nama auditor (lead + anggota) dari setting akses
     */
    private function getAuditorNames($item)
    {
        $setting = $item->user?->settingAksesAuditor;
        if (!$setting) {
            return $item->user?->name ?? 'Auditor';
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

        return $auditorList ?: ($item->user?->name ?? 'Auditor');
    }

    private function getRekapitulasiData(Request $request)
    {
        $tahunAkademikId = $request->tahun_akademik_id;

        if (!$tahunAkademikId) {
            return [
                'items' => [],
                'categories' => [],
            ];
        }

        $auditPeriksaIds = DB::table('audit_periksa as ap')
            ->leftJoin('pertanyaan_ami_prodi as pap', 'ap.pertanyaan_ami_prodi_id', '=', 'pap.id')
            ->leftJoin('pertanyaan_ami_unit as pau', 'ap.pertanyaan_ami_unit_id', '=', 'pau.id')
            ->leftJoin('users as u', 'ap.users_id', '=', 'u.id')
            ->where(function($q) use ($tahunAkademikId) {
                $q->where('pap.tahun_akademik_id', $tahunAkademikId)
                    ->orWhere('pau.tahun_akademik_id', $tahunAkademikId);
            })
            ->when($request->unit, function($q) use ($request) {
                return $q->where('u.unit', $request->unit);
            })
            ->when($request->subunit, function($q) use ($request) {
                return $q->where('u.sub_unit', $request->subunit);
            })
            ->pluck('ap.id')
            ->filter()
            ->values()
            ->toArray();

        $kategoriTemuan = SettingScore::where('generate_ncr', 1)->get();
        $listKategoriTemuan = $kategoriTemuan->pluck('keterangan')->toArray();

        $kategoriObservasi = SettingScore::where('generate_ncr', 0)
            ->where('keterangan', 'Observasi')
            ->first();

        // 1. Data Temuan (PTK) dengan relasi user dan setting akses
        $temuan = AuditPtk::with([
            'user.settingAksesAuditor.isiAkses.auditor',
            'auditPeriksa'
        ])
        ->whereIn('audit_periksa_id', $auditPeriksaIds)
        ->whereIn('kategori_temuan', $listKategoriTemuan)
        ->get();

        // 2. Data Observasi dengan relasi user dan setting akses
        $observasi = FormObservasi::with([
            'user.settingAksesAuditor.isiAkses.auditor',
            'auditPeriksa'
        ])
        ->whereIn('audit_periksa_id', $auditPeriksaIds)
        ->get();

        // 3. Data Terpenuhi dengan relasi user dan setting akses
        $terpenuhi = FormTerpenuhi::with([
            'user.settingAksesAuditor.isiAkses.auditor',
            'pertanyaanAmiProdi',
            'pertanyaanAmiUnit'
        ])
        ->where(function ($query) use ($tahunAkademikId) {
            $query->whereHas('pertanyaanAmiProdi', function ($q) use ($tahunAkademikId) {
                $q->where('tahun_akademik_id', $tahunAkademikId);
            })->orWhereHas('pertanyaanAmiUnit', function ($q) use ($tahunAkademikId) {
                $q->where('tahun_akademik_id', $tahunAkademikId);
            });
        })
        ->when($request->unit, function($q) use ($request) {
            return $q->whereHas('user', function($u) use ($request) {
                $u->where('unit', $request->unit);
            });
        })
        ->when($request->subunit, function($q) use ($request) {
            return $q->whereHas('user', function($u) use ($request) {
                $u->where('sub_unit', $request->subunit);
            });
        })
        ->get();

        $items = [];

        // Temuan
        foreach ($temuan as $t) {
            $ap = $t->auditPeriksa;
            $tahunAkademik = optional($ap->pertanyaanAmiProdi ?? $ap->pertanyaanAmiUnit)->tahunAkademik;
            $tahunNama = $tahunAkademik ? $tahunAkademik->tahun_akademik . ' - ' . $tahunAkademik->semester : '-';

            $items[] = [
                'no_ncr' => $t->no_ncr ?? '-',
                'tgl_audit' => $t->created_at ? $t->created_at->translatedFormat('d F Y') : '-',
                'bagian' => $t->user?->sub_unit ?? $t->user?->unit ?? '-',
                'macam_temuan' => $t->kategori_temuan ?? '-',
                'uraian_temuan' => $t->deskripsi_uraian_temuan ?? $ap?->uraian_temuan ?? '-',
                'tgl_target_perbaikan' => $t->tanggal_target_perbaikan_auditee
                    ? Carbon::parse($t->tanggal_target_perbaikan_auditee)->translatedFormat('d F Y')
                    : '-',
                'tgl_verifikasi' => $t->tanggal_selesai
                    ? Carbon::parse($t->tanggal_selesai)->translatedFormat('d F Y')
                    : '-',
                'auditor' => $this->getAuditorNames($t),
                'status' => $t->status_ncr ?? 'Open',
                'keterangan' => '',
                'tahun_akademik' => $tahunNama,
            ];
        }

        // Observasi
        foreach ($observasi as $obs) {
            $ap = $obs->auditPeriksa;
            $tahunAkademik = optional($ap->pertanyaanAmiProdi ?? $ap->pertanyaanAmiUnit)->tahunAkademik;
            $tahunNama = $tahunAkademik ? $tahunAkademik->tahun_akademik . ' - ' . $tahunAkademik->semester : '-';

            $items[] = [
                'no_ncr' => '-',
                'tgl_audit' => $obs->created_at ? $obs->created_at->translatedFormat('d F Y') : '-',
                'bagian' => $obs->user?->sub_unit ?? $obs->user?->unit ?? '-',
                'macam_temuan' => 'Observasi',
                'uraian_temuan' => $obs->rekomendasi ?? $obs->discussed_with ?? '-',
                'tgl_target_perbaikan' => '-',
                'tgl_verifikasi' => '-',
                'auditor' => $this->getAuditorNames($obs),
                'status' => '-',
                'keterangan' => $obs->catatan ?? '',
                'tahun_akademik' => $tahunNama,
            ];
        }

        // Terpenuhi
        foreach ($terpenuhi as $tp) {
            $pertanyaan = $tp->pertanyaanAmiProdi ?? $tp->pertanyaanAmiUnit;
            $tahunAkademik = optional($pertanyaan)->tahunAkademik;
            $tahunNama = $tahunAkademik ? $tahunAkademik->tahun_akademik . ' - ' . $tahunAkademik->semester : '-';

            $items[] = [
                'no_ncr' => '-',
                'tgl_audit' => $tp->created_at ? $tp->created_at->translatedFormat('d F Y') : '-',
                'bagian' => $tp->user?->sub_unit ?? $tp->user?->unit ?? '-',
                'macam_temuan' => 'Terpenuhi',
                'uraian_temuan' => $tp->rekomendasi ?? $tp->discussed_with ?? '-',
                'tgl_target_perbaikan' => '-',
                'tgl_verifikasi' => '-',
                'auditor' => $this->getAuditorNames($tp),
                'status' => '-',
                'keterangan' => '',
                'tahun_akademik' => $tahunNama,
            ];
        }

        // Urutkan berdasarkan tanggal (terbaru di atas)
        usort($items, function($a, $b) {
            return strtotime($b['tgl_audit']) - strtotime($a['tgl_audit']);
        });

        // Hitung categories
        $categories = [];
        $warna = [
            'Mayor' => 'text-red-600',
            'Minor' => 'text-yellow-600',
            'Observasi' => 'text-blue-600',
            'Terpenuhi' => 'text-green-600',
        ];

        foreach ($kategoriTemuan as $kt) {
            $categories[] = [
                'label' => $kt->keterangan,
                'total' => $temuan->where('kategori_temuan', $kt->keterangan)->count(),
                'color' => $warna[$kt->keterangan] ?? 'text-gray-600',
            ];
        }

        if ($kategoriObservasi) {
            $categories[] = [
                'label' => 'Observasi',
                'total' => $observasi->count(),
                'color' => 'text-blue-600',
            ];
        }

        $categories[] = [
            'label' => 'Terpenuhi',
            'total' => $terpenuhi->count(),
            'color' => 'text-green-600',
        ];

        return [
            'items' => $items,
            'categories' => $categories,
        ];
    }

    public function print(Request $request)
    {
        $tahunAkademikId = $request->tahun_akademik_id;
        $tahun = TahunAkademik::find($tahunAkademikId);

        if (!$tahun) {
            return back()->with('error', 'Silakan pilih tahun akademik terlebih dahulu.');
        }

        $data = $this->getRekapitulasiData($request);

        if (empty($data['items'])) {
            return back()->with('error', 'Tidak ada data untuk tahun akademik yang dipilih.');
        }

        $tahunNama = $tahun->tahun_akademik . ' - ' . $tahun->semester;

        return view('admin.rekapitulasi.print', compact(
            'data',
            'tahun',
            'tahunNama'
        ));
    }
}