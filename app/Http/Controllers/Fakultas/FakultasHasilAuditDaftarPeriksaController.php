<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\HasilAuditDaftarPeriksaController as BaseController;
use Illuminate\Http\Request;
use App\Models\AuditPeriksa;
use App\Models\User;
use App\Models\TahunAkademik;
use App\Models\SettingHakAksesFakultas;
use Illuminate\Support\Facades\Auth;

class FakultasHasilAuditDaftarPeriksaController extends BaseController
{
    /**
     * Query builder dengan filter user (tidak panggil parent)
     */
    private function getAuditQuery(Request $request)
    {
        $user = Auth::user();

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
            ->when($user->unit, function ($query) use ($user) {
                $query->whereHas('user', function ($q) use ($user) {
                    $q->where('unit', $user->unit);
                });
            })
            // Filter subunit - jika 'all' maka tampilkan semua (termasuk data admin)
            ->when($request->subunit && $request->subunit != 'all', function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('sub_unit', $request->subunit);
                });
            })
            // Jika subunit = 'all', tidak difilter (tampilkan semua data termasuk admin)
            ->when($request->unit && $request->unit != $user->unit, function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('unit', $request->unit);
                });
            })
            ->orderBy('id', 'asc');
    }

    /**
     * Transformasi data (copy dari parent, ubah ke public agar bisa diakses)
     */
    public function transformData($data)
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

    /**
     * Helper untuk mengecek apakah semua filter lengkap (tahun, unit, subunit)
     */
    private function isAllFiltersComplete(Request $request)
    {
        return $request->filled('tahun_akademik_id') && 
               $request->filled('unit') && 
               $request->filled('subunit');
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
            $data = $this->getAuditQuery($request)
                ->paginate(10)
                ->withQueryString();
            $data = $this->transformData($data);
        } else {
            $paginatedData = $this->getEmptyPaginator($request);
            $data = $this->transformData($paginatedData);
        }

        // Ambil tahun akademik
        $tahunAkademiks = TahunAkademik::whereIn('id', function ($q) {
            $q->select('tahun_akademik_id')
                ->from('pertanyaan_ami_prodi')
                ->whereIn('id', function ($q2) {
                    $q2->select('pertanyaan_ami_prodi_id')
                        ->from('audit_periksa')
                        ->whereNotNull('pertanyaan_ami_prodi_id');
                })
                ->union(
                    \App\Models\PertanyaanAmiUnit::select('tahun_akademik_id')
                        ->whereIn('id', function ($q2) {
                            $q2->select('pertanyaan_ami_unit_id')
                                ->from('audit_periksa')
                                ->whereNotNull('pertanyaan_ami_unit_id');
                        })
                );
        })
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        $user = Auth::user();
        $fakultasUser = $user->fakultas ?? $user->unit;

        // Ambil data unit (fakultas) yang aktif
        $units = SettingHakAksesFakultas::where('is_active', true)
            ->when($fakultasUser, function ($query) use ($fakultasUser) {
                $query->where('fakultas', $fakultasUser);
            })
            ->distinct()
            ->pluck('fakultas')
            ->toArray();

        // Ambil semua subunit dari setting_hak_akses_fakultas
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

        return view('pages.fakultas.fakultas-hasil-audit.daftar-periksa', compact(
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
            $data = $this->getAuditQuery($request)
                ->paginate(10);
            $data = $this->transformData($data);
        } else {
            $paginatedData = $this->getEmptyPaginator($request);
            $data = $this->transformData($paginatedData);
        }

        return view('components.fakultas-hasil-audit.daftar-periksa.table', compact(
            'data', 
            'hasFilter',
            'filterStatus'
        ))->render();
    }

    public function print(Request $request)
    {
        return parent::print($request);
    }
}