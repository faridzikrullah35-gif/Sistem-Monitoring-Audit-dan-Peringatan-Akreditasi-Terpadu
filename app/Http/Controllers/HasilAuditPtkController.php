<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditPtk;
use App\Models\TahunAkademik;
use App\Models\User;
use App\Models\Auditiee;
use App\Models\SettingAksesAuditor;
use App\Models\IsiAksesAuditor;
use Carbon\Carbon;

class HasilAuditPtkController extends Controller
{
    /**
     * Query builder dengan filter dan relasi lengkap
     */
    private function getPtkQuery(Request $request)
    {
        return AuditPtk::with([
                'user.settingAksesAuditor.isiAkses.auditor',
                'pertanyaanAmiProdi.isiIndikator',
                'pertanyaanAmiUnit.isiIndikator',
                'auditPeriksa',
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
     * Ambil daftar nama auditor (lead + anggota) dari setting akses
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
            // Ambil indikator dari relasi pertanyaan (prodi atau unit)
            $pertanyaan = $item->pertanyaanAmiProdi ?? $item->pertanyaanAmiUnit;
            // PERBAIKAN: pakai 'indikator', bukan 'nama'
            $indikator = optional($pertanyaan->isiIndikator)->indikator ?? '-';

            // Klausul langsung dari audit_ptk
            $klausul = $item->klausul_dokumen ?? '-';

            // Analisis dan Akibat dari audit_ptk
            $analisis = $item->analisis_penyebab ?? '-';
            $akibat = $item->akibat ?? '-';

            // Nama file (tanpa path)
            $file = $item->file_auditee ? basename($item->file_auditee) : '-';

            return (object) [
                'no_ncr'                            => $item->no_ncr ?? '-',
                'indikator'                         => $indikator,
                'klausul_dokumen'                   => $klausul,
                'deskripsi_uraian_temuan'           => $item->deskripsi_uraian_temuan ?? '-',
                'analisis_penyebab'                 => $analisis,
                'akibat'                            => $akibat,
                'kategori_temuan'                   => $item->kategori_temuan ?? '-',
                'rencana_tindakan_perbaikan_auditee'=> $item->rencana_tindakan_perbaikan_auditee ?? '-',
                'tanggal_target_perbaikan_auditee'  => $item->tanggal_target_perbaikan_auditee 
                                                        ? Carbon::parse($item->tanggal_target_perbaikan_auditee)->translatedFormat('d F Y') 
                                                        : '-',
                'tindakan_pencegahan_auditee'       => $item->tindakan_pencegahan_auditee ?? '-',
                'file_auditee'                      => $file,
                'tanggal_selesai'                   => $item->tanggal_selesai 
                                                        ? Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') 
                                                        : '-',
                'status_ncr'                        => $item->status_ncr ?? '-',
            ];
        });

        return $data;
    }

