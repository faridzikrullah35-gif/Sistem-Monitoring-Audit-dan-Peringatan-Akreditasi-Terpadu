<?php

namespace App\Http\Controllers;

use App\Models\PenilaianKinerja;
use App\Models\IsiIndikator;
use App\Models\AuditPeriksa;
use App\Models\SettingScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenilaianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // ============================================================
        // 1. Ambil seluruh data audit berdasarkan UNIT & SUB UNIT
        // ============================================================
        $daftarPeriksa = AuditPeriksa::with([
            'pertanyaanAmiProdi.isiIndikator.matrix.kriteriaAudit.standar',
            'pertanyaanAmiUnit.isiIndikator.matrix.kriteriaAudit.standar',
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        // ============================================================
        // 2. Kumpulkan semua indikator dari audit & penilaian existing
        // ============================================================
        $indikators = collect();

        foreach ($daftarPeriksa as $audit) {
            if ($audit->pertanyaanAmiProdi?->isiIndikator) {
                $indikators->push($audit->pertanyaanAmiProdi->isiIndikator);
            }
            if ($audit->pertanyaanAmiUnit?->isiIndikator) {
                $indikators->push($audit->pertanyaanAmiUnit->isiIndikator);
            }
        }

        $existingPenilaian = PenilaianKinerja::with('isiIndikator.matrix.kriteriaAudit.standar')
            ->where('users_id', $user->id)
            ->get();

        foreach ($existingPenilaian as $p) {
            if ($p->isiIndikator) {
                $indikators->push($p->isiIndikator);
            }
        }

        $indikators = $indikators->unique('id')->values();

        // ============================================================
        // 3. Matrix (dengan relasi kriteriaAudit & standar)
        // ============================================================
        $matrixs = $indikators
            ->pluck('matrix')
            ->filter()
            ->unique('id')
            ->values()
            ->map(function ($matrix) {
                $matrix->load('isiIndikator', 'kriteriaAudit.standar');
                return $matrix;
            });

        // ============================================================
        // 4. Standar untuk dropdown filter
        // ============================================================
        $standarList = $matrixs
            ->pluck('kriteriaAudit.standar')
            ->filter()
            ->unique('id')
            ->values();

        // ============================================================
        // 5. Query Penilaian Kinerja dengan filter standar & sort
        // ============================================================
        $query = PenilaianKinerja::with([
                'isiIndikator.matrix.kriteriaAudit.standar',
                'score',
            ])
            ->where('users_id', $user->id);

        // Filter berdasarkan standar (jika ada)
        if ($request->filled('standar')) {
            $query->whereHas('isiIndikator.matrix.kriteriaAudit', function ($q) use ($request) {
                $q->where('standar_id', $request->standar);
            });
        }

        // Urutkan
        $sort = $request->input('sort', 'terbaru');
        if ($sort === 'terbaru') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'terlama') {
            $query->orderBy('created_at', 'asc');
        }

        $dataPenilaian = $query->paginate(10)->appends($request->query());

        // ============================================================
        // 6. Jika AJAX, kembalikan partial view tabel saja
        // ============================================================
        if ($request->ajax()) {
            return view('components.auditee-penilaian-kinerja.table', [
                'dataPenilaian' => $dataPenilaian
            ])->render();
        }

        // ============================================================
        // 7. Untuk request biasa, ambil setting scores dan return full view
        // ============================================================
        $settingScores = SettingScore::all();

        return view('pages.auditee-penilaian-kinerja', [
            'dataPenilaian' => $dataPenilaian,
            'matrixs'       => $matrixs,
            'kriteriaList'  => $matrixs->pluck('kriteriaAudit')->filter()->unique('id')->values(),
            'settingScores' => $settingScores,
            'standarList'   => $standarList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_indikator_id' => 'required|exists:isi_indikator,id',
            'deskripsi'        => 'required|string',
            'setting_score_id' => 'required|exists:setting_scores,id',
            'file'             => 'required|file|mimes:pdf|max:2048',
        ], [
            'file.required' => 'File PDF wajib diunggah.',
            'file.max'      => 'Ukuran file maksimal 2MB.',
            'file.mimes'    => 'File harus berformat PDF.',
        ]);

        $user = Auth::user();

        // ==========================================================
        // Perbaikan validasi indikator: cek apakah indikator tersebut
        // ada di hasil audit untuk unit/sub unit user (auditor),
        // bukan berdasarkan auditee_id (tidak ada).
        // ==========================================================
        $indikatorValid = AuditPeriksa::whereHas('user', function ($q) use ($user) {
                $q->where('unit', $user->unit)
                  ->where('sub_unit', $user->sub_unit);
            })
            ->where(function ($query) use ($request) {
                $query->whereHas('pertanyaanAmiProdi.isiIndikator', function ($q) use ($request) {
                    $q->where('isi_indikator.id', $request->isi_indikator_id);
                })
                ->orWhereHas('pertanyaanAmiUnit.isiIndikator', function ($q) use ($request) {
                    $q->where('isi_indikator.id', $request->isi_indikator_id);
                });
            })
            ->exists();
        
        if (!$indikatorValid) {
            return response()->json([
                'success' => false,
                'message' => 'Indikator tidak ditemukan pada hasil audit unit Anda.'
            ], 403);
        }

        // ==========================================================
        // Upload File
        // ==========================================================
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('penilaian_kinerja', $fileName, 'public');
        }

        // ==========================================================
        // Simpan
        // ==========================================================
        $penilaian = PenilaianKinerja::create([
            'users_id'         => $user->id,
            'isi_indikator_id' => $request->isi_indikator_id,
            'deskripsi'        => $request->deskripsi,
            'setting_score_id' => $request->setting_score_id,
            'file_path'        => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data penilaian berhasil disimpan.',
            'data' => $penilaian->load([
                'isiIndikator.matrix.kriteriaAudit.standar',
                'score',
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penilaian = PenilaianKinerja::with([
            'isiIndikator.matrix.kriteriaAudit.standar',
            'score',
        ])
        ->where('users_id', Auth::id())
        ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $penilaian,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi'        => 'required|string',
            'setting_score_id' => 'required|exists:setting_scores,id',
            'file'             => 'nullable|file|mimes:pdf|max:2048',
        ], [
            'file.max'   => 'Ukuran file maksimal 2MB.',
            'file.mimes' => 'File harus berformat PDF.',
        ]);

        $penilaian = PenilaianKinerja::where('users_id', Auth::id())
            ->findOrFail($id);

        $filePath = $penilaian->file_path;

        // ==========================================================
        // Upload file baru jika ada
        // ==========================================================
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('penilaian_kinerja', $fileName, 'public');
        }

        // ==========================================================
        // Update
        // ==========================================================
        $penilaian->update([
            'deskripsi'        => $request->deskripsi,
            'setting_score_id' => $request->setting_score_id,
            'file_path'        => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data penilaian berhasil diperbarui.',
            'data' => $penilaian->load([
                'isiIndikator.matrix.kriteriaAudit.standar',
                'score',
            ]),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penilaian = PenilaianKinerja::where('users_id', Auth::id())->findOrFail($id);

        // Hapus file jika ada
        if ($penilaian->file_path && Storage::disk('public')->exists($penilaian->file_path)) {
            Storage::disk('public')->delete($penilaian->file_path);
        }

        $penilaian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data penilaian berhasil dihapus.'
        ]);
    }
}