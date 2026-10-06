<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\IsiIndikator;
use App\Models\PenilaianKinerja;
use App\Models\AuditPeriksa;
use App\Models\AuditPtk;
use App\Models\FormObservasi;
use App\Models\FormTerpenuhi;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\AksesPertanyaanProdi;
use App\Models\AksesPertanyaanUnit;
use App\Models\Standar;
use App\Models\User;
use App\Models\DataAuditor;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalAmiProdi = PertanyaanAmiProdi::count();
        $totalAmiUnit  = PertanyaanAmiUnit::count();

        $totalDataAmi = $totalAmiProdi + $totalAmiUnit;

        // Tahun Akademik Aktif
        $tahunAkademikAktif = TahunAkademik::where('status', 'Aktif')->first();

        $totalUnit = User::whereNotNull('unit')
            ->where('unit', '!=', '')
            ->distinct('unit')
            ->count('unit');

        $totalSubUnit = User::whereNotNull('sub_unit')
            ->where('sub_unit', '!=', '')
            ->distinct('sub_unit')
            ->count('sub_unit');

        $totalUnitSubUnit = $totalUnit + $totalSubUnit;

        $totalAuditorAktif = DataAuditor::where('status', 'Aktif')->count();
        $totalAuditorNonAktif = DataAuditor::where('status', 'Non Aktif')->count();
        $totalAuditor = $totalAuditorAktif + $totalAuditorNonAktif;

        $recentAudits = PertanyaanAmiProdi::with([
                'isiIndikator.matrix',
                'akses',
            ])
            ->latest()
            ->take(5)
            ->get()
            ->concat(
                PertanyaanAmiUnit::with([
                        'isiIndikator.matrix',
                        'akses',
                    ])
                    ->latest()
                    ->take(5)
                    ->get()
            )
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        $unitData = User::select('unit')
            ->whereNotNull('unit')
            ->where('unit', '!=', '')
            ->groupBy('unit')
            ->selectRaw("
                unit,
                COUNT(DISTINCT CASE
                    WHEN sub_unit IS NOT NULL AND sub_unit <> ''
                    THEN sub_unit
                END) as total_sub_unit,
                COUNT(*) as total_user
            ")
            ->orderBy('unit')
            ->get();

        $standars = collect()

            ->merge(
                PertanyaanAmiProdi::where('tahun_akademik_id', $tahunAkademikAktif->id)
                    ->with('isiIndikator.matrix.kriteriaAudit.standar')
                    ->get()
                    ->pluck('isiIndikator.matrix.kriteriaAudit.standar')
            )

            ->merge(
                PertanyaanAmiUnit::where('tahun_akademik_id', $tahunAkademikAktif->id)
                    ->with('isiIndikator.matrix.kriteriaAudit.standar')
                    ->get()
                    ->pluck('isiIndikator.matrix.kriteriaAudit.standar')
            )

            ->filter()
            ->unique('id')
            ->sortBy('id')
            ->values();

        $dataAuditorRaw = AuditPeriksa::whereNotNull('setting_score_id')
            ->whereHas('pertanyaanAmiProdi', function ($q) use ($tahunAkademikAktif) {
                $q->where('tahun_akademik_id', $tahunAkademikAktif->id);
            })
            ->with([
                'score',
                'pertanyaanAmiProdi.isiIndikator.matrix.kriteriaAudit.standar',
            ])
            ->get()
            ->groupBy(function ($item) {
                return optional(
                    $item->pertanyaanAmiProdi?->isiIndikator?->matrix?->kriteriaAudit
                )->standar_id;
            });

        $dataUnitKerjaRaw = AuditPeriksa::whereNotNull('setting_score_id')
            ->whereHas('pertanyaanAmiUnit', function ($q) use ($tahunAkademikAktif) {
                $q->where('tahun_akademik_id', $tahunAkademikAktif->id);
            })
            ->with([
                'score',
                'pertanyaanAmiUnit.isiIndikator.matrix.kriteriaAudit.standar',
            ])
            ->get()
            ->groupBy(function ($item) {
                return optional(
                    $item->pertanyaanAmiUnit?->isiIndikator?->matrix?->kriteriaAudit
                )->standar_id;
            });

        $dataAuditeeRaw = PenilaianKinerja::whereNotNull('setting_score_id')
            ->with([
                'score',
                'isiIndikator.matrix.kriteriaAudit.standar'
            ])
            ->get()
            ->groupBy(function ($item) {
                return optional(
                    $item->isiIndikator?->matrix?->kriteriaAudit
                )->standar_id;
            });

        $chartLabels = [];
        $chartDataAuditor = [];
        $chartDataAuditee = [];
        $chartDataUnitKerja = [];

        foreach ($standars as $standar) {

            $auditorItems = $dataAuditorRaw->get($standar->id, collect());
            $unitItems    = $dataUnitKerjaRaw->get($standar->id, collect());
            $auditeeItems = $dataAuditeeRaw->get($standar->id, collect());

            $chartLabels[] = $standar->nama;

            $chartDataAuditor[] = $auditorItems->count()
                ? round($auditorItems->avg(fn($i) => $this->parseScore($i)), 2)
                : 0;

            $chartDataUnitKerja[] = $unitItems->count()
                ? round($unitItems->avg(fn($i) => $this->parseScore($i)), 2)
                : 0;

            $chartDataAuditee[] = $auditeeItems->count()
                ? round($auditeeItems->avg(fn($i) => $this->parseScore($i)), 2)
                : 0;
        }

        $chartSeries = [
            [
                'name' => 'Auditor',
                'data' => $chartDataAuditor,
            ],
            [
                'name' => 'Unit Kerja',
                'data' => $chartDataUnitKerja,
            ],
            [
                'name' => 'Auditee',
                'data' => $chartDataAuditee,
            ],
        ];

        return view('pages.dashboard.dashboard', [
            'title'                 => 'Dashboard Admin | SIMANTAP',
            'totalDataAmi'          => $totalDataAmi,
            'tahunAkademikAktif'    => $tahunAkademikAktif,
            'totalUnit'             => $totalUnit,
            'totalSubUnit'          => $totalSubUnit,
            'totalUnitSubUnit'      => $totalUnitSubUnit,
            'totalAuditor'          => $totalAuditor,
            'totalAuditorAktif'     => $totalAuditorAktif,
            'totalAuditorNonAktif'  => $totalAuditorNonAktif,
            'recentAudits'          => $recentAudits,
            'recentAudits'          => $recentAudits,
            'unitData'              => $unitData,
            'chartLabels'           => $chartLabels,
            'chartSeries'           => $chartSeries,
        ]);
    }
    
    public function auditor()
    {
        $user = auth()->user();

        // 1. Tahun akademik aktif
        $tahunAkademikAktif = $this->getTahunAkademikAktif();

        // 2. Query semua AuditPeriksa yang terkait dengan unit/sub_unit user
        $auditPeriksaQuery = AuditPeriksa::where(function ($q) use ($user) {
            $q->whereHas('pertanyaanAmiProdi.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });
            $q->orWhereHas('pertanyaanAmiUnit.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });
        })->where(function ($q) use ($tahunAkademikAktif) {
            $q->whereHas('pertanyaanAmiProdi', function ($q2) use ($tahunAkademikAktif) {
                $q2->where('tahun_akademik_id', $tahunAkademikAktif->id);
            })->orWhereHas('pertanyaanAmiUnit', function ($q2) use ($tahunAkademikAktif) {
                $q2->where('tahun_akademik_id', $tahunAkademikAktif->id);
            });
        });

        // 3. Statistik dasar
        $totalAudit = $auditPeriksaQuery->count();
        $selesai    = (clone $auditPeriksaQuery)->whereNotNull('setting_score_id')->count();
        $proses     = $totalAudit - $selesai;
        $progressPersen = $totalAudit > 0 ? round(($selesai / $totalAudit) * 100) : 0;

        // 4. ID audit periksa untuk temuan
        $auditPeriksaIds = $auditPeriksaQuery->pluck('id');

        // 5. Temuan (opsional, bisa digunakan untuk card tambahan)
        $ncrMayor   = AuditPtk::whereIn('audit_periksa_id', $auditPeriksaIds)->where('kategori_temuan', 'Mayor')->count();
        $ncrMinor   = AuditPtk::whereIn('audit_periksa_id', $auditPeriksaIds)->where('kategori_temuan', 'Minor')->count();
        $observasi  = FormObservasi::whereIn('audit_periksa_id', $auditPeriksaIds)->count();
        $terpenuhi  = FormTerpenuhi::whereIn('audit_periksa_id', $auditPeriksaIds)->count();

        // 6. Grafik nilai per standar

        // Ambil semua AuditPeriksa yang sudah dinilai beserta relasi
        $auditPeriksas = $auditPeriksaQuery->with([
            'score',
            'pertanyaanAmiProdi.isiIndikator.matrix.kriteriaAudit.standar',
            'pertanyaanAmiUnit.isiIndikator.matrix.kriteriaAudit.standar'
        ])->get();

        // Ambil standar yang benar-benar digunakan pada Pertanyaan AMI
        $pertanyaanProdi = PertanyaanAmiProdi::forAuditor($user)
            ->where('tahun_akademik_id', $tahunAkademikAktif->id)
            ->with('isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        $pertanyaanUnit = PertanyaanAmiUnit::forAuditor($user)
            ->where('tahun_akademik_id', $tahunAkademikAktif->id)
            ->with('isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        $standars = collect()
            ->merge(
                $pertanyaanProdi->pluck('isiIndikator.matrix.kriteriaAudit.standar')
            )
            ->merge(
                $pertanyaanUnit->pluck('isiIndikator.matrix.kriteriaAudit.standar')
            )
            ->filter()
            ->unique('id')
            ->sortBy('id')
            ->values();

        // Data Auditor (semua audit)
        $dataAuditorRaw = $auditPeriksas->groupBy(function ($item) {
            $standar = optional($item->pertanyaanAmiProdi?->isiIndikator?->matrix?->kriteriaAudit)->standar_id;
            if (!$standar) {
                $standar = optional($item->pertanyaanAmiUnit?->isiIndikator?->matrix?->kriteriaAudit)->standar_id;
            }
            return $standar;
        });

        // Data Unit Kerja (khusus yang memiliki pertanyaan_ami_unit_id)
        $dataUnitKerjaRaw = $auditPeriksas->filter(function ($item) {
            return !is_null($item->pertanyaan_ami_unit_id);
        })->groupBy(function ($item) {
            return optional($item->pertanyaanAmiUnit?->isiIndikator?->matrix?->kriteriaAudit)->standar_id;
        });

        $isiIndikatorIds = collect()
            ->merge(
                $auditPeriksas
                    ->pluck('pertanyaanAmiProdi.isi_indikator_id')
            )
            ->merge(
                $auditPeriksas
                    ->pluck('pertanyaanAmiUnit.isi_indikator_id')
            )
            ->filter()
            ->unique()
            ->values();

        // Data Auditee (self-assessment dari user dengan unit/sub_unit yang sama)
        $dataAuditeeRaw = PenilaianKinerja::whereNotNull('setting_score_id')
            ->whereHas('user', function ($q) use ($user) {
                $q->where('unit', $user->unit)
                ->where('sub_unit', $user->sub_unit);
            })
            ->whereIn('isi_indikator_id', $isiIndikatorIds)
            ->with([
                'score',
                'isiIndikator.matrix.kriteriaAudit.standar'
            ])
            ->get()
            ->groupBy(function ($item) {
                return optional(
                    $item->isiIndikator?->matrix?->kriteriaAudit
                )->standar_id;
            });

        $chartLabels       = [];
        $chartDataAuditor   = [];
        $chartDataUnitKerja = [];
        $chartDataAuditee   = [];

        foreach ($standars as $standar) {
            $chartLabels[] = $standar->nama;

            $auditorItems = $dataAuditorRaw->get($standar->id, collect());
            $unitItems    = $dataUnitKerjaRaw->get($standar->id, collect());
            $auditeeItems = $dataAuditeeRaw->get($standar->id, collect());

            $chartDataAuditor[] = $auditorItems->count() ? round($auditorItems->avg(fn ($i) => $this->parseScore($i)), 2) : 0;
            $chartDataUnitKerja[] = $unitItems->count() ? round($unitItems->avg(fn ($i) => $this->parseScore($i)), 2) : 0;
            $chartDataAuditee[] = $auditeeItems->count() ? round($auditeeItems->avg(fn ($i) => $this->parseScore($i)), 2) : 0;
        }

        // 7. Deadline & Progress per unit/sub_unit (hanya satu untuk auditor)
        $deadline = $this->getDeadlineFromTahunAkademik($tahunAkademikAktif);
        $sisaHari = now()->diffInDays($deadline, false);
        if ($sisaHari < 0) $sisaHari = 0;

        $status = $selesai == $totalAudit ? 'Selesai' : ($selesai > 0 ? 'Proses Input' : 'Belum Mulai');

        $deadlineItems = [
            [
                'unit_sub_unit' => $user->unit . ' - ' . $user->sub_unit,
                'deadline'      => $deadline->format('d M Y'),
                'sisa_hari'     => $sisaHari,
                'status'        => $status,
                'progress'      => $progressPersen,
            ]
        ];

        $progressItems = [
            [
                'label'     => $user->unit . ' - ' . $user->sub_unit,
                'progress'  => $progressPersen,
                'deadline'  => $deadline->format('d M Y'),
                'status'    => $status,
            ]
        ];

        $isUnitKerja = !empty($user->unit) &&
                    strcasecmp($user->unit, $user->sub_unit) === 0;

        if ($isUnitKerja) {

            // Unit Kerja
            $chartSeries = [
                [
                    'name' => 'Unit Kerja',
                    'data' => $chartDataUnitKerja,
                ],
                [
                    'name' => 'Auditee',
                    'data' => $chartDataAuditee,
                ],
            ];

        } else {

            // Prodi
            $chartSeries = [
                [
                    'name' => 'Auditor',
                    'data' => $chartDataAuditor,
                ],
                [
                    'name' => 'Auditee',
                    'data' => $chartDataAuditee,
                ],
            ];

        }

        // Deadline mendekat (progress < 100 dan sisa hari <= 7)
        $deadlineMendekat = ($progressPersen < 100 && $sisaHari <= 7 && $sisaHari >= 0) ? 1 : 0;

        // 8. Kirim ke view
        return view('pages.dashboard-auditor.dashboard-auditor', [
            'title'                => 'Dashboard Auditor | SIMANTAP',
            'totalAudit'           => $totalAudit,
            'selesai'              => $selesai,
            'proses'               => $proses,
            'deadlineMendekat'     => $deadlineMendekat,
            'deadlineItems'        => $deadlineItems,
            'progressItems'        => $progressItems,
            'chartLabels'          => $chartLabels,
            'chartDataAuditor'     => $chartDataAuditor,
            'chartDataUnitKerja'   => $chartDataUnitKerja,
            'chartDataAuditee'     => $chartDataAuditee,
            'tahunAkademikAktif'   => $tahunAkademikAktif,
            'statusAudit'          => $status,
            'deadline'             => $deadline->format('d M Y'),
            'chartSeries'          => $chartSeries,
        ]);
    }

    private function getDeadlineFromTahunAkademik($tahunAkademik)
    {
        $parts = explode('/', $tahunAkademik->tahun_akademik);
        $tahunAwal = (int) $parts[0];
        $tahunAkhir = (int) $parts[1];

        if ($tahunAkademik->semester == 'Ganjil') {
            return \Carbon\Carbon::create($tahunAwal, 12, 31);
        } else { // Genap
            return \Carbon\Carbon::create($tahunAkhir, 6, 30);
        }
    }

    public function prodi()
    {
        $user = auth()->user();

        // 1. Tahun Akademik Aktif
        $tahunAkademikAktif = $this->getTahunAkademikAktif();

        // 2. Ambil pertanyaan AMI yang memang bisa diakses Auditee
        $pertanyaanProdi = PertanyaanAmiProdi::where('tahun_akademik_id', $tahunAkademikAktif->id)
            ->whereHas('akses', function ($q) use ($user) {
                $q->where('unit', $user->unit)->where('sub_unit', $user->sub_unit);
            })
            ->with('isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        $pertanyaanUnit = PertanyaanAmiUnit::where('tahun_akademik_id', $tahunAkademikAktif->id)
            ->whereHas('akses', function ($q) use ($user) {
                $q->where('unit', $user->unit)->where('sub_unit', $user->sub_unit);
            })
            ->with('isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        $pertanyaanProdiIds = $pertanyaanProdi->pluck('id');
        $pertanyaanUnitIds = $pertanyaanUnit->pluck('id');

        // 3. Total daftar periksa yang tersedia untuk Auditee
        $auditPeriksaQuery = AuditPeriksa::where(function ($q) use ($pertanyaanProdiIds, $pertanyaanUnitIds) {
            $q->whereIn('pertanyaan_ami_prodi_id', $pertanyaanProdiIds)
                ->orWhereIn('pertanyaan_ami_unit_id', $pertanyaanUnitIds);
        });

        $totalPertanyaan = (clone $auditPeriksaQuery)->count();

        // 4. Daftar periksa yang sudah dinilai auditor
        $sudahDiperiksa = (clone $auditPeriksaQuery)->whereNotNull('setting_score_id')->count();
        $belumDiperiksa = max(0, $totalPertanyaan - $sudahDiperiksa);
        $progressPersen = $totalPertanyaan > 0 ? round(($sudahDiperiksa / $totalPertanyaan) * 100) : 0;

        // 5. ID Audit Periksa yang berkaitan dengan Auditee
        $auditPeriksaIds = (clone $auditPeriksaQuery)->pluck('id');

        // 6. Ringkasan Temuan
        $ncrMayor = AuditPtk::whereIn('audit_periksa_id', $auditPeriksaIds)->where('kategori_temuan', 'Mayor')->count();
        $ncrMinor = AuditPtk::whereIn('audit_periksa_id', $auditPeriksaIds)->where('kategori_temuan', 'Minor')->count();
        $observasi = FormObservasi::whereIn('audit_periksa_id', $auditPeriksaIds)->count();
        $terpenuhi = FormTerpenuhi::whereIn('audit_periksa_id', $auditPeriksaIds)->count();

        // 7. Grafik Nilai AMI per Standar
        $standars = collect()
            ->merge($pertanyaanProdi->pluck('isiIndikator.matrix.kriteriaAudit.standar'))
            ->merge($pertanyaanUnit->pluck('isiIndikator.matrix.kriteriaAudit.standar'))
            ->filter()
            ->unique('id')
            ->sortBy('id')
            ->values();

        // 8. Data Auditor
        $dataAuditorRaw = (clone $auditPeriksaQuery)
            ->whereNotNull('setting_score_id')
            ->with([
                'score',
                'pertanyaanAmiProdi.isiIndikator.matrix.kriteriaAudit.standar',
                'pertanyaanAmiUnit.isiIndikator.matrix.kriteriaAudit.standar',
            ])
            ->get()
            ->groupBy(function ($item) {
                $standarProdi = $item->pertanyaanAmiProdi?->isiIndikator?->matrix?->kriteriaAudit?->standar_id;
                $standarUnit = $item->pertanyaanAmiUnit?->isiIndikator?->matrix?->kriteriaAudit?->standar_id;
                return $standarProdi ?? $standarUnit;
            });

        // 9. ID Isi Indikator
        $isiIndikatorIds = collect()
            ->merge($pertanyaanProdi->pluck('isi_indikator_id'))
            ->merge($pertanyaanUnit->pluck('isi_indikator_id'))
            ->filter()
            ->unique()
            ->values();

        // 10. Data Auditee
        $dataAuditeeRaw = PenilaianKinerja::whereNotNull('setting_score_id')
            ->where('users_id', $user->id)
            ->whereIn('isi_indikator_id', $isiIndikatorIds)
            ->with([
                'score',
                'isiIndikator.matrix.kriteriaAudit.standar',
            ])
            ->get()
            ->groupBy(function ($item) {
                return optional($item->isiIndikator?->matrix?->kriteriaAudit)->standar_id;
            });

        // 11. Susun data grafik
        $chartLabels = [];
        $chartDataAuditor = [];
        $chartDataAuditee = [];

        foreach ($standars as $standar) {
            $chartLabels[] = $standar->nama;

            $auditorItems = $dataAuditorRaw->get($standar->id, collect());
            $auditeeItems = $dataAuditeeRaw->get($standar->id, collect());

            $chartDataAuditor[] = $auditorItems->count()
                ? round($auditorItems->avg(fn ($item) => $this->parseScore($item)), 2)
                : 0;

            $chartDataAuditee[] = $auditeeItems->count()
                ? round($auditeeItems->avg(fn ($item) => $this->parseScore($item)), 2)
                : 0;
        }

        // 12. Series Grafik
        $chartSeries = [
            ['name' => 'Auditor', 'data' => $chartDataAuditor],
            ['name' => 'Auditee', 'data' => $chartDataAuditee],
        ];

        // 13. Status Audit
        $tahunAkademikText = $tahunAkademikAktif->tahun_akademik . ' - ' . $tahunAkademikAktif->semester;

        if ($auditPeriksaIds->isEmpty()) {
            $statusAudit = 'Belum Dimulai';
        } elseif ($sudahDiperiksa < $totalPertanyaan) {
            $statusAudit = 'Sedang Berjalan';
        } else {
            $statusAudit = 'Selesai';
        }

        // 14. Deadline
        $deadline = '30 Mei 2026';

        // 15. Timeline
        $timeline = [
            'pembukaan' => true,
            'isi_evaluasi' => $dataAuditeeRaw->isNotEmpty(),
            'pemeriksaan_auditor' => $sudahDiperiksa > 0,
            'tindak_lanjut' => ($ncrMayor + $ncrMinor) > 0,
            'penutupan' => $totalPertanyaan > 0 && $sudahDiperiksa >= $totalPertanyaan,
        ];

        // ==================== AMBIL NOTIFIKASI ====================
        $notifications = $this->getAuditeeNotificationsData($user, $tahunAkademikAktif);

        // 16. Kirim data ke Dashboard Auditee
        return view('pages.dashboard-auditee.dashboard-auditee', [
            'title' => 'Dashboard Auditee | SIMANTAP',
            'totalPertanyaan' => $totalPertanyaan,
            'sudahDiisi' => $sudahDiperiksa,
            'belumDiisi' => $belumDiperiksa,
            'progressPersen' => $progressPersen,
            'ncrMayor' => $ncrMayor,
            'ncrMinor' => $ncrMinor,
            'observasi' => $observasi,
            'terpenuhi' => $terpenuhi,
            'chartLabels' => $chartLabels,
            'chartDataAuditor' => $chartDataAuditor,
            'chartDataAuditee' => $chartDataAuditee,
            'tahunAkademikText' => $tahunAkademikText,
            'statusAudit' => $statusAudit,
            'deadline' => $deadline,
            'timeline' => $timeline,
            'chartSeries' => $chartSeries,
            'notifications' => $notifications,
        ]);
    }

    public function fakultas()
    {
        $user = auth()->user();

        // ==========================================================
        // 1. Tahun akademik aktif
        // ==========================================================
        $tahunAkademikAktif = $this->getTahunAkademikAktif();

        // ==========================================================
        // 2. Ambil seluruh Auditee/Prodi di bawah Fakultas
        // ==========================================================
        $auditeeUsers = User::where('unit', $user->unit)
            ->where('role', 'auditee')
            ->get();

        $auditeeUserIds = $auditeeUsers->pluck('id');

        // ==========================================================
        // 3. Pertanyaan AMI yang digunakan Fakultas
        // ==========================================================
        $pertanyaanProdiIds = PertanyaanAmiProdi::where(
                'tahun_akademik_id',
                $tahunAkademikAktif->id
            )
            ->whereHas('akses', function ($q) use ($user) {
                $q->where('unit', $user->unit);
            })
            ->pluck('id');

        $pertanyaanUnitIds = PertanyaanAmiUnit::where(
                'tahun_akademik_id',
                $tahunAkademikAktif->id
            )
            ->whereHas('akses', function ($q) use ($user) {
                $q->where('unit', $user->unit);
            })
            ->pluck('id');

        // ==========================================================
        // 4. Total pertanyaan
        // ==========================================================
        $totalPertanyaan = AuditPeriksa::where(function ($q) use (
            $pertanyaanProdiIds,
            $pertanyaanUnitIds
        ) {
            $q->whereIn(
                'pertanyaan_ami_prodi_id',
                $pertanyaanProdiIds
            )
            ->orWhereIn(
                'pertanyaan_ami_unit_id',
                $pertanyaanUnitIds
            );
        })
        ->count();

        // ==========================================================
        // 5. Yang sudah diperiksa auditor
        // ==========================================================
        $sudahDiperiksa = AuditPeriksa::where(function ($q) use (
            $pertanyaanProdiIds,
            $pertanyaanUnitIds
        ) {
            $q->whereIn(
                'pertanyaan_ami_prodi_id',
                $pertanyaanProdiIds
            )
            ->orWhereIn(
                'pertanyaan_ami_unit_id',
                $pertanyaanUnitIds
            );
        })
        ->whereNotNull('setting_score_id')
        ->count();

        $belumDiperiksa = max(
            0,
            $totalPertanyaan - $sudahDiperiksa
        );

        $progressPersen = $totalPertanyaan > 0
            ? round(($sudahDiperiksa / $totalPertanyaan) * 100)
            : 0;

        // ==========================================================
        // 6. ID Audit Periksa Fakultas
        // ==========================================================
        $auditPeriksaIds = AuditPeriksa::where(function ($q) use (
            $pertanyaanProdiIds,
            $pertanyaanUnitIds
        ) {
            $q->whereIn(
                'pertanyaan_ami_prodi_id',
                $pertanyaanProdiIds
            )
            ->orWhereIn(
                'pertanyaan_ami_unit_id',
                $pertanyaanUnitIds
            );
        })
        ->pluck('id');

        // ==========================================================
        // 7. Ringkasan Temuan
        // ==========================================================
        $ncrMayor = AuditPtk::whereIn(
            'audit_periksa_id',
            $auditPeriksaIds
        )
        ->where('kategori_temuan', 'Mayor')
        ->count();

        $ncrMinor = AuditPtk::whereIn(
            'audit_periksa_id',
            $auditPeriksaIds
        )
        ->where('kategori_temuan', 'Minor')
        ->count();

        $observasi = FormObservasi::whereIn(
            'audit_periksa_id',
            $auditPeriksaIds
        )->count();

        $terpenuhi = FormTerpenuhi::whereIn(
            'audit_periksa_id',
            $auditPeriksaIds
        )->count();

        // ==========================================================
        // 8. DATA GRAFIK AMI PER STANDAR
        // ==========================================================

        // ----------------------------------------------------------
        // Ambil seluruh standar yang digunakan Fakultas
        // ----------------------------------------------------------
        $standars = collect()

            ->merge(
                PertanyaanAmiProdi::whereIn(
                    'id',
                    $pertanyaanProdiIds
                )
                ->with(
                    'isiIndikator.matrix.kriteriaAudit.standar'
                )
                ->get()
                ->pluck(
                    'isiIndikator.matrix.kriteriaAudit.standar'
                )
            )

            ->merge(
                PertanyaanAmiUnit::whereIn(
                    'id',
                    $pertanyaanUnitIds
                )
                ->with(
                    'isiIndikator.matrix.kriteriaAudit.standar'
                )
                ->get()
                ->pluck(
                    'isiIndikator.matrix.kriteriaAudit.standar'
                )
            )

            ->filter()
            ->unique('id')
            ->sortBy('id')
            ->values();

        // ----------------------------------------------------------
        // Data Auditor
        // ----------------------------------------------------------
        $dataAuditorRaw = AuditPeriksa::whereNotNull(
                'setting_score_id'
            )
            ->where(function ($q) use (
                $pertanyaanProdiIds,
                $pertanyaanUnitIds
            ) {
                $q->whereIn(
                    'pertanyaan_ami_prodi_id',
                    $pertanyaanProdiIds
                )
                ->orWhereIn(
                    'pertanyaan_ami_unit_id',
                    $pertanyaanUnitIds
                );
            })
            ->with([
                'score',
                'pertanyaanAmiProdi.isiIndikator.matrix.kriteriaAudit.standar',
                'pertanyaanAmiUnit.isiIndikator.matrix.kriteriaAudit.standar',
            ])
            ->get()
            ->groupBy(function ($item) {

                $standarProdi =
                    $item->pertanyaanAmiProdi
                        ?->isiIndikator
                        ?->matrix
                        ?->kriteriaAudit
                        ?->standar_id;

                $standarUnit =
                    $item->pertanyaanAmiUnit
                        ?->isiIndikator
                        ?->matrix
                        ?->kriteriaAudit
                        ?->standar_id;

                return $standarProdi ?? $standarUnit;
            });

        // ----------------------------------------------------------
        // Isi indikator yang digunakan
        // ----------------------------------------------------------
        $isiIndikatorIds = collect()

            ->merge(
                PertanyaanAmiProdi::whereIn(
                    'id',
                    $pertanyaanProdiIds
                )
                ->pluck('isi_indikator_id')
            )

            ->merge(
                PertanyaanAmiUnit::whereIn(
                    'id',
                    $pertanyaanUnitIds
                )
                ->pluck('isi_indikator_id')
            )

            ->unique()
            ->values();

        // ----------------------------------------------------------
        // Data Auditee seluruh Prodi Fakultas
        // ----------------------------------------------------------
        $dataAuditeeRaw = PenilaianKinerja::whereNotNull(
                'setting_score_id'
            )
            ->whereIn(
                'users_id',
                $auditeeUserIds
            )
            ->whereIn(
                'isi_indikator_id',
                $isiIndikatorIds
            )
            ->with([
                'score',
                'isiIndikator.matrix.kriteriaAudit.standar'
            ])
            ->get()
            ->groupBy(function ($item) {

                return optional(
                    $item->isiIndikator?->matrix?->kriteriaAudit
                )->standar_id;
            });

        // ==========================================================
        // 9. Susun data grafik
        // ==========================================================
        $chartLabels = [];

        $chartDataAuditor = [];

        $chartDataAuditee = [];

        foreach ($standars as $standar) {

            $chartLabels[] = $standar->nama;

            $auditorItems =
                $dataAuditorRaw->get(
                    $standar->id,
                    collect()
                );

            $auditeeItems =
                $dataAuditeeRaw->get(
                    $standar->id,
                    collect()
                );

            // Nilai Auditor
            $chartDataAuditor[] =
                $auditorItems->count()
                    ? round(
                        $auditorItems->avg(
                            fn ($item) =>
                                $this->parseScore($item)
                        ),
                        2
                    )
                    : 0;

            // Nilai rata-rata seluruh Auditee
            $chartDataAuditee[] =
                $auditeeItems->count()
                    ? round(
                        $auditeeItems->avg(
                            fn ($item) =>
                                $this->parseScore($item)
                        ),
                        2
                    )
                    : 0;
        }

        // ==========================================================
        // 10. Series grafik Fakultas
        // ==========================================================
        $chartSeries = [

            [
                'name' => 'Auditor',
                'data' => $chartDataAuditor,
            ],

            [
                'name' => 'Auditee',
                'data' => $chartDataAuditee,
            ],

        ];

        // ==========================================================
        // 11. Tahun Akademik
        // ==========================================================
        $tahunAkademikText =
            $tahunAkademikAktif->tahun_akademik
            . ' - '
            . $tahunAkademikAktif->semester;

        // ==========================================================
        // 12. Status Audit
        // ==========================================================
        if ($auditPeriksaIds->isEmpty()) {

            $statusAudit = 'Belum Dimulai';

        } elseif ($sudahDiperiksa < $totalPertanyaan) {

            $statusAudit = 'Sedang Berjalan';

        } else {

            $statusAudit = 'Selesai';
        }

        // ==========================================================
        // 13. Deadline
        // ==========================================================
        $deadline = '30 Mei 2026';

        // ==========================================================
        // 14. Timeline
        // ==========================================================
        $timeline = [

            'pembukaan' => true,

            'isi_evaluasi' =>
                $auditeeUserIds->isNotEmpty(),

            'pemeriksaan_auditor' =>
                $sudahDiperiksa > 0,

            'tindak_lanjut' =>
                ($ncrMayor + $ncrMinor) > 0,

            'penutupan' =>
                $totalPertanyaan > 0 &&
                $sudahDiperiksa >= $totalPertanyaan,
        ];

        // ==========================================================
        // 15. Kirim ke Dashboard Fakultas
        // ==========================================================
        return view(
            'pages.dashboard-fakultas.dashboard-fakultas',
            [

                'title' =>
                    'Dashboard Fakultas | SIMANTAP',

                'totalPertanyaan' =>
                    $totalPertanyaan,

                'sudahDiisi' =>
                    $sudahDiperiksa,

                'belumDiisi' =>
                    $belumDiperiksa,

                'progressPersen' =>
                    $progressPersen,

                'ncrMayor' =>
                    $ncrMayor,

                'ncrMinor' =>
                    $ncrMinor,

                'observasi' =>
                    $observasi,

                'terpenuhi' =>
                    $terpenuhi,

                'tahunAkademikText' =>
                    $tahunAkademikText,

                'statusAudit' =>
                    $statusAudit,

                'deadline' =>
                    $deadline,

                'timeline' =>
                    $timeline,

                'auditeeUsers' =>
                    $auditeeUsers,

                // ==========================
                // DATA GRAFIK
                // ==========================

                'chartLabels' =>
                    $chartLabels,

                'chartDataAuditor' =>
                    $chartDataAuditor,

                'chartDataAuditee' =>
                    $chartDataAuditee,

                'chartSeries' =>
                    $chartSeries,
                
            ]
        );
    }

    public function getAuditeeNotifications()
    {
        $user = auth()->user();
        $notifications = [];
        
        // ========================================
        // 1. Data Akreditasi (query ringan)
        // ========================================
        $akreditasis = \DB::table('akreditasis')
            ->select('sub_unit', 'status_akreditasi', 'tanggal_kadaluarsa')
            ->whereNotNull('tanggal_kadaluarsa')
            ->orderBy('tanggal_kadaluarsa', 'asc')
            ->limit(3)
            ->get();
        
        $bgClasses = [
            'danger' => 'bg-red-50 border-l-4 border-red-500 dark:bg-red-900/20 dark:border-red-600',
            'warning' => 'bg-yellow-50 border-l-4 border-yellow-500 dark:bg-yellow-900/20 dark:border-yellow-600',
            'success' => 'bg-green-50 border-l-4 border-green-500 dark:bg-green-900/20 dark:border-green-600',
            'info' => 'bg-blue-50 border-l-4 border-blue-400 dark:bg-blue-900/20 dark:border-blue-600'
        ];
        
        foreach($akreditasis as $akreditasi) {
            $daysLeft = now()->diffInDays(\Carbon\Carbon::parse($akreditasi->tanggal_kadaluarsa), false);
            
            if($daysLeft <= 30 && $daysLeft > 0) {
                $notifications[] = [
                    'message' => "{$akreditasi->sub_unit} akan kadaluarsa dalam {$daysLeft} hari!",
                    'icon' => '<svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                    'bg_class' => $bgClasses['danger'],
                    'time' => $daysLeft . ' hari lagi'
                ];
            } elseif($daysLeft <= 0) {
                $notifications[] = [
                    'message' => "{$akreditasi->sub_unit} telah KADALUARSA!",
                    'icon' => '<svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'bg_class' => $bgClasses['danger'],
                    'time' => 'Kadaluarsa'
                ];
            } elseif(in_array($akreditasi->status_akreditasi, ['Unggul', 'Baik Sekali'])) {
                $notifications[] = [
                    'message' => "{$akreditasi->sub_unit} berstatus {$akreditasi->status_akreditasi}",
                    'icon' => '<svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'bg_class' => $bgClasses['success'],
                    'time' => 'Aktif'
                ];
            }
        }
        
        // ========================================
        // 2. Progress Audit (query ringan)
        // ========================================
        $totalAudit = \DB::table('audit_periksa')
            ->whereIn('pertanyaan_ami_prodi_id', function($q) use ($user) {
                $q->select('id')->from('pertanyaan_ami_prodi')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')->from('akses_pertanyaan_prodi')
                            ->whereColumn('akses_pertanyaan_prodi.pertanyaan_id', 'pertanyaan_ami_prodi.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->orWhereIn('pertanyaan_ami_unit_id', function($q) use ($user) {
                $q->select('id')->from('pertanyaan_ami_unit')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')->from('akses_pertanyaan_unit')
                            ->whereColumn('akses_pertanyaan_unit.pertanyaan_id', 'pertanyaan_ami_unit.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->count();
        
        $selesai = \DB::table('audit_periksa')
            ->whereIn('pertanyaan_ami_prodi_id', function($q) use ($user) {
                $q->select('id')->from('pertanyaan_ami_prodi')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')->from('akses_pertanyaan_prodi')
                            ->whereColumn('akses_pertanyaan_prodi.pertanyaan_id', 'pertanyaan_ami_prodi.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->orWhereIn('pertanyaan_ami_unit_id', function($q) use ($user) {
                $q->select('id')->from('pertanyaan_ami_unit')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')->from('akses_pertanyaan_unit')
                            ->whereColumn('akses_pertanyaan_unit.pertanyaan_id', 'pertanyaan_ami_unit.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->whereNotNull('setting_score_id')
            ->count();
        
        $progressPersen = $totalAudit > 0 ? round(($selesai / $totalAudit) * 100) : 0;
        
        if($totalAudit > 0) {
            if($progressPersen < 100) {
                $notifications[] = [
                    'message' => "Progress audit: {$progressPersen}% selesai",
                    'icon' => '<svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
                    'bg_class' => $bgClasses['warning'],
                    'time' => 'Sedang berjalan'
                ];
            } else {
                $notifications[] = [
                    'message' => "Semua audit selesai 100%!",
                    'icon' => '<svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'bg_class' => $bgClasses['success'],
                    'time' => 'Selesai'
                ];
            }
        }
        
        // ========================================
        // 3. NCR (query ringan)
        // ========================================
        $auditIds = \DB::table('audit_periksa')
            ->whereIn('pertanyaan_ami_prodi_id', function($q) use ($user) {
                $q->select('id')->from('pertanyaan_ami_prodi')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')->from('akses_pertanyaan_prodi')
                            ->whereColumn('akses_pertanyaan_prodi.pertanyaan_id', 'pertanyaan_ami_prodi.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->orWhereIn('pertanyaan_ami_unit_id', function($q) use ($user) {
                $q->select('id')->from('pertanyaan_ami_unit')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')->from('akses_pertanyaan_unit')
                            ->whereColumn('akses_pertanyaan_unit.pertanyaan_id', 'pertanyaan_ami_unit.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->pluck('id');
        
        if($auditIds->isNotEmpty()) {
            $ncrMayor = \DB::table('audit_ptk')
                ->whereIn('audit_periksa_id', $auditIds)
                ->where('kategori_temuan', 'Mayor')
                ->count();
            
            $ncrMinor = \DB::table('audit_ptk')
                ->whereIn('audit_periksa_id', $auditIds)
                ->where('kategori_temuan', 'Minor')
                ->count();
            
            if($ncrMayor > 0) {
                $notifications[] = [
                    'message' => "{$ncrMayor} NCR Mayor perlu segera ditindaklanjuti!",
                    'icon' => '<svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                    'bg_class' => $bgClasses['danger'],
                    'time' => 'Urgent'
                ];
            }
            
            if($ncrMinor > 0) {
                $notifications[] = [
                    'message' => "{$ncrMinor} NCR Minor perlu perbaikan",
                    'icon' => '<svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                    'bg_class' => $bgClasses['warning'],
                    'time' => 'Perlu perhatian'
                ];
            }
        }
        
        // Prioritaskan notifikasi danger > warning > success
        usort($notifications, function($a, $b) {
            $priority = ['danger' => 1, 'warning' => 2, 'success' => 3, 'info' => 4];
            $aPriority = 5;
            $bPriority = 5;
            
            foreach($priority as $key => $value) {
                if(strpos($a['bg_class'], $key) !== false) $aPriority = $value;
                if(strpos($b['bg_class'], $key) !== false) $bPriority = $value;
            }
            
            return $aPriority - $bPriority;
        });
        
        return response()->json(['notifications' => array_slice($notifications, 0, 5)]);
    }

    // ==================== METHOD HELPER (PRIVATE) ====================
    private function getTahunAkademikAktif()
    {
        return TahunAkademik::where('status', 'aktif')->first()
            ?? TahunAkademik::latest()->first();
    }

    private function getPertanyaanAuditee($user, $tahunAkademik)
    {
        $pertanyaanProdi = PertanyaanAmiProdi::forAuditor($user)
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->with('isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        $pertanyaanUnit = PertanyaanAmiUnit::forAuditor($user)
            ->where('tahun_akademik_id', $tahunAkademik->id)
            ->with('isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        return [
            'prodiCollection' => $pertanyaanProdi,
            'unitCollection'  => $pertanyaanUnit,
            'prodi' => $pertanyaanProdi->pluck('id'),
            'unit'  => $pertanyaanUnit->pluck('id'),
        ];
    }

    private function parseScore($item)
    {
        $raw = $item->score?->nilai_score;

        if ($raw === null || $raw === '') {
            return 0;
        }

        // handle koma desimal ala Indonesia, misal "5,96" -> "5.96"
        $normalized = str_replace(',', '.', (string) $raw);

        return is_numeric($normalized) ? (float) $normalized : 0;
    }

    private function getAuditeeNotificationsData($user, $tahunAkademik)
    {
        $notifications = [];
        
        // ========================================
        // 1. Ambil data akreditasi dengan query ringan
        // ========================================
        $akreditasis = \DB::table('akreditasis')
            ->select('sub_unit', 'status_akreditasi', 'tanggal_kadaluarsa')
            ->whereNotNull('tanggal_kadaluarsa')
            ->orderBy('tanggal_kadaluarsa', 'asc')
            ->limit(5)
            ->get();
        
        $bgClasses = [
            'info' => 'bg-blue-50 border-l-4 border-blue-400 dark:bg-blue-900/20 dark:border-blue-600',
            'danger' => 'bg-red-50 border-l-4 border-red-500 dark:bg-red-900/20 dark:border-red-600',
            'warning' => 'bg-yellow-50 border-l-4 border-yellow-500 dark:bg-yellow-900/20 dark:border-yellow-600',
            'success' => 'bg-green-50 border-l-4 border-green-500 dark:bg-green-900/20 dark:border-green-600'
        ];
        
        foreach($akreditasis as $akreditasi) {
            $today = now();
            $kadaluarsa = \Carbon\Carbon::parse($akreditasi->tanggal_kadaluarsa);
            $daysLeft = $today->diffInDays($kadaluarsa, false);
            
            if($daysLeft <= 30 && $daysLeft > 0) {
                $notifications[] = [
                    'message' => "Akreditasi {$akreditasi->sub_unit} akan kadaluarsa dalam {$daysLeft} hari!",
                    'icon' => '<svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                    'bg_class' => $bgClasses['danger'],
                    'time' => $daysLeft . ' hari lagi'
                ];
            } elseif($daysLeft <= 0) {
                $notifications[] = [
                    'message' => "Akreditasi {$akreditasi->sub_unit} telah KADALUARSA!",
                    'icon' => '<svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'bg_class' => $bgClasses['danger'],
                    'time' => 'Kadaluarsa'
                ];
            } elseif(in_array($akreditasi->status_akreditasi, ['Unggul', 'Baik Sekali'])) {
                $notifications[] = [
                    'message' => "{$akreditasi->sub_unit} berstatus {$akreditasi->status_akreditasi}",
                    'icon' => '<svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'bg_class' => $bgClasses['success'],
                    'time' => 'Aktif'
                ];
            }
        }
        
        // ========================================
        // 2. Ambil progress audit (query ringan)
        // ========================================
        $totalAudit = \DB::table('audit_periksa')
            ->whereIn('pertanyaan_ami_prodi_id', function($q) use ($user) {
                $q->select('id')
                    ->from('pertanyaan_ami_prodi')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')
                            ->from('akses_pertanyaan_prodi')
                            ->whereColumn('akses_pertanyaan_prodi.pertanyaan_id', 'pertanyaan_ami_prodi.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->orWhereIn('pertanyaan_ami_unit_id', function($q) use ($user) {
                $q->select('id')
                    ->from('pertanyaan_ami_unit')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')
                            ->from('akses_pertanyaan_unit')
                            ->whereColumn('akses_pertanyaan_unit.pertanyaan_id', 'pertanyaan_ami_unit.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->count();
        
        $selesai = \DB::table('audit_periksa')
            ->whereIn('pertanyaan_ami_prodi_id', function($q) use ($user) {
                $q->select('id')
                    ->from('pertanyaan_ami_prodi')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')
                            ->from('akses_pertanyaan_prodi')
                            ->whereColumn('akses_pertanyaan_prodi.pertanyaan_id', 'pertanyaan_ami_prodi.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->orWhereIn('pertanyaan_ami_unit_id', function($q) use ($user) {
                $q->select('id')
                    ->from('pertanyaan_ami_unit')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')
                            ->from('akses_pertanyaan_unit')
                            ->whereColumn('akses_pertanyaan_unit.pertanyaan_id', 'pertanyaan_ami_unit.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->whereNotNull('setting_score_id')
            ->count();
        
        $progressPersen = $totalAudit > 0 ? round(($selesai / $totalAudit) * 100) : 0;
        
        if($totalAudit > 0) {
            if($progressPersen < 100) {
                $notifications[] = [
                    'message' => "Progress audit: {$progressPersen}% selesai",
                    'icon' => '<svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
                    'bg_class' => $bgClasses['warning'],
                    'time' => 'Sedang berjalan'
                ];
            } else {
                $notifications[] = [
                    'message' => "Semua audit telah selesai 100%!",
                    'icon' => '<svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'bg_class' => $bgClasses['success'],
                    'time' => 'Selesai'
                ];
            }
        }
        
        // ========================================
        // 3. Ambil NCR (query ringan)
        // ========================================
        $auditIds = \DB::table('audit_periksa')
            ->whereIn('pertanyaan_ami_prodi_id', function($q) use ($user) {
                $q->select('id')
                    ->from('pertanyaan_ami_prodi')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')
                            ->from('akses_pertanyaan_prodi')
                            ->whereColumn('akses_pertanyaan_prodi.pertanyaan_id', 'pertanyaan_ami_prodi.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->orWhereIn('pertanyaan_ami_unit_id', function($q) use ($user) {
                $q->select('id')
                    ->from('pertanyaan_ami_unit')
                    ->whereExists(function($sub) use ($user) {
                        $sub->select('*')
                            ->from('akses_pertanyaan_unit')
                            ->whereColumn('akses_pertanyaan_unit.pertanyaan_id', 'pertanyaan_ami_unit.id')
                            ->where('unit', $user->unit)
                            ->where('sub_unit', $user->sub_unit);
                    });
            })
            ->pluck('id');
        
        if($auditIds->isNotEmpty()) {
            $ncrMayor = \DB::table('audit_ptk')
                ->whereIn('audit_periksa_id', $auditIds)
                ->where('kategori_temuan', 'Mayor')
                ->count();
            
            $ncrMinor = \DB::table('audit_ptk')
                ->whereIn('audit_periksa_id', $auditIds)
                ->where('kategori_temuan', 'Minor')
                ->count();
            
            if($ncrMayor > 0) {
                $notifications[] = [
                    'message' => "{$ncrMayor} temuan NCR Mayor perlu segera ditindaklanjuti!",
                    'icon' => '<svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                    'bg_class' => $bgClasses['danger'],
                    'time' => 'Urgent'
                ];
            }
            
            if($ncrMinor > 0) {
                $notifications[] = [
                    'message' => "{$ncrMinor} temuan NCR Minor perlu perbaikan",
                    'icon' => '<svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                    'bg_class' => $bgClasses['warning'],
                    'time' => 'Perlu perhatian'
                ];
            }
        }
        
        return array_slice($notifications, 0, 5);
    }

}