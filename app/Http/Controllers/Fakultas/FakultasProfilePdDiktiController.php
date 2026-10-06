<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\FakultasDataMahasiswa;
use App\Models\RasioDosenMahasiswaFakultas;
use App\Models\FakultasDataLulusan;
use App\Models\User;
use App\Models\ProdiDataMahasiswa;
use App\Models\RasioDosenMahasiswaProdi;
use App\Models\ProdiDataLulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FakultasProfilePdDiktiController extends Controller
{
    /**
     * Menampilkan data PD Dikti Fakultas.
     */
    public function index()
    {
        $user   = Auth::user();
        $userId = Auth::id();

        $prodi = User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();

        $prodiUserIds = $prodi->pluck('id')->toArray();

        // ================= DATA FAKULTAS =================
        $mahasiswaFakultas = FakultasDataMahasiswa::with('user')
            ->where('users_id', $userId)->orderBy('id', 'asc')->get();

        $rasioFakultas = RasioDosenMahasiswaFakultas::with('user')
            ->where('users_id', $userId)->orderBy('id', 'asc')->get();

        $lulusanFakultas = FakultasDataLulusan::with('user')
            ->where('users_id', $userId)->orderBy('id', 'asc')->get();

        // ================= DATA PRODI =================
        $mahasiswaProdi = ProdiDataMahasiswa::with('user')
            ->whereIn('users_id', $prodiUserIds)->orderBy('id', 'asc')->get();

        $rasioProdi = RasioDosenMahasiswaProdi::with('user')
            ->whereIn('users_id', $prodiUserIds)->orderBy('id', 'asc')->get();

        $lulusanProdi = ProdiDataLulusan::with('user')
            ->whereIn('users_id', $prodiUserIds)->orderBy('id', 'asc')->get();

        return view('pages.fakultas.fakultas-profile-pd-dikti', compact(
            'prodi',
            'mahasiswaFakultas', 'mahasiswaProdi',
            'rasioFakultas', 'rasioProdi',
            'lulusanFakultas', 'lulusanProdi'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | DATA MAHASISWA
    |--------------------------------------------------------------------------
    */

    /**
     * Menyimpan data mahasiswa Fakultas.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_akademik' => 'required|string|max:20',

            'ta_6' => 'required|integer|min:0',
            'ta_5' => 'required|integer|min:0',
            'ta_4' => 'required|integer|min:0',
            'ta_3' => 'required|integer|min:0',
            'ta_2' => 'required|integer|min:0',
            'ta_1' => 'required|integer|min:0',
            'ta' => 'required|integer|min:0',

            'lulusan_akhir_ta' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $existing = FakultasDataMahasiswa::where('users_id', $userId)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data untuk tahun akademik '
                        . $request->tahun_akademik
                        . ' sudah ada!',
                ], 409);
            }

            $mahasiswa = FakultasDataMahasiswa::create([
                'users_id' => $userId,

                'tahun_akademik' => $request->tahun_akademik,

                'ta_6' => $request->ta_6,
                'ta_5' => $request->ta_5,
                'ta_4' => $request->ta_4,
                'ta_3' => $request->ta_3,
                'ta_2' => $request->ta_2,
                'ta_1' => $request->ta_1,
                'ta' => $request->ta,

                'lulusan_akhir_ta' => $request->lulusan_akhir_ta,
            ]);

            $mahasiswa->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa Fakultas berhasil ditambahkan!',
                'data' => $mahasiswa,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan detail data mahasiswa.
     */
    public function show($id)
    {
        try {
            $userId = Auth::id();

            $mahasiswa = FakultasDataMahasiswa::with('user')
                ->where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $mahasiswa,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mengupdate data mahasiswa.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun_akademik' => 'required|string|max:20',

            'ta_6' => 'required|integer|min:0',
            'ta_5' => 'required|integer|min:0',
            'ta_4' => 'required|integer|min:0',
            'ta_3' => 'required|integer|min:0',
            'ta_2' => 'required|integer|min:0',
            'ta_1' => 'required|integer|min:0',
            'ta' => 'required|integer|min:0',

            'lulusan_akhir_ta' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $mahasiswa = FakultasDataMahasiswa::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            $existing = FakultasDataMahasiswa::where('users_id', $userId)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->where('id', '!=', $id)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data untuk tahun akademik '
                        . $request->tahun_akademik
                        . ' sudah ada!',
                ], 409);
            }

            $mahasiswa->update([
                'tahun_akademik' => $request->tahun_akademik,

                'ta_6' => $request->ta_6,
                'ta_5' => $request->ta_5,
                'ta_4' => $request->ta_4,
                'ta_3' => $request->ta_3,
                'ta_2' => $request->ta_2,
                'ta_1' => $request->ta_1,
                'ta' => $request->ta,

                'lulusan_akhir_ta' => $request->lulusan_akhir_ta,
            ]);

            $mahasiswa->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa Fakultas berhasil diupdate!',
                'data' => $mahasiswa,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menghapus data mahasiswa.
     */
    public function destroy($id)
    {
        try {
            $userId = Auth::id();

            $mahasiswa = FakultasDataMahasiswa::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            $mahasiswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa Fakultas berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RASIO DOSEN MAHASISWA
    |--------------------------------------------------------------------------
    */

    /**
     * Menyimpan data rasio dosen mahasiswa.
     */
    public function storeRasio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_akademik' => 'nullable|string|max:20',
            'jumlah_dosen' => 'required|integer|min:0',
            'jumlah_mahasiswa' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $tahunAkademik = $request->input('tahun_akademik');

            if (!is_null($tahunAkademik) && $tahunAkademik !== '') {
                $existing = RasioDosenMahasiswaFakultas::where('users_id', $userId)
                    ->where('tahun_akademik', $tahunAkademik)
                    ->first();

                if ($existing) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data rasio untuk tahun akademik '
                            . $tahunAkademik
                            . ' sudah ada!',
                    ], 409);
                }
            }

            $data = RasioDosenMahasiswaFakultas::create([
                'users_id' => $userId,
                'tahun_akademik' => $tahunAkademik ?: null,
                'jumlah_dosen' => (int) $request->jumlah_dosen,
                'jumlah_mahasiswa' => (int) $request->jumlah_mahasiswa,
            ]);

            $data->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data rasio berhasil ditambahkan!',
                'data' => $data,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan detail rasio.
     */
    public function showRasio($id)
    {
        try {
            $data = RasioDosenMahasiswaFakultas::with('user')
                ->where('users_id', Auth::id())
                ->where('id', $id)
                ->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data rasio tidak ditemukan!',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mengupdate data rasio.
     */
    public function updateRasio(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun_akademik' => 'nullable|string|max:20',
            'jumlah_dosen' => 'required|integer|min:0',
            'jumlah_mahasiswa' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $data = RasioDosenMahasiswaFakultas::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data rasio tidak ditemukan!',
                ], 404);
            }

            $tahunAkademik = $request->input('tahun_akademik');

            // Cek duplikat hanya jika tahun akademik diisi
            if (!is_null($tahunAkademik) && $tahunAkademik !== '') {
                $existing = RasioDosenMahasiswaFakultas::where('users_id', $userId)
                    ->where('tahun_akademik', $tahunAkademik)
                    ->where('id', '!=', $id)
                    ->first();

                if ($existing) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data rasio untuk tahun akademik '
                            . $tahunAkademik
                            . ' sudah ada!',
                    ], 409);
                }
            }

            $jumlahDosen = (int) $request->jumlah_dosen;
            $jumlahMahasiswa = (int) $request->jumlah_mahasiswa;

            // Rasio = mahasiswa / dosen
            $rasio = $jumlahDosen > 0
                ? round($jumlahMahasiswa / $jumlahDosen, 2)
                : null;

            $data->update([
                'tahun_akademik' => $tahunAkademik ?: null,
                'jumlah_dosen' => $jumlahDosen,
                'jumlah_mahasiswa' => $jumlahMahasiswa,
                'rasio' => $rasio,
            ]);

            $data->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data rasio berhasil diupdate!',
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menghapus rasio.
     */
    public function destroyRasio($id)
    {
        try {
            $data = RasioDosenMahasiswaFakultas::where('users_id', Auth::id())
                ->where('id', $id)
                ->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data rasio tidak ditemukan!',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data rasio berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DATA LULUSAN
    |--------------------------------------------------------------------------
    */

    public function storeLulusan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required|string|max:255',
            'ta_3' => 'required|integer|min:0',
            'ta_2' => 'required|integer|min:0',
            'ta_1' => 'required|integer|min:0',
            'ta' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $data = FakultasDataLulusan::create([
                'users_id' => Auth::id(),
                'nama_prodi' => $request->nama_prodi,
                'ta_3' => $request->ta_3,
                'ta_2' => $request->ta_2,
                'ta_1' => $request->ta_1,
                'ta' => $request->ta,
            ]);

            $data->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data lulusan berhasil ditambahkan!',
                'data' => $data,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function showLulusan($id)
    {
        try {
            $data = FakultasDataLulusan::with('user')
                ->where('users_id', Auth::id())
                ->where('id', $id)
                ->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data lulusan tidak ditemukan!',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function updateLulusan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required|string|max:255',
            'ta_3' => 'required|integer|min:0',
            'ta_2' => 'required|integer|min:0',
            'ta_1' => 'required|integer|min:0',
            'ta' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $data = FakultasDataLulusan::where('users_id', Auth::id())
                ->where('id', $id)
                ->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data lulusan tidak ditemukan!',
                ], 404);
            }

            $data->update([
                'nama_prodi' => $request->nama_prodi,
                'ta_3' => $request->ta_3,
                'ta_2' => $request->ta_2,
                'ta_1' => $request->ta_1,
                'ta' => $request->ta,
            ]);

            $data->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data lulusan berhasil diupdate!',
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function destroyLulusan($id)
    {
        try {
            $data = FakultasDataLulusan::where('users_id', Auth::id())
                ->where('id', $id)
                ->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data lulusan tidak ditemukan!',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data lulusan berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}