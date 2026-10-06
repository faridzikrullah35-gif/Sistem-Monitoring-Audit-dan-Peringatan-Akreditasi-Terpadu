<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TahunAkademik;
use App\Models\SettingHakAksesFakultas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FakultasHasilAuditRekapitulasiController extends Controller
{
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
        $user = Auth::user();
        $tahunAkademikId = $request->tahun_akademik_id;

        if (!$tahunAkademikId) {
            return ['items' => [], 'categories' => []];
        }

        // Ambil audit_periksa_id yang sesuai dengan unit/subunit user
        $auditPeriksaIds = DB::table('audit_periksa as ap')
            ->leftJoin('pertanyaan_ami_prodi as pap', 'ap.pertanyaan_ami_prodi_id', '=', 'pap.id')
            ->leftJoin('pertanyaan_ami_unit as pau', 'ap.pertanyaan_ami_unit_id', '=', 'pau.id')
            ->leftJoin('users as u', 'ap.users_id', '=', 'u.id')
            ->where(function ($q) use ($tahunAkademikId) {
                $q->where('pap.tahun_akademik_id', $tahunAkademikId)
                    ->orWhere('pau.tahun_akademik_id', $tahunAkademikId);
            })
            ->when($user->unit && !$request->unit, fn($q) => $q->where('u.unit', $user->unit))
            ->when($request->unit, function ($q) use ($request) {
                return $q->where('u.unit', $request->unit);
            })
            // Filter subunit - jika 'all' maka tidak difilter
            ->when($request->subunit && $request->subunit != 'all', function ($q) use ($request) {
                return $q->where('u.sub_unit', $request->subunit);
            })
            ->pluck('ap.id')
            ->filter()
            ->values()
            ->toArray();

        if (empty($auditPeriksaIds)) {
            return ['items' => [], 'categories' => []];
        }

        $kategoriTemuan = \App\Models\SettingScore::where('generate_ncr', 1)->get();
        $listKategoriTemuan = $kategoriTemuan->pluck('keterangan')->toArray();
        $kategoriObservasi = \App\Models\SettingScore::where('generate_ncr', 0)
            ->where('keterangan', 'Observasi')
            ->first();

        $temuan = \App\Models\AuditPtk::with([
            'user.settingAksesAuditor.isiAkses.auditor',
            'auditPeriksa'
        ])
            ->whereIn('audit_periksa_id', $auditPeriksaIds)
            ->whereIn('kategori_temuan', $listKategoriTemuan)
            ->get();

        $observasi = \App\Models\FormObservasi::with([
            'user.settingAksesAuditor.isiAkses.auditor',
            'auditPeriksa'
        ])
            ->whereIn('audit_periksa_id', $auditPeriksaIds)
            ->get();

        $terpenuhi = \App\Models\FormTerpenuhi::with([
            'user.settingAksesAuditor.isiAkses.auditor',
            'pertanyaanAmiProdi',
            'pertanyaanAmiUnit'
        ])
            ->whereHas('user', function ($q) use ($user, $request) {
                if ($request->unit) {
                    $q->where('unit', $request->unit);
                } elseif ($user->unit) {
                    $q->where('unit', $user->unit);
                }
                // Subunit filter dengan logika 'all'
                if ($request->subunit && $request->subunit != 'all') {
                    $q->where('sub_unit', $request->subunit);
                } elseif (!$request->subunit && $user->sub_unit) {
                    $q->where('sub_unit', $user->sub_unit);
                }
            })
            ->where(function ($q) use ($tahunAkademikId) {
                $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                })->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                });
            })
            ->get();

        $items = [];

        foreach ($temuan as $t) {
            $ap = $t->auditPeriksa;
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
            ];
        }

        foreach ($observasi as $obs) {
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
            ];
        }

        foreach ($terpenuhi as $tp) {
            $pertanyaan = $tp->pertanyaanAmiProdi ?? $tp->pertanyaanAmiUnit;
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
            ];
        }

        usort($items, function ($a, $b) {
            return strtotime($b['tgl_audit']) - strtotime($a['tgl_audit']);
        });

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

    /**
     * Helper untuk mengecek apakah filter tahun akademik sudah dipilih
     */
    private function isYearFilterSelected(Request $request)
    {
        return $request->filled('tahun_akademik_id');
    }

    /**
     * Helper untuk mengecek apakah semua filter lengkap (tahun + unit + subunit)
     * Untuk rekapitulasi, tahun wajib, unit dan subunit opsional
     */
    private function isAllFiltersComplete(Request $request)
    {
        return $request->filled('tahun_akademik_id');
    }

    /**
     * Helper untuk mengecek status filter dan mendapatkan pesan yang sesuai
     */
    private function getFilterStatus(Request $request)
    {
        $tahunSelected = $request->filled('tahun_akademik_id');
        $unitSelected = $request->filled('unit');
        $subunitSelected = $request->filled('subunit');
        
        if (!$tahunSelected && !$unitSelected && !$subunitSelected) {
            return [
                'hasFilter' => false,
                'isComplete' => false,
                'message' => 'Pilih Tahun Akademik terlebih dahulu',
                'subMessage' => 'Tahun Akademik wajib dipilih untuk menampilkan rekapitulasi data'
            ];
        } elseif ($tahunSelected && !$unitSelected && !$subunitSelected) {
            return [
                'hasFilter' => true,
                'isComplete' => true,
                'message' => '',
                'subMessage' => ''
            ];
        } elseif ($tahunSelected && $unitSelected && !$subunitSelected) {
            return [
                'hasFilter' => true,
                'isComplete' => true,
                'message' => '',
                'subMessage' => ''
            ];
        } elseif ($tahunSelected && $unitSelected && $subunitSelected) {
            return [
                'hasFilter' => true,
                'isComplete' => true,
                'message' => '',
                'subMessage' => ''
            ];
        } else {
            return [
                'hasFilter' => true,
                'isComplete' => false,
                'message' => 'Pilih Tahun Akademik terlebih dahulu',
                'subMessage' => 'Tahun Akademik wajib dipilih untuk menampilkan rekapitulasi data'
            ];
        }
    }

    public function index(Request $request)
    {
        $filterStatus = $this->getFilterStatus($request);
        $hasFilter = $filterStatus['hasFilter'];
        $isComplete = $filterStatus['isComplete'];
        
        $tahunAkademiks = TahunAkademik::where('status', 'Aktif')
            ->orderBy('tahun_akademik', 'asc')
            ->orderBy('semester', 'asc')
            ->get();

        $user = Auth::user();
        $fakultasUser = $user->fakultas ?? $user->unit;

        // Ambil unit (fakultas) yang aktif dan sesuai dengan user
        $units = SettingHakAksesFakultas::where('is_active', true)
            ->when($fakultasUser, function ($query) use ($fakultasUser) {
                $query->where('fakultas', $fakultasUser);
            })
            ->distinct()
            ->pluck('fakultas')
            ->toArray();

        // Ambil semua subunit berdasarkan fakultas yang aktif (dengan JSON decode)
        $subUnits = SettingHakAksesFakultas::where('is_active', true)
            ->when($fakultasUser, function ($query) use ($fakultasUser) {
                $query->where('fakultas', $fakultasUser);
            })
            ->whereNotNull('sub_unit')
            ->get()
            ->flatMap(function ($item) {
                if (is_string($item->sub_unit)) {
                    $subUnits = json_decode($item->sub_unit, true);
                    return is_array($subUnits) ? $subUnits : [];
                }
                return is_array($item->sub_unit) ? $item->sub_unit : [];
            })
            ->unique()
            ->values()
            ->toArray();

        // Ambil subunit per unit (fakultas) untuk dependen dropdown
        $subUnitsByUnit = SettingHakAksesFakultas::where('is_active', true)
            ->when($fakultasUser, function ($query) use ($fakultasUser) {
                $query->where('fakultas', $fakultasUser);
            })
            ->whereNotNull('sub_unit')
            ->get()
            ->groupBy('fakultas')
            ->map(function ($items) {
                $subUnits = [];
                foreach ($items as $item) {
                    if (is_string($item->sub_unit)) {
                        $decoded = json_decode($item->sub_unit, true);
                        if (is_array($decoded)) {
                            $subUnits = array_merge($subUnits, $decoded);
                        }
                    } elseif (is_array($item->sub_unit)) {
                        $subUnits = array_merge($subUnits, $item->sub_unit);
                    }
                }
                return array_values(array_unique($subUnits));
            })
            ->toArray();

        return view('pages.fakultas.fakultas-hasil-audit.rekapitulasi', compact(
            'tahunAkademiks',
            'units',
            'subUnits',
            'subUnitsByUnit',
            'hasFilter',
            'filterStatus'
        ));
    }

    public function filter(Request $request)
    {
        $filterStatus = $this->getFilterStatus($request);
        $hasFilter = $filterStatus['hasFilter'];
        $isComplete = $filterStatus['isComplete'];
        
        if (!$isComplete) {
            $data = ['items' => [], 'categories' => []];
        } else {
            $data = $this->getRekapitulasiData($request);
        }

        $tableHtml = view('components.fakultas-hasil-audit.rekapitulasi.table', [
            'items' => $data['items'],
            'categories' => $data['categories'],
            'filterStatus' => $filterStatus,
            'isComplete' => $isComplete
        ])->render();

        return response()->json([
            'table' => $tableHtml,
            'categories' => $data['categories'],
        ]);
    }

    /**
     * Print rekapitulasi data
     */
    public function print(Request $request)
    {
        $data = $this->getRekapitulasiData($request);
        $items = $data['items'];
        $categories = $data['categories'];

        if (empty($items)) {
            return back()->with('error', 'Data rekapitulasi tidak ditemukan.');
        }

        $tahunAkademikId = $request->tahun_akademik_id;
        $tahun = TahunAkademik::find($tahunAkademikId);

        // Ambil setting header cetak
        $settingHeader = \App\Models\SettingHeaderCetak::latest('id')->first();
        $no_dokumen = $settingHeader?->no_dokumen ?? '-';
        $tanggal_terbit = $settingHeader?->tanggal_terbit
            ? Carbon::parse($settingHeader->tanggal_terbit)->format('d-m-Y')
            : '-';
        $no_revisi = $settingHeader?->no_revisi ?? '-';

        return view('admin.rekapitulasi.print', compact(
            'data',
            'items',
            'categories',
            'tahun',
            'no_dokumen',
            'tanggal_terbit',
            'no_revisi'
        ));
    }
}