<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataMahasiswa;
use App\Models\RasioDosenMahasiswaProdi;
use App\Models\ProdiDataLulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class ProfilePdDiktiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil SEMUA data (bukan paginate) — pagination dihandle di client-side
        $mahasiswa = ProdiDataMahasiswa::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $rasio = RasioDosenMahasiswaProdi::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $lulusan = ProdiDataLulusan::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.profile-pd-dikti', compact('mahasiswa', 'rasio', 'lulusan'));
    }

    /**
     * Menyimpan data mahasiswa PD Dikti baru.
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

            $existing = ProdiDataMahasiswa::where('users_id', $userId)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data untuk tahun akademik ' . $request->tahun_akademik . ' sudah ada!',
                ], 409);
            }

            $mahasiswa = ProdiDataMahasiswa::create([
                'tahun_akademik' => $request->tahun_akademik,
                'ta_6' => $request->ta_6,
                'ta_5' => $request->ta_5,
                'ta_4' => $request->ta_4,
                'ta_3' => $request->ta_3,
                'ta_2' => $request->ta_2,
                'ta_1' => $request->ta_1,
                'ta' => $request->ta,
                'lulusan_akhir_ta' => $request->lulusan_akhir_ta,
                'users_id' => $userId,
            ]);

            $mahasiswa->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa berhasil ditambahkan!',
                'data' => $mahasiswa,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $userId = Auth::id();

            $mahasiswa = ProdiDataMahasiswa::with('user')
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

            $mahasiswa = ProdiDataMahasiswa::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            $existing = ProdiDataMahasiswa::where('users_id', $userId)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->where('id', '!=', $id)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data untuk tahun akademik ' . $request->tahun_akademik . ' sudah ada!',
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
                'message' => 'Data mahasiswa berhasil diupdate!',
                'data' => $mahasiswa,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $userId = Auth::id();

            $mahasiswa = ProdiDataMahasiswa::where('users_id', $userId)
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
                'message' => 'Data mahasiswa berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ==========================================================
     * PRINT DATA MAHASISWA PD DIKTI (milik user sendiri)
     * ==========================================================
     */
    public function printMahasiswa()
    {
        $userId = Auth::id();
        $user   = Auth::user();

        $mahasiswa = ProdiDataMahasiswa::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        // Header cetak (global)
        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        $namaProdi = $user->name ?? '-';
        $unit      = $user->unit ?? '-';

        return view('print.prodi.pd-dikti-mahasiswa', compact(
            'mahasiswa',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
        ));
    }

    /**
     * ==========================================================
     * PRINT DATA LULUSAN PD DIKTI (milik user sendiri)
     * ==========================================================
     */
    public function printLulusan()
    {
        $userId = Auth::id();
        $user   = Auth::user();

        $lulusan = ProdiDataLulusan::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        $namaProdi = $user->name ?? '-';
        $unit      = $user->unit ?? '-';

        return view('print.prodi.pd-dikti-lulusan', compact(
            'lulusan',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
        ));
    }
}