    /**
     * Halaman utama
     */
    public function index(Request $request)
    {
        $data = $this->getPtkQuery($request)
            ->paginate(10)
            ->withQueryString();

        $data = $this->transformData($data);

        // Tahun akademik
        $tahunAkademiks = TahunAkademik::whereIn(
                'id',
                \App\Models\PertanyaanAmiProdi::select('tahun_akademik_id')
                    ->whereIn('id', function ($q) {
                        $q->select('pertanyaan_ami_prodi_id')
                          ->from('audit_ptk')
                          ->whereNotNull('pertanyaan_ami_prodi_id');
                    })
                    ->union(
                        \App\Models\PertanyaanAmiUnit::select('tahun_akademik_id')
                            ->whereIn('id', function ($q) {
                                $q->select('pertanyaan_ami_unit_id')
                                  ->from('audit_ptk')
                                  ->whereNotNull('pertanyaan_ami_unit_id');
                            })
                    )
            )
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        $units = User::whereNotNull('unit')->distinct()->pluck('unit');
        $subUnits = User::whereNotNull('sub_unit')->distinct()->pluck('sub_unit');

        return view('pages.hasil-audit-ptk', compact(
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
        $data = $this->getPtkQuery($request)
            ->paginate(10);

        $data = $this->transformData($data);

        return view(
            'components.hasil-audit.ptk.table',
            compact('data')
        )->render();
    }

    /**
     * Print PDF
     */
    public function print(Request $request)
{
    $tahunAkademikId = $request->tahun_akademik_id;

    $data = $this->getPtkQuery($request)->get();

    if ($data->isEmpty()) {
        return back()->with('error', 'Data PTK tidak ditemukan.');
    }

    // Ambil user dari data pertama (untuk data pendukung seperti auditee, setting, dll)
    $first = $data->first();
    $auditorUserId = $first->users_id;
    $auditorUser = User::find($auditorUserId);

    // Ambil setting akses auditor untuk tanggal audit
    $setting = SettingAksesAuditor::where('user_id', $auditorUserId)->first();
    $tanggal_audit_print = $setting?->tgl_audit 
        ? Carbon::parse($setting->tgl_audit)->translatedFormat('d F Y') 
        : '-';

    // Ambil daftar auditee untuk ditampilkan (ambil dari relasi user->auditees)
    $auditees = Auditiee::where('users_id', $auditorUserId)->get();
    $auditeeNames = $auditees->pluck('nama_auditiee')->implode(', ') ?: '-';

    // Transform data untuk print dengan semua properti yang dibutuhkan view
    $items = $data->map(function ($item) use ($tanggal_audit_print, $auditorUser, $auditeeNames) {
        $pertanyaan = $item->pertanyaanAmiProdi ?? $item->pertanyaanAmiUnit;
        $indikator = optional($pertanyaan->isiIndikator)->indikator ?? '-';
        $klausul = $item->klausul_dokumen ?? '-';
        $analisis = $item->analisis_penyebab ?? '-';
        $akibat = $item->akibat ?? '-';
        $file = $item->file_auditee ? basename($item->file_auditee) : '-';

        // Gabungkan kategori + deskripsi untuk macam_temuan
        $macamTemuan = '';
        if ($item->kategori_temuan) {
            $macamTemuan .= '<strong><u>' . e($item->kategori_temuan) . '</u></strong><br>';
        }
        $macamTemuan .= e($item->deskripsi_uraian_temuan ?? '');

        // Daftar auditor (pakai method yang sudah ada)
        $auditorNames = $this->getAuditorNames($item);

        // Bagian / lokasi
        $bagian = $item->user?->sub_unit ?? $item->user?->unit ?? '-';

        return (object) [
            // Properti untuk tabel utama (sudah ada)
            'no_ncr'                            => $item->no_ncr ?? '-',
            'indikator'                         => $indikator,
            'klausul_dokumen'                   => $klausul,
            'deskripsi_uraian_temuan'           => $item->deskripsi_uraian_temuan ?? '-',
            'analisis_penyebab'                 => $analisis,
            'akibat'                            => $akibat,
            'kategori_temuan'                   => $item->kategori_temuan ?? '-',
            'rencana_tindakan_perbaikan_auditee'=> $item->rencana_tindakan_perbaikan_auditee ?? '-',
            'tanggal_target_perbaikan_auditee'  => $item->tanggal_target_perbaikan_auditee 
                                                    ? Carbon::parse($item->tanggal_target_perbaikan_auditee)->translatedFormat('d F Y') 
                                                    : '-',
            'tindakan_pencegahan_auditee'       => $item->tindakan_pencegahan_auditee ?? '-',
            'file_auditee'                      => $file,
            'tanggal_selesai'                   => $item->tanggal_selesai 
                                                    ? Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') 
                                                    : '-',
            'status_ncr'                        => $item->status_ncr ?? '-',

            // ===== PROPERI TAMBAHAN UNTUK VIEW PRINT NCR =====
            'tanggal_audit'                     => $tanggal_audit_print,
            'klausul'                           => $klausul,
            'bagian'                            => $bagian,
            'auditor'                           => $auditorNames,
            'auditee'                           => $auditeeNames,
            'status_kategori'                   => $item->kategori_temuan ?? 'MINOR',
            'macam_temuan'                      => $macamTemuan,
            'faktor_penyebab'                   => $analisis,
            'tindakan_koreksi'                  => $item->rencana_tindakan_perbaikan_auditee ?? '-',
            'tanggal_target'                    => $item->tanggal_target_perbaikan_auditee 
                                                    ? Carbon::parse($item->tanggal_target_perbaikan_auditee)->translatedFormat('d F Y') 
                                                    : '-',
            'tindakan_pencegahan'               => $item->tindakan_pencegahan_auditee ?? '-',
            'tanggal_verifikasi'                => $item->tanggal_selesai 
                                                    ? Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') 
                                                    : '-',
            'status'                            => $item->status_ncr ?? 'Open',
        ];
    });

    // Data pendukung untuk kop surat (tahun akademik, lokasi audit, dll)
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

    // Daftar auditor untuk info di header (sama seperti sebelumnya)
    $auditors = collect();
    if ($setting) {
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

    return view('admin.ptk.print', compact(
        'items',
        'tahun',
        'lokasi_audit',
        'auditees',
        'auditors',
        'tanggal_audit_print'
    ));
}
}