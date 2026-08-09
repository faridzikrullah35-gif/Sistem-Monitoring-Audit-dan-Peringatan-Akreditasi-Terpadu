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

        // 1. Ambil tahun akademik aktif
        $tahunAkademikAktif = $this->getTahunAkademikAktif();

        $pertanyaan = $this->getPertanyaanAuditee(
            $user,
            $tahunAkademikAktif
        );

        $pertanyaanProdi = $pertanyaan['prodiCollection'];
        $pertanyaanUnit  = $pertanyaan['unitCollection'];

        $pertanyaanProdiIds = $pertanyaan['prodi'];
        $pertanyaanUnitIds  = $pertanyaan['unit'];

        // ==========================================================
        // Ambil seluruh pertanyaan yang dapat diakses user
        // (PRODI + UNIT)
        // ==========================================================

        $pertanyaanProdiIds = PertanyaanAmiProdi::where('tahun_akademik_id', $tahunAkademikAktif->id)
        ->whereHas('akses', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })
        ->pluck('id');

        $pertanyaanUnitIds = PertanyaanAmiUnit::where('tahun_akademik_id', $tahunAkademikAktif->id)
        ->whereHas('akses', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })
        ->pluck('id');

        // 3. Total pertanyaan yang memiliki pertanyaan untuk tahun ini dan diizinkan
        $totalPertanyaan = AuditPeriksa::where(function ($q) use ($user) {

            $q->whereHas('pertanyaanAmiProdi.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });

            $q->orWhereHas('pertanyaanAmiUnit.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });

        })
        ->count();

        // 4. Total daftar periksa audit untuk auditee ini
        $totalPeriksa = AuditPeriksa::where(function ($q) use ($user) {

            $q->whereHas('pertanyaanAmiProdi.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });

            $q->orWhereHas('pertanyaanAmiUnit.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });

        })
        ->count();


        // Daftar periksa yang sudah dinilai auditor
        $sudahDiperiksa = AuditPeriksa::where(function ($q) use ($user) {

            $q->whereHas('pertanyaanAmiProdi.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });

            $q->orWhereHas('pertanyaanAmiUnit.akses', function ($sub) use ($user) {
                $sub->where('unit', $user->unit)
                    ->where('sub_unit', $user->sub_unit);
            });

        })
        ->whereNotNull('setting_score_id')
        ->count();


        $belumDiperiksa = max(0, $totalPertanyaan - $sudahDiperiksa);

        $progressPersen = $totalPertanyaan > 0
            ? round(($sudahDiperiksa / $totalPertanyaan) * 100)
            : 0;

        // 5. Ringkasan temuan (AuditPeriksa yang terkait dengan pertanyaan prodi)
        $auditPeriksaIds = AuditPeriksa::where(function ($q) use (
            $pertanyaanProdiIds,
            $pertanyaanUnitIds
        ) {

            $q->whereIn(
                'pertanyaan_ami_prodi_id',
                $pertanyaanProdiIds
            );

            $q->orWhereIn(
                'pertanyaan_ami_unit_id',
                $pertanyaanUnitIds
            );

        })
        ->whereHas('pertanyaanAmiProdi', function ($q) use ($tahunAkademikAktif) {
            $q->where('tahun_akademik_id', $tahunAkademikAktif->id);
        })
        ->pluck('id');

        $ncrMayor = AuditPtk::whereIn('audit_periksa_id', $auditPeriksaIds)
            ->where('kategori_temuan', 'Mayor')->count();
        $ncrMinor = AuditPtk::whereIn('audit_periksa_id', $auditPeriksaIds)
            ->where('kategori_temuan', 'Minor')->count();
        $observasi = FormObservasi::whereIn('audit_periksa_id', $auditPeriksaIds)->count();
        
        $terpenuhi = FormTerpenuhi::whereIn('audit_periksa_id', $auditPeriksaIds)->count();

        // ==========================================================
        // 6. Grafik Nilai AMI per Standar (Auditor vs Unit Kerja vs Auditee)
        // ==========================================================

        // Ambil seluruh standar yang digunakan oleh Pertanyaan AMI Prodi & Unit
        $standars = collect()

            // Pertanyaan AMI Prodi
            ->merge(
                PertanyaanAmiProdi::where('tahun_akademik_id', $tahunAkademikAktif->id)
                    ->whereHas('akses', function ($q) use ($user) {
                        $q->where('unit', $user->unit)
                        ->where('sub_unit', $user->sub_unit);
                    })
                    ->with('isiIndikator.matrix.kriteriaAudit.standar')
                    ->get()
                    ->pluck('isiIndikator.matrix.kriteriaAudit.standar')
            )

            // Pertanyaan AMI Unit
            ->merge(
                PertanyaanAmiUnit::where('tahun_akademik_id', $tahunAkademikAktif->id)
                    ->whereHas('akses', function ($q) use ($user) {
                        $q->where('unit', $user->unit)
                        ->where('sub_unit', $user->sub_unit);
                    })
                    ->with('isiIndikator.matrix.kriteriaAudit.standar')
                    ->get()
                    ->pluck('isiIndikator.matrix.kriteriaAudit.standar')
            )

            ->filter()              // hilangkan null
            ->unique('id')          // jangan ada standar yang dobel
            ->sortBy('id')          // urut berdasarkan id
            ->values();             // reset index

        // ---- Auditor (AuditPeriksa via pertanyaan_ami_prodi_id) ----
        $dataAuditorRaw = AuditPeriksa::whereNotNull('setting_score_id')
            ->whereIn('pertanyaan_ami_prodi_id', $pertanyaanProdiIds)
            ->with([
                'score',
                'pertanyaanAmiProdi.isiIndikator.matrix.kriteriaAudit.standar'
            ])
            ->get()
            ->groupBy(function ($item) {
                return optional(
                    $item->pertanyaanAmiProdi?->isiIndikator?->matrix?->kriteriaAudit
                )->standar_id;
            });

        // ---- Unit Kerja (AuditPeriksa via pertanyaan_ami_unit_id) ----
        $dataUnitKerjaRaw = AuditPeriksa::whereNotNull('setting_score_id')
            ->whereIn('pertanyaan_ami_unit_id', $pertanyaanUnitIds)
            ->with([
                'score',
                'pertanyaanAmiUnit.isiIndikator.matrix.kriteriaAudit.standar'
            ])
            ->get()
            ->groupBy(function ($item) {
                return optional(
                    $item->pertanyaanAmiUnit?->isiIndikator?->matrix?->kriteriaAudit
                )->standar_id;
            });

        // Seluruh isi indikator yang digunakan Pertanyaan AMI aktif
        $isiIndikatorIds = collect()

            ->merge(
                PertanyaanAmiProdi::whereIn('id', $pertanyaanProdiIds)
                    ->pluck('isi_indikator_id')
            )

            ->merge(
                PertanyaanAmiUnit::whereIn('id', $pertanyaanUnitIds)
                    ->pluck('isi_indikator_id')
            )

            ->unique()
            ->values();

        // ---- Auditee (self-assessment via PenilaianKinerja) ----
        $dataAuditeeRaw = PenilaianKinerja::whereNotNull('setting_score_id')
            ->where('users_id', $user->id)
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

        // ---- Susun per standar ----
        $chartLabels       = [];
        $chartDataAuditor   = [];
        $chartDataUnitKerja = [];
        $chartDataAuditee   = [];

        foreach ($standars as $standar) {

            $chartLabels[] = $standar->nama;

            $auditorItems = $dataAuditorRaw->get($standar->id, collect());
            $unitItems    = $dataUnitKerjaRaw->get($standar->id, collect());
            $auditeeItems = $dataAuditeeRaw->get($standar->id, collect());

            $chartDataAuditor[] = $auditorItems->count()
                ? round($auditorItems->avg(fn ($i) => $this->parseScore($i)), 2)
                : 0;

            $chartDataUnitKerja[] = $unitItems->count()
                ? round($unitItems->avg(fn ($i) => $this->parseScore($i)), 2)
                : 0;

            $chartDataAuditee[] = $auditeeItems->count()
                ? round($auditeeItems->avg(fn ($i) => $this->parseScore($i)), 2)
                : 0;
        }
        
        // Tentukan apakah user adalah Unit Kerja atau Prodi
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

        // 7. Status cards
        $tahunAkademikText = $tahunAkademikAktif->tahun_akademik . ' - ' . $tahunAkademikAktif->semester;

        // Status audit (sederhana)
        if ($auditPeriksaIds->isEmpty()) {
            $statusAudit = 'Belum Dimulai';
        } else {
            // Cek apakah sudah ada PTK? jika ada, anggap sedang berjalan
            $statusAudit = 'Sedang Berjalan';
            // Bisa ditambahkan logika lebih lanjut
        }

        // Deadline (contoh: ambil dari setting_akses_auditor atau hardcode)
        $deadline = '30 Mei 2026'; // bisa disesuaikan

        // 8. Timeline (berdasarkan data)
        $timeline = [
            'pembukaan' => true,
            'isi_evaluasi' => $sudahDiperiksa > 0,
            'pemeriksaan_auditor' => $auditPeriksaIds->count() > 0,
            'tindak_lanjut' => ($ncrMayor + $ncrMinor) > 0,
            'penutupan' => false, // misal jika semua PTK selesai
        ];

        // Kirim semua data ke view
        return view('pages.dashboard-auditee.dashboard-auditee', [
            'title'             => 'Dashboard Prodi | SIMANTAP',
            'totalPertanyaan'   => $totalPertanyaan,
            'sudahDiisi'        => $sudahDiperiksa,
            'belumDiisi'        => $belumDiperiksa,
            'progressPersen'    => $progressPersen,
            'ncrMayor'          => $ncrMayor,
            'ncrMinor'          => $ncrMinor,
            'observasi'         => $observasi,
            'terpenuhi'         => $terpenuhi,
            'chartLabels'       => $chartLabels,
            'chartDataAuditor'   => $chartDataAuditor,
            'chartDataUnitKerja' => $chartDataUnitKerja,
            'chartDataAuditee'   => $chartDataAuditee,
            'tahunAkademikText' => $tahunAkademikText,
            'statusAudit'       => $statusAudit,
            'deadline'          => $deadline,
            'timeline'          => $timeline,
            'chartSeries'       => $chartSeries,
        ]);
    }

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
    
}
