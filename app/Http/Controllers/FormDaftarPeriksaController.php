<?php

namespace App\Http\Controllers;

use App\Models\AuditPeriksa;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use App\Models\Matrix;
use App\Models\IsiIndikator;
use App\Models\SettingScore;
use App\Models\FormObservasi;
use Illuminate\Http\Request;

class FormDaftarPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $role = $user->role;

        $pertanyaanAmiModel = match($role) {
            'unit_kerja' => \App\Models\PertanyaanAmiUnit::class,
            default      => \App\Models\PertanyaanAmiProdi::class,
        };

        $relasiPertanyaan = match($role) {
            'unit_kerja' => 'pertanyaanAmiUnit',
            default      => 'pertanyaanAmiProdi',
        };

        /*
        |--------------------------------------------------------------------------
        | DATA DROPDOWN
        |--------------------------------------------------------------------------
        */

        $tahunAkademik = TahunAkademik::whereIn(
            'id',
            $pertanyaanAmiModel::select('tahun_akademik_id')->distinct()
        )
        ->orderBy('tahun_akademik', 'desc')
        ->get();

        /*
        |--------------------------------------------------------------------------
        | PERTANYAAN AMI
        |--------------------------------------------------------------------------
        */

        $pertanyaanAmi = $pertanyaanAmiModel::with([
            'isiIndikator.matrix.kriteriaAudit.standar'
        ])->get();

        /*
        |--------------------------------------------------------------------------
        | TABLE UTAMA
        |--------------------------------------------------------------------------
        */

        $pertanyaan = AuditPeriksa::with([
            $relasiPertanyaan . '.indikator.matrix.kriteriaAudit.standar',
            'score',
        ])
        ->where('users_id', $user->id)
        ->paginate(10)
        ->appends(request()->query());

        /*
        |--------------------------------------------------------------------------
        | MATRIX & KRITERIA
        |--------------------------------------------------------------------------
        */

        $matrixs = $pertanyaanAmi
            ->pluck('isiIndikator.matrix')
            ->filter()
            ->unique('id')
            ->values()
            ->map(function ($matrix) {
                $matrix->load('isiIndikator');
                return $matrix;
            });

        $kriteriaList = $matrixs
            ->pluck('kriteriaAudit.standar')
            ->filter()
            ->unique('id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | SCORE
        |--------------------------------------------------------------------------
        */

        $settingScores = SettingScore::all();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('pages.form-daftar-periksa', [
            'title'         => 'Form Daftar Periksa | SIMANTAP',
            'tahunAkademik' => $tahunAkademik,
            'kriteriaList'  => $kriteriaList,
            'settingScores' => $settingScores,
            'pertanyaan'    => $pertanyaan,
            'pertanyaanAmi' => $pertanyaanAmi,
            'matrixs'       => $matrixs,
        ]);
    }

    private function getPertanyaanModel()
    {
        return auth()->user()->role === 'unit_kerja'
            ? \App\Models\PertanyaanAmiUnit::class
            : \App\Models\PertanyaanAmiProdi::class;
    }

    private function getPertanyaanRelation()
    {
        return auth()->user()->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_indikator_id'   => 'required|exists:isi_indikator,id',
            'uraian_temuan'      => 'required|string',
            'analisis_penyebab'  => 'required|string',
            'akibat'             => 'required|string',
            'setting_score_id'   => 'nullable|exists:setting_scores,id',
            'panduan_pengisian'  => 'nullable|string',
        ]);

        $user = auth()->user();

        $isUnit = $user->role === 'unit_kerja';

        /*
        |--------------------------------------------------------------------------
        | Ambil model pertanyaan sesuai role
        |--------------------------------------------------------------------------
        */

        $pertanyaanModel = $this->getPertanyaanModel();

        $pertanyaanAmi = $pertanyaanModel::where(
            'isi_indikator_id',
            $request->isi_indikator_id
        )->first();

        if (!$pertanyaanAmi) {

            return response()->json([
                'success' => false,
                'message' => 'Data pertanyaan AMI tidak ditemukan.'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan audit
        |--------------------------------------------------------------------------
        */

        $data = AuditPeriksa::create([

            'users_id' => $user->id,

            'pertanyaan_ami_prodi_id' =>
                $pertanyaanAmi instanceof PertanyaanAmiProdi
                    ? $pertanyaanAmi->id
                    : null,

            'pertanyaan_ami_unit_id' =>
                $pertanyaanAmi instanceof PertanyaanAmiUnit
                    ? $pertanyaanAmi->id
                    : null,

            'uraian_temuan'     => $request->uraian_temuan,

            'analisis_penyebab' => $request->analisis_penyebab,

            'akibat'            => $request->akibat,

            'setting_score_id'  => $request->setting_score_id,

            'panduan_pengisian' => $request->panduan_pengisian,
        ]);

        $data = $data->fresh([
            'score',
            'pertanyaanAmiProdi',
            'pertanyaanAmiUnit'
        ]);

        $this->handlePtk($data);

        $this->handleObservasi($data);

        return response()->json([
            'success' => true,
            'message' => 'Data audit berhasil disimpan',
            'data'    => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $relasiPertanyaan = auth()->user()->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';

        $data = AuditPeriksa::with([
            $relasiPertanyaan . '.isiIndikator.matrix.kriteriaAudit.standar',
            'score'
        ])
        ->where('users_id', auth()->id())
        ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'uraian_temuan'      => 'required|string',
            'analisis_penyebab'  => 'required|string',
            'akibat'             => 'required|string',
            'setting_score_id'   => 'nullable|exists:setting_scores,id',
            'panduan_pengisian'  => 'nullable|string',
        ]);

        $audit = AuditPeriksa::where(
            'users_id',
            auth()->id()
        )->findOrFail($id);

        $audit->update([

            'uraian_temuan'     => $request->uraian_temuan,

            'analisis_penyebab' => $request->analisis_penyebab,

            'akibat'            => $request->akibat,

            'setting_score_id'  => $request->setting_score_id,

            'panduan_pengisian' => $request->panduan_pengisian,
        ]);

        $audit = $audit->fresh();

        $this->handlePtk($audit);
        $this->handleObservasi($audit);

        return response()->json([
            'success' => true,
            'message' => 'Data audit berhasil diperbarui',
            'data'    => $audit
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $audit = AuditPeriksa::where('users_id', auth()->id())
            ->findOrFail($id);

        $audit->ptk()->delete();
        $audit->observasi()->delete();

        $audit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    private function handlePtk($audit)
    {
        $score = $audit->score;

        if (!$score || !$score->generate_ncr) {

            $audit->ptk()->delete();

            return;
        }

        $audit->ptk()->updateOrCreate(

            [
                'audit_periksa_id' => $audit->id
            ],

            [
                'users_id' => $audit->users_id,

                'pertanyaan_ami_prodi_id' =>
                    $audit->pertanyaan_ami_prodi_id,

                'pertanyaan_ami_unit_id' =>
                    $audit->pertanyaan_ami_unit_id,

                'no_ncr' => null,

                'klausul_dokumen' => null,

                'deskripsi_uraian_temuan' =>
                    $audit->uraian_temuan,

                'analisis_penyebab' =>
                    $audit->analisis_penyebab,

                'akibat' =>
                    $audit->akibat,

                'kategori_temuan' =>
                    $score->keterangan,

                'status_ncr' => 'Open',
            ]
        );
    }

    private function handleObservasi($audit)
    {
        $score = $audit->score;

        $nilai = (int) ($score->nilai_score ?? 0);

        if (!$score || !in_array($nilai, [3, 4])) {

            $audit->observasi()->delete();
            return;
        }

        $pertanyaan =
            $audit->pertanyaanAmiProdi
            ?? $audit->pertanyaanAmiUnit;

        $matrixId = optional(optional($pertanyaan)->isiIndikator)->matrixs_id;

        $audit->observasi()->updateOrCreate(
            [
                'audit_periksa_id' => $audit->id
            ],
            [
                'users_id' => $audit->users_id,

                'pertanyaan_ami_prodi_id' => $audit->pertanyaan_ami_prodi_id,
                'pertanyaan_ami_unit_id'  => $audit->pertanyaan_ami_unit_id,

                'matrixs_id' => $matrixId,
            ]
        );
    }

}