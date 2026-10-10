<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProfilProdi;
use App\Models\ProdiKegiatanBenchmarking;
use App\Models\ProdiSosialMedia;
use App\Services\Prodi\DokumenProdiService;
use App\Services\Prodi\ProfilProdiService;
use App\Http\Requests\Prodi\StoreVmtsRequest;
use App\Http\Requests\Prodi\UpdateVmtsRequest;
use App\Http\Requests\Prodi\StoreDokumenRequest;
use App\Http\Requests\Prodi\UpdateDokumenRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\DokumenProdi;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class ProfileProdiController extends Controller
{
    /**
     * Service Dokumen Prodi
     */
    protected DokumenProdiService $dokumenService;
    protected ProfilProdiService $profilService;

    /**
     * Constructor
     */
    public function __construct(
        DokumenProdiService $dokumenService,
        ProfilProdiService $profilService
    ) {
        $this->dokumenService = $dokumenService;
        $this->profilService = $profilService;
    }

    /**
     * Ambil profil prodi berdasarkan user login.
     */
    private function profil()
    {
        return ProfilProdi::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
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

    private function formatTanggal($tanggal)
    {
        if (!$tanggal) {
            return null;
        }

        return Carbon::parse($tanggal)->format('Y-m-d');
    }

    /**
     * Halaman utama
     */
    public function index()
    {
        $profil = $this->profil();

        $kegiatanBenchmarking = ProdiKegiatanBenchmarking::with('user')
            ->orderBy('id', 'asc')
            ->get();

        // Ambil / buat data sosial media prodi yang login
        $sosialMedia = ProdiSosialMedia::firstOrCreate(
            ['users_id' => Auth::id()],
            [
                'instagram' => null,
                'facebook'  => null,
                'youtube'   => null,
                'tiktok'    => null,
                'linkedin'  => null,
                'website'   => null,
            ]
        );

        return view('pages.prodi.identitas-prodi', [
            'profil'               => $profil,
            'dokumenRip'           => $this->dokumenService->getByJenis('RIP'),
            'dokumenRenstra'       => $this->dokumenService->getByJenis('RENSTRA'),
            'dokumenRenop'         => $this->dokumenService->getByJenis('RENOP'),
            'dokumenMou'           => $this->dokumenService->getByJenis('MOU'),
            'kegiatanBenchmarking' => $kegiatanBenchmarking,
            'dtps'                 => $profil,
            'jabatan'              => $profil,
            'mahasiswa'            => $profil,
            'sosialMedia'          => $sosialMedia,
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

        // Ambil atau buat profil untuk user yang login
        $profil = $this->profil();

        // Hitung total DTPS
        $total = (int) $request->jumlah_magister + (int) $request->jumlah_doktor;

        // Update data DTPS
        $profil->jumlah_magister = $request->jumlah_magister;
        $profil->jumlah_doktor = $request->jumlah_doktor;
        $profil->jumlah_total = $total;
        $profil->save();

        return $this->success(
            'Data DTPS berhasil ditambahkan.',
            $profil
        );
    }

    /**
     * ==========================================================
     * UPDATE DATA DTPS
     * ==========================================================
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

        $profil = ProfilProdi::findOrFail($id);

        // Hitung ulang total DTPS
        $total = (int) $request->jumlah_magister + (int) $request->jumlah_doktor;

        $profil->update([
            'jumlah_magister' => $request->jumlah_magister,
            'jumlah_doktor'   => $request->jumlah_doktor,
            'jumlah_total'    => $total,
        ]);

        return $this->success(
            'Data DTPS berhasil diperbarui.',
            $profil
        );
    }

    /**
     * ==========================================================
     * HAPUS/RESET DATA DTPS
     * ==========================================================
     */
    public function destroyDtps($id)
    {
        $profil = ProfilProdi::findOrFail($id);

        $profil->update([
            'jumlah_magister' => 0,
            'jumlah_doktor'   => 0,
            'jumlah_total'    => 0,

            // Data jabatan fungsional TIDAK direset
            'jumlah_asisten_ahli'  => $profil->jumlah_asisten_ahli,
            'jumlah_lektor'        => $profil->jumlah_lektor,
            'jumlah_lektor_kepala' => $profil->jumlah_lektor_kepala,
            'jumlah_guru_besar'    => $profil->jumlah_guru_besar,
        ]);

        return $this->success(
            'Data DTPS berhasil direset ke 0.'
        );
    }

    /**
     * ==========================================================
     * STORE JABATAN FUNGSIONAL
     * ==========================================================
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

        return $this->success(
            'Data Jabatan Fungsional berhasil ditambahkan.',
            $profil
        );
    }

    /**
     * ==========================================================
     * UPDATE JABATAN FUNGSIONAL
     * ==========================================================
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

        $profil = ProfilProdi::findOrFail($id);

        $profil->update([
            'jumlah_asisten_ahli' => $request->jumlah_asisten_ahli,
            'jumlah_lektor' => $request->jumlah_lektor,
            'jumlah_lektor_kepala' => $request->jumlah_lektor_kepala,
            'jumlah_guru_besar' => $request->jumlah_guru_besar,
        ]);

        return $this->success(
            'Data Jabatan Fungsional berhasil diperbarui.',
            $profil
        );
    }

    /**
     * ==========================================================
     * DELETE/RESET JABATAN FUNGSIONAL
     * ==========================================================
     */
    public function destroyJabatan($id)
    {
        $profil = ProfilProdi::findOrFail($id);

        $profil->update([
            'jumlah_asisten_ahli' => 0,
            'jumlah_lektor' => 0,
            'jumlah_lektor_kepala' => 0,
            'jumlah_guru_besar' => 0,
        ]);

        return $this->success(
            'Data Jabatan Fungsional berhasil direset ke 0.'
        );
    }

    public function storeVmts(StoreVmtsRequest $request)
    {
        return $this->success(
            'VMTS berhasil ditambahkan.',
            $this->profilService->storeVmts(
                $request->validated()
            )
        );
    }

    public function showVmts($id)
    {
        return $this->success(
            'Data ditemukan.',
            $this->profilService->findVmts($id)
        );
    }

    public function updateVmts(
        UpdateVmtsRequest $request,
        $id
    ){
        return $this->success(
            'VMTS berhasil diperbarui.',
            $this->profilService->updateVmts(
                $request->validated(),
                $id
            )
        );
    }

    public function destroyVmts($id)
    {
        $this->profilService->deleteVmts($id);

        return $this->success(
            'VMTS berhasil dihapus.'
        );
    }

    /**
     * ==========================================================
     * TAMBAH DATA MAHASISWA
     * ==========================================================
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

        return $this->success(
            'Data Mahasiswa berhasil ditambahkan.',
            $profil
        );
    }

    /**
     * ==========================================================
     * UPDATE DATA MAHASISWA
     * ==========================================================
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

        $profil = ProfilProdi::findOrFail($id);

        $profil->update([
            'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
            'tahun_akademik'   => $request->tahun_akademik,
        ]);

        return $this->success(
            'Data Mahasiswa berhasil diperbarui.',
            $profil
        );
    }

    /**
     * ==========================================================
     * HAPUS/RESET DATA MAHASISWA
     * ==========================================================
     */
    public function destroyMahasiswa($id)
    {
        $profil = ProfilProdi::findOrFail($id);

        $profil->update([
            'jumlah_mahasiswa' => 0,
            'tahun_akademik'   => null,
        ]);

        return $this->success(
            'Data Mahasiswa berhasil direset ke 0.'
        );
    }

    /**
     * ==========================================================
     * TAMBAH DOKUMEN
     * ==========================================================
     */
    public function storeDocument(StoreDokumenRequest $request)
    {
        return $this->success(
            'Dokumen berhasil ditambahkan.',
            $this->dokumenService->store($request)
        );
    }

    /**
     * ==========================================================
     * GET RASIO DOSEN : MAHASISWA
     * ==========================================================
     */
    public function getRasio($id)
    {
        $profil = ProfilProdi::findOrFail($id);
        
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
     * DETAIL DOKUMEN
     * ==========================================================
     */
    public function showDocument($id)
    {
        return $this->success(
            'Data ditemukan.',
            $this->dokumenService->find($id)
        );
    }

    /**
     * ==========================================================
     * EDIT DOKUMEN
     * ==========================================================
     */
    // public function editDocument($id)
    // {
    //     $dokumen = DokumenProdi::findOrFail($id);

    //     return $this->success(
    //         'Data ditemukan.',
    //         $dokumen
    //     );
    // }

    /**
     * ==========================================================
     * UPDATE DOKUMEN
     * ==========================================================
     */
    public function updateDocument(UpdateDokumenRequest $request, $id)
    {
        $dokumen = $this->dokumenService->update($request, $id);

        return $this->success(
            'Dokumen berhasil diperbarui.',
            $dokumen
        );
    }

    /**
     * ==========================================================
     * HAPUS DOKUMEN
     * ==========================================================
     */
    public function destroyDocument($id)
    {
        $this->dokumenService->delete($id);

        return $this->success(
            'Dokumen berhasil dihapus.'
        );
    }

    /**
     * ==========================================================
     * PRINT DOKUMEN MoU (milik user sendiri)
     * ==========================================================
     */
    public function printMou()
    {
        $user   = Auth::user();
        $profil = $this->profil();

        // Ambil dokumen MoU milik user login
        $dokumenMou = DokumenProdi::where('profil_prodi_id', $profil->id)
            ->where('jenis', 'MOU')
            ->orderBy('id', 'asc')
            ->get();

        // ==================== HEADER CETAK (global) ====================
        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        // ==================== INFO PRODI ====================
        $namaProdi = $user->name ?? '-';
        $unit      = $user->unit ?? '-';

        return view('print.prodi.mou', compact(
            'dokumenMou',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
        ));
    }

    /**
     * ==========================================================
     * PRINT DATA JUMLAH MAHASISWA (milik user sendiri)
     * ==========================================================
     */
    public function printMahasiswa()
    {
        $user   = Auth::user();
        $profil = $this->profil();

        // Ambil data mahasiswa dari profil prodi user login
        $jumlahMahasiswa = $profil->jumlah_mahasiswa ?? 0;
        $tahunAkademik   = $profil->tahun_akademik ?? '-';

        // ==================== HEADER CETAK (global) ====================
        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        // ==================== INFO PRODI ====================
        $namaProdi = $user->name ?? '-';
        $unit      = $user->unit ?? '-';

        return view('print.prodi.mahasiswa', compact(
            'jumlahMahasiswa',
            'tahunAkademik',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
        ));
    }
}