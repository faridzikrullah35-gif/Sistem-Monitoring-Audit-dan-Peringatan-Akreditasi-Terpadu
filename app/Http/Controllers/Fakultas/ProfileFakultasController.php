<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ProfilFakultas;
use App\Models\DokumenFakultas;
use App\Models\DokumenProdi;
use App\Models\ProfilProdi;
use App\Models\VmtsFakultas;
use App\Models\User;
use App\Services\Fakultas\DokumenFakultasService;
use App\Services\Fakultas\ProfilFakultasService;
use App\Http\Requests\Fakultas\StoreVmtsRequest;
use App\Http\Requests\Fakultas\UpdateVmtsRequest;
use App\Http\Requests\Fakultas\StoreDokumenRequest;
use App\Http\Requests\Fakultas\UpdateDokumenRequest;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class ProfileFakultasController extends Controller
{
    protected DokumenFakultasService $dokumenService;
    protected ProfilFakultasService $profilService;

    public function __construct(
        DokumenFakultasService $dokumenService,
        ProfilFakultasService $profilService
    ) {
        $this->dokumenService = $dokumenService;
        $this->profilService = $profilService;
    }

    /**
     * Ambil profil fakultas berdasarkan user login.
     */
    private function profil()
    {
        return ProfilFakultas::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Ambil daftar Prodi yang dapat diakses Fakultas.
     */
    private function daftarProdi()
    {
        $user = Auth::user();

        return User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();
    }

    /**
     * Helper: ambil dokumen prodi by kategori
     */
    private function getDokumenProdi($jenis, array $profilProdiIds)
    {
        return DokumenProdi::with('profilProdi.user')
            ->whereIn('profil_prodi_id', $profilProdiIds)
            ->where('jenis', $jenis)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Response sukses.
     */
    private function success($message, $data = null)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    /**
     * Response error validasi.
     */
    private function validationError($validator)
    {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    /**
     * Halaman utama
     */
    public function index()
    {
        $profil = $this->profil();
        $prodi  = $this->daftarProdi();

        // Ambil ID User prodi di bawah fakultas ini
        $prodiUserIds = $prodi->pluck('id')->toArray();

        // Ambil ID ProfilProdi terkait
        $profilProdiIds = ProfilProdi::whereIn('user_id', $prodiUserIds)
                            ->pluck('id')
                            ->toArray();

        $profilProdiData = ProfilProdi::with('user')
                            ->whereIn('id', $profilProdiIds)
                            ->get();

        return view('pages.fakultas.identitas-fakultas', [
            'profil' => $profil,
            'prodi'  => $prodi,

            // ================= DATA FAKULTAS =================
            'dokumenRipFakultas'     => $this->dokumenService->getByKategoriFakultas('RIP'),
            'dokumenRenstraFakultas' => $this->dokumenService->getByKategoriFakultas('RENSTRA'),
            'dokumenRenopFakultas'   => $this->dokumenService->getByKategoriFakultas('RENOP'),
            'dokumenMouFakultas'     => $this->dokumenService->getByKategoriFakultas('MOU'),

            // ================= DATA PRODI =================
            'dokumenRipProdi'     => $this->getDokumenProdi('RIP', $profilProdiIds),
            'dokumenRenstraProdi' => $this->getDokumenProdi('RENSTRA', $profilProdiIds),
            'dokumenRenopProdi'   => $this->getDokumenProdi('RENOP', $profilProdiIds),
            'dokumenMouProdi'     => $this->getDokumenProdi('MOU', $profilProdiIds),

            // ================= DTPS & JABATAN & MAHASISWA =================
            'dtpsFakultas'       => $profil,          // DTPS Fakultas (user login)
            'dtpsProdi'          => $profilProdiData, // DTPS Prodi (koleksi ProfilProdi)
            'jabatanFakultas'    => $profil,
            'jabatanProdi'       => $profilProdiData,
            'mahasiswaFakultas'  => $profil,
            'mahasiswaProdi'     => $profilProdiData,

            // ================= DTPS =================
            'dtpsFakultas' => $profil,
            'dtpsProdi'    => $profilProdiData,

            // ================= JABATAN / MAHASISWA / RASIO (LANGSUNG PRODI) =================
            'jabatanProdi'   => $profilProdiData,
            'mahasiswaProdi' => $profilProdiData,
            'rasioProdi'     => $profilProdiData,
            
        ]);
    }

    /**
     * ==========================================================
     * TAMBAH DATA DTPS
     * ==========================================================
     */
    public function storeDtps(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_magister' => 'required|integer|min:0',
            'jumlah_doktor'   => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $profil = $this->profil();

        $total = (int) $request->jumlah_magister + (int) $request->jumlah_doktor;

        $profil->jumlah_magister = $request->jumlah_magister;
        $profil->jumlah_doktor = $request->jumlah_doktor;
        $profil->jumlah_total = $total;
        $profil->save();

        return $this->success('Data DTPS berhasil ditambahkan.', $profil);
    }

    /**
     * UPDATE DATA DTPS
     */
    public function updateDtps(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_magister' => 'required|integer|min:0',
            'jumlah_doktor'   => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $profil = ProfilFakultas::findOrFail($id);

        $total = (int) $request->jumlah_magister + (int) $request->jumlah_doktor;

        $profil->update([
            'jumlah_magister' => $request->jumlah_magister,
            'jumlah_doktor'   => $request->jumlah_doktor,
            'jumlah_total'    => $total,
        ]);

        return $this->success('Data DTPS berhasil diperbarui.', $profil);
    }

    /**
     * HAPUS/RESET DATA DTPS
     */
    public function destroyDtps($id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        $profil->update([
            'jumlah_magister' => 0,
            'jumlah_doktor'   => 0,
            'jumlah_total'    => 0,
        ]);

        return $this->success('Data DTPS berhasil direset ke 0.');
    }

    /**
     * STORE JABATAN FUNGSIONAL
     */
    public function storeJabatan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_asisten_ahli' => 'required|integer|min:0',
            'jumlah_lektor' => 'required|integer|min:0',
            'jumlah_lektor_kepala' => 'required|integer|min:0',
            'jumlah_guru_besar' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $profil = $this->profil();

        $profil->update([
            'jumlah_asisten_ahli' => $request->jumlah_asisten_ahli,
            'jumlah_lektor' => $request->jumlah_lektor,
            'jumlah_lektor_kepala' => $request->jumlah_lektor_kepala,
            'jumlah_guru_besar' => $request->jumlah_guru_besar,
        ]);

        return $this->success('Data Jabatan Fungsional berhasil ditambahkan.', $profil);
    }

    /**
     * UPDATE JABATAN FUNGSIONAL
     */
    public function updateJabatan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_asisten_ahli' => 'required|integer|min:0',
            'jumlah_lektor' => 'required|integer|min:0',
            'jumlah_lektor_kepala' => 'required|integer|min:0',
            'jumlah_guru_besar' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $profil = ProfilFakultas::findOrFail($id);

        $profil->update([
            'jumlah_asisten_ahli' => $request->jumlah_asisten_ahli,
            'jumlah_lektor' => $request->jumlah_lektor,
            'jumlah_lektor_kepala' => $request->jumlah_lektor_kepala,
            'jumlah_guru_besar' => $request->jumlah_guru_besar,
        ]);

        return $this->success('Data Jabatan Fungsional berhasil diperbarui.', $profil);
    }

    /**
     * DELETE/RESET JABATAN FUNGSIONAL
     */
    public function destroyJabatan($id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        $profil->update([
            'jumlah_asisten_ahli' => 0,
            'jumlah_lektor' => 0,
            'jumlah_lektor_kepala' => 0,
            'jumlah_guru_besar' => 0,
        ]);

        return $this->success('Data Jabatan Fungsional berhasil direset ke 0.');
    }

    /**
     * ==========================================================
     * VMTS
     * ==========================================================
     */
    public function storeVmts(StoreVmtsRequest $request)
    {
        $profil = $this->profil();

        $data = [
            'visi'          => $request->visi,
            'misi'          => $request->misi,
            'tujuan'        => $request->tujuan,
            'sasaran'       => $request->sasaran,
            'tgl_penetapan' => $request->tgl_penetapan,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'profil-fakultas/vmts/' . $fileName;

            Storage::disk('public')->put($filePath, file_get_contents($file));
            $data['file'] = $filePath;
        }

        $profil->update($data);

        return $this->success('VMTS berhasil ditambahkan.', $profil->fresh());
    }

    public function showVmts($id)
    {
        $profil = ProfilFakultas::findOrFail($id);
        return $this->success('Data ditemukan.', [
            'visi'          => $profil->visi,
            'misi'          => $profil->misi,
            'tujuan'        => $profil->tujuan,
            'sasaran'       => $profil->sasaran,
            'file'          => $profil->file,
            'tgl_penetapan' => $profil->tgl_penetapan?->format('Y-m-d'),
        ]);
    }

    public function updateVmts(UpdateVmtsRequest $request, $id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        $data = [
            'visi'          => $request->visi,
            'misi'          => $request->misi,
            'tujuan'        => $request->tujuan,
            'sasaran'       => $request->sasaran,
            'tgl_penetapan' => $request->tgl_penetapan,
        ];

        if ($request->hasFile('file')) {
            if ($profil->file && Storage::disk('public')->exists($profil->file)) {
                Storage::disk('public')->delete($profil->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'profil-fakultas/vmts/' . $fileName;

            Storage::disk('public')->put($filePath, file_get_contents($file));
            $data['file'] = $filePath;
        }

        $profil->update($data);

        return $this->success('VMTS berhasil diperbarui.', $profil->fresh());
    }

    public function destroyVmts($id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        if ($profil->file && Storage::disk('public')->exists($profil->file)) {
            Storage::disk('public')->delete($profil->file);
        }

        $profil->update([
            'visi'          => null,
            'misi'          => null,
            'tujuan'        => null,
            'sasaran'       => null,
            'file'          => null,
            'tgl_penetapan' => null,
        ]);

        return $this->success('VMTS berhasil dihapus.');
    }

    /**
     * STORE MAHASISWA
     */
    public function storeMahasiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_mahasiswa' => 'required|integer|min:0',
            'tahun_akademik'   => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $profil = $this->profil();

        $profil->update([
            'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
            'tahun_akademik'   => $request->tahun_akademik,
        ]);

        return $this->success('Data Mahasiswa berhasil ditambahkan.', $profil);
    }

    /**
     * UPDATE MAHASISWA
     */
    public function updateMahasiswa(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_mahasiswa' => 'required|integer|min:0',
            'tahun_akademik'   => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $profil = ProfilFakultas::findOrFail($id);

        $profil->update([
            'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
            'tahun_akademik'   => $request->tahun_akademik,
        ]);

        return $this->success('Data Mahasiswa berhasil diperbarui.', $profil);
    }

    /**
     * HAPUS/RESET MAHASISWA
     */
    public function destroyMahasiswa($id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        $profil->update([
            'jumlah_mahasiswa' => 0,
            'tahun_akademik'   => null,
        ]);

        return $this->success('Data Mahasiswa berhasil direset ke 0.');
    }

    /**
     * STORE DOKUMEN (untuk fakultas sendiri)
     */
    public function storeDocument(StoreDokumenRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'dokumen/fakultas/' . $request->kategori . '/' . $fileName;

            Storage::disk('public')->put($filePath, file_get_contents($file));

            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }

        $dokumen = DokumenFakultas::create($data);

        return $this->success('Dokumen berhasil ditambahkan.', $dokumen);
    }

    /**
     * DETAIL DOKUMEN
     */
    public function showDocument($id)
    {
        $dokumen = DokumenFakultas::findOrFail($id);
        return $this->success('Data ditemukan.', $dokumen);
    }

    /**
     * UPDATE DOKUMEN
     */
    public function updateDocument(UpdateDokumenRequest $request, $id)
    {
        $dokumen = DokumenFakultas::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'dokumen/fakultas/' . ($request->kategori ?? $dokumen->kategori) . '/' . $fileName;

            Storage::disk('public')->put($filePath, file_get_contents($file));

            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }

        $dokumen->update($data);

        return $this->success('Dokumen berhasil diperbarui.', $dokumen);
    }

    /**
     * HAPUS DOKUMEN
     */
    public function destroyDocument($id)
    {
        $dokumen = DokumenFakultas::findOrFail($id);

        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return $this->success('Dokumen berhasil dihapus.');
    }

    /**
     * GET RASIO DOSEN : MAHASISWA
     */
    public function getRasio($id)
    {
        $profil = ProfilFakultas::findOrFail($id);

        $totalDosen = ($profil->jumlah_magister ?? 0) + ($profil->jumlah_doktor ?? 0);
        $jumlahMahasiswa = $profil->jumlah_mahasiswa ?? 0;
        $rasio = $totalDosen > 0 ? round($jumlahMahasiswa / $totalDosen, 2) : 0;

        return $this->success('Data rasio ditemukan.', [
            'total_dosen' => $totalDosen,
            'jumlah_magister' => $profil->jumlah_magister ?? 0,
            'jumlah_doktor' => $profil->jumlah_doktor ?? 0,
            'jumlah_mahasiswa' => $jumlahMahasiswa,
            'rasio' => $rasio,
        ]);
    }

    /**
     * ==========================================================
     * PRINT MoU (Fakultas + Prodi) — dengan filter
     * ==========================================================
     */
    public function printMou(Request $request)
    {
        $user   = Auth::user();
        if (!$user) abort(401, 'Anda harus login terlebih dahulu.');

        $prodi  = $this->daftarProdi();
        $profilProdiIds = ProfilProdi::whereIn('user_id', $prodi->pluck('id')->toArray())
            ->pluck('id')
            ->toArray();

        // filter_source: fakultas | all | prodi-{userId}
        $filterSource = $request->query('filter_source', 'fakultas');

        if ($filterSource === 'fakultas') {
            $dokumen = $this->dokumenService->getByKategoriFakultas('MOU');
            $judul   = 'DATA MoU / MoA FAKULTAS';
        } elseif ($filterSource === 'all') {
            $dokumen = DokumenProdi::with('profilProdi.user')
                ->whereIn('profil_prodi_id', $profilProdiIds)
                ->where('jenis', 'MOU')
                ->orderBy('created_at', 'desc')->get();
            $judul   = 'DATA MoU / MoA SEMUA PRODI';
        } elseif (str_starts_with($filterSource, 'prodi-')) {
            $uid = (int) str_replace('prodi-', '', $filterSource);
            $pid = ProfilProdi::where('user_id', $uid)->pluck('id')->toArray();
            $dokumen = DokumenProdi::with('profilProdi.user')
                ->whereIn('profil_prodi_id', $pid)
                ->where('jenis', 'MOU')
                ->orderBy('created_at', 'desc')->get();
            $p = $prodi->firstWhere('id', $uid);
            $judul   = 'DATA MoU / MoA PRODI ' . strtoupper($p->sub_unit ?? $p->name ?? '-');
        } else {
            $dokumen = collect();
            $judul   = 'DATA MoU / MoA';
        }

        // Header Cetak
        $headerCetak = SettingHeaderCetak::latest('id')->first();
        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y') : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        $namaFakultas = $user->name ?? '-';
        $unit         = $user->unit ?? '-';

        return view('print.fakultas.identitas-mou', compact(
            'dokumen', 'judul',
            'headerNoDokumen', 'headerTanggalTerbit', 'headerNoRevisi',
            'namaFakultas', 'unit', 'filterSource',
        ));
    }

    /**
     * ==========================================================
     * PRINT JUMLAH MAHASISWA (Fakultas + Prodi) — dengan filter
     * ==========================================================
     */
    public function printMahasiswa(Request $request)
    {
        $user = Auth::user();
        if (!$user) abort(401, 'Anda harus login terlebih dahulu.');

        $profil = $this->profil();
        $prodi  = $this->daftarProdi();

        $profilProdiData = ProfilProdi::with('user')
            ->whereIn('user_id', $prodi->pluck('id')->toArray())
            ->get();

        $filterSource = $request->query('filter_source', 'fakultas');

        $rows = collect();
        if ($filterSource === 'fakultas') {
            $rows->push([
                'prodi'  => 'Fakultas',
                'jumlah' => $profil->jumlah_mahasiswa ?? 0,
                'tahun'  => $profil->tahun_akademik ?? '-',
            ]);
            $judul = 'DATA JUMLAH MAHASISWA FAKULTAS';
            $filterInfo = 'Data Fakultas';
        } elseif ($filterSource === 'all') {
            foreach ($profilProdiData as $p) {
                $rows->push([
                    'prodi'  => optional($p->user)->sub_unit ?? '-',
                    'jumlah' => $p->jumlah_mahasiswa ?? 0,
                    'tahun'  => $p->tahun_akademik ?? '-',
                ]);
            }
            $judul = 'DATA JUMLAH MAHASISWA SEMUA PRODI';
            $filterInfo = 'Semua Prodi';
        } elseif (str_starts_with($filterSource, 'prodi-')) {
            $uid = (int) str_replace('prodi-', '', $filterSource);
            $p = $profilProdiData->firstWhere('user_id', $uid);
            if ($p) {
                $rows->push([
                    'prodi'  => optional($p->user)->sub_unit ?? '-',
                    'jumlah' => $p->jumlah_mahasiswa ?? 0,
                    'tahun'  => $p->tahun_akademik ?? '-',
                ]);
            }
            $prodiModel = $prodi->firstWhere('id', $uid);
            $judul = 'DATA JUMLAH MAHASISWA PRODI ' . strtoupper($prodiModel->sub_unit ?? $prodiModel->name ?? '-');
            $filterInfo = 'Prodi: ' . ($prodiModel->sub_unit ?? $prodiModel->name ?? '-');
        } else {
            $judul = 'DATA JUMLAH MAHASISWA';
            $filterInfo = null;
        }

        // Header Cetak
        $headerCetak = SettingHeaderCetak::latest('id')->first();
        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y') : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        $namaFakultas = $user->name ?? '-';
        $unit         = $user->unit ?? '-';

        return view('print.fakultas.identitas-mahasiswa', compact(
            'rows', 'judul', 'filterInfo',
            'headerNoDokumen', 'headerTanggalTerbit', 'headerNoRevisi',
            'namaFakultas', 'unit',
        ));
    }
}