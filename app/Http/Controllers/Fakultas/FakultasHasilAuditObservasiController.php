<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormObservasi;
use App\Models\User;
use App\Models\TahunAkademik;
use App\Models\SettingHakAksesFakultas;
use Illuminate\Support\Facades\Auth;

class FakultasHasilAuditObservasiController extends Controller
{
    private function getObservasiQuery(Request $request)
    {
        $user = Auth::user();

        return FormObservasi::with([
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
            // Filter berdasarkan user (hanya jika tidak ada filter unit dari request)
            ->when(!$request->unit && $user->unit, function ($query) use ($user) {
                $query->whereHas('user', function ($q) use ($user) {
                    $q->where('unit', $user->unit);
                });
            })
            // Filter unit dari request (override filter user)
            ->when($request->unit, function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('unit', $request->unit);
                });
            })
            // Filter subunit dari request - jika 'all' maka tidak difilter (tampilkan semua)
            ->when($request->subunit && $request->subunit != 'all', function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('sub_unit', $request->subunit);
                });
            })
            ->orderBy('created_at', 'asc');
    }

    private function transformData($data)
    {
        $data->getCollection()->transform(function ($item) {
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
     * Helper untuk mengecek apakah semua filter lengkap (tahun, unit, subunit)
     */
    private function isAllFiltersComplete(Request $request)
    {
        $tahunSelected = $request->filled('tahun_akademik_id');
        $unitSelected = $request->filled('unit');
        $subunitSelected = $request->filled('subunit');
        
        // Subunit dianggap valid jika ada value (termasuk 'all')
        return $tahunSelected && $unitSelected && $subunitSelected;
    }

    /**
     * Helper untuk mengecek status filter dan mendapatkan pesan yang sesuai
     */
    private function getFilterStatus(Request $request)
    {
        $tahunSelected = $request->filled('tahun_akademik_id');
        $unitSelected = $request->filled('unit');
        $subunitSelected = $request->filled('subunit');
        
        // Subunit dianggap valid jika ada value (termasuk 'all')
        $subunitValid = $request->filled('subunit');
        
        if (!$tahunSelected && !$unitSelected && !$subunitSelected) {
            return [
                'hasFilter' => false,
                'isComplete' => false,
                'message' => 'Pilih filter terlebih dahulu',
                'subMessage' => 'Pilih Tahun Akademik, Unit, dan Subunit untuk menampilkan data'
            ];
        } elseif ($tahunSelected && !$unitSelected && !$subunitSelected) {
            return [
                'hasFilter' => true,
                'isComplete' => false,
                'message' => 'Pilih Unit terlebih dahulu',
                'subMessage' => 'Silakan pilih Unit untuk melanjutkan'
            ];
        } elseif ($tahunSelected && $unitSelected && !$subunitSelected) {
            return [
                'hasFilter' => true,
                'isComplete' => false,
                'message' => 'Pilih Subunit terlebih dahulu',
                'subMessage' => 'Silakan pilih Subunit untuk menampilkan data'
            ];
        } elseif ($tahunSelected && $unitSelected && $subunitValid) {
            // Subunit dianggap valid meskipun value = 'all'
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
                'message' => 'Lengkapi filter terlebih dahulu',
                'subMessage' => 'Pastikan Tahun Akademik, Unit, dan Subunit terpilih'
            ];
        }
    }

    /**
     * Helper untuk mendapatkan empty paginator
     */
    private function getEmptyPaginator(Request $request)
    {
        return new \Illuminate\Pagination\LengthAwarePaginator(
            [],
            0,
            10,
            1,
            ['path' => $request->url()]
        );
    }

    public function index(Request $request)
    {
        // Dapatkan status filter
        $filterStatus = $this->getFilterStatus($request);
        $hasFilter = $filterStatus['hasFilter'];
        $isComplete = $filterStatus['isComplete'];
        
        // Hanya ambil data jika semua filter lengkap
        if ($isComplete) {
            $data = $this->getObservasiQuery($request)
                ->paginate(10)
                ->withQueryString();
            $data = $this->transformData($data);
        } else {
            $paginatedData = $this->getEmptyPaginator($request);
            $data = $this->transformData($paginatedData);
        }

        // Ambil tahun akademik - FIX: gunakan tabel audit_observasi, bukan form_observasi
        $tahunAkademiks = TahunAkademik::whereIn('id', function ($q) {
            $q->select('tahun_akademik_id')
                ->from('pertanyaan_ami_prodi')
                ->whereIn('id', function ($q2) {
                    $q2->select('pertanyaan_ami_prodi_id')
                        ->from('audit_observasi')
                        ->whereNotNull('pertanyaan_ami_prodi_id');
                })
                ->union(
                    \App\Models\PertanyaanAmiUnit::select('tahun_akademik_id')
                        ->whereIn('id', function ($q2) {
                            $q2->select('pertanyaan_ami_unit_id')
                                ->from('audit_observasi')
                                ->whereNotNull('pertanyaan_ami_unit_id');
                        })
                );
        })
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        $user = Auth::user();
        $fakultasUser = $user->fakultas ?? $user->unit;

        // Ambil data unit dan subunit dari SettingHakAksesFakultas
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
                // Decode JSON jika sub_unit berupa JSON
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

        return view('pages.fakultas.fakultas-hasil-audit.observasi', compact(
            'data',
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
        // Dapatkan status filter
        $filterStatus = $this->getFilterStatus($request);
        $hasFilter = $filterStatus['hasFilter'];
        $isComplete = $filterStatus['isComplete'];
        
        // Hanya ambil data jika semua filter lengkap
        if ($isComplete) {
            $data = $this->getObservasiQuery($request)
                ->paginate(10);
            $data = $this->transformData($data);
        } else {
            $paginatedData = $this->getEmptyPaginator($request);
            $data = $this->transformData($paginatedData);
        }

        return view('components.fakultas-hasil-audit.observasi.table', compact(
            'data', 
            'hasFilter',
            'filterStatus'
        ))->render();
    }

    public function print(Request $request)
    {
        // Copy dari parent print (sama seperti Daftar Periksa, tapi model dan view berbeda)
        $data = $this->getObservasiQuery($request)->get();

        if ($data->isEmpty()) {
            return back()->with('error', 'Data Observasi tidak ditemukan.');
        }

        $items = $data->map(function ($item) {
            $pertanyaan = $item->pertanyaanAmiProdi ?? $item->pertanyaanAmiUnit;
            $indikator = optional($pertanyaan->isiIndikator)->indikator ?? '-';

            return (object) [
                'indikator'      => $indikator,
                'discussed_with' => $item->discussed_with ?? '-',
                'rekomendasi'    => $item->rekomendasi ?? '-',
            ];
        });

        $first = $data->first();
        $auditorUserId = $first->users_id;
        $auditorUser = User::find($auditorUserId);
        $settingHeader = \App\Models\SettingHeaderCetak::latest('id')->first();
        $noDokumen = $settingHeader?->no_dokumen ?? '-';
        $tanggalTerbit = $settingHeader?->tanggal_terbit
            ? \Carbon\Carbon::parse($settingHeader->tanggal_terbit)->format('d-m-Y')
            : '-';
        $noRevisi = $settingHeader?->no_revisi ?? '-';

        $tahunYangDigunakan = $request->tahun_akademik_id;
        if (!$tahunYangDigunakan && $data->isNotEmpty()) {
            $first = $data->first();
            $tahunYangDigunakan = optional($first->pertanyaanAmiProdi ?? $first->pertanyaanAmiUnit)->tahun_akademik_id;
        }
        $tahun = TahunAkademik::find($tahunYangDigunakan);

        $lokasi_audit = implode(' - ', array_filter([
            $auditorUser?->sub_unit,
            $auditorUser?->unit,
        ])) ?: '-';

        $auditees = \App\Models\Auditiee::where('users_id', $auditorUserId)->get();

        $setting = \App\Models\SettingAksesAuditor::where('user_id', $auditorUserId)->first();
        $auditors = collect();
        $tanggal_audit_print = null;

        if ($setting) {
            $tanggal_audit_print = $setting->tgl_audit
                ? \Carbon\Carbon::parse($setting->tgl_audit)->translatedFormat('d F Y')
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

        return view('admin.observasi.print', compact(
            'items',
            'tahun',
            'lokasi_audit',
            'auditees',
            'auditors',
            'tanggal_audit_print',
            'noDokumen',
            'tanggalTerbit',
            'noRevisi'
        ));
    }
}