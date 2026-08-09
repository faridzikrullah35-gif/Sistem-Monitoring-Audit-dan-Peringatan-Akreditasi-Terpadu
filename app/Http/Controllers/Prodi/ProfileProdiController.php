<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProfilProdi;
use App\Services\Prodi\DokumenProdiService;
use App\Services\Prodi\ProfilProdiService;
use App\Http\Requests\Prodi\StoreVmtsRequest;
use App\Http\Requests\Prodi\UpdateVmtsRequest;
use App\Http\Requests\Prodi\StoreDokumenRequest;
use App\Http\Requests\Prodi\UpdateDokumenRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
        
        return view('pages.prodi.identitas-prodi', [
            'profil'   => $profil,
            'dokumenRip'      => $this->dokumenService->getByJenis('RIP'),
            'dokumenRenstra'  => $this->dokumenService->getByJenis('RENSTRA'),
            'dokumenRenop'    => $this->dokumenService->getByJenis('RENOP'),
            'dokumenMou'      => $this->dokumenService->getByJenis('MOU'),
        ]);
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
     * UPDATE DATA DTPS
     * ==========================================================
     */
    public function updateDtps(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'jumlah_dtps_magister' => 'required|integer|min:0',
            'jumlah_dtps_doktor'   => 'required|integer|min:0',

            'jumlah_aa'            => 'required|integer|min:0',
            'jumlah_lk'            => 'required|integer|min:0',
            'jumlah_gb'            => 'required|integer|min:0',

        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $this->profil()->update([

            'jumlah_dtps_magister' => $request->jumlah_dtps_magister,
            'jumlah_dtps_doktor'   => $request->jumlah_dtps_doktor,

            'jumlah_aa'            => $request->jumlah_aa,
            'jumlah_lk'            => $request->jumlah_lk,
            'jumlah_gb'            => $request->jumlah_gb,

        ]);

        return $this->success('Data DTPS berhasil diperbarui.');
    }

    /**
     * ==========================================================
     * UPDATE DATA MAHASISWA
     * ==========================================================
     */
    public function updateMahasiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'jumlah_mahasiswa' => 'required|integer|min:0',

        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $this->profil()->update([

            'jumlah_mahasiswa' => $request->jumlah_mahasiswa,

        ]);

        return $this->success('Jumlah mahasiswa berhasil diperbarui.');
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
}