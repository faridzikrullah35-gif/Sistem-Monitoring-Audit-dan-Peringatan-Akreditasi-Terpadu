<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingHakAksesFakultas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingHakAksesFakultasController extends Controller
{
    /**
     * Halaman utama
     */
    public function index(Request $request)
    {
        $query = SettingHakAksesFakultas::with('user');
        $akses = $query->orderBy('id')->paginate(10)->withQueryString();
        $daftarFakultas = User::whereNotNull('unit')->where('unit', '!=', '')->distinct()->orderBy('unit')->pluck('unit');
        $users = User::where('role', 'fakultas')->orderBy('name')->get();

        return view('pages.admin.setting-hak-akses-fakultas', compact('akses', 'daftarFakultas', 'users'));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($this->isDuplicate($data)) {
            return $this->error('Setting akses untuk user dan sub unit tersebut sudah ada.');
        }

        try {
            $akses = SettingHakAksesFakultas::create($data);
            return $this->success('Setting hak akses berhasil ditambahkan.', $akses->load('user'), 201);
        } catch (\Throwable $e) {
            return $this->exception('Gagal menambahkan Setting Hak Akses Fakultas', $e);
        }
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $akses = SettingHakAksesFakultas::findOrFail($id);
        $data = $this->validateData($request);

        if ($this->isDuplicate($data, $id)) {
            return $this->error('Setting akses untuk user dan sub unit tersebut sudah ada.');
        }

        try {
            $akses->update($data);
            return $this->success('Setting hak akses berhasil diperbarui.', $akses->fresh()->load('user'));
        } catch (\Throwable $e) {
            return $this->exception('Gagal mengupdate Setting Hak Akses Fakultas', $e);
        }
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        try {
            $akses = SettingHakAksesFakultas::findOrFail($id);
            $akses->delete();
            return response()->json([
                'success' => true,
                'message' => 'Setting hak akses berhasil dihapus.',
                'id' => $id,
            ]);
        } catch (\Throwable $e) {
            return $this->exception('Gagal menghapus Setting Hak Akses Fakultas', $e);
        }
    }

    /**
     * Toggle status
     */
    public function toggleStatus($id)
    {
        try {
            $akses = SettingHakAksesFakultas::findOrFail($id);
            $akses->update(['is_active' => !$akses->is_active]);
            $status = $akses->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return response()->json([
                'success' => true,
                'message' => "Setting hak akses berhasil {$status}.",
                'data' => [
                    'id' => $akses->id,
                    'is_active' => $akses->is_active,
                ],
            ]);
        } catch (\Throwable $e) {
            return $this->exception('Gagal toggle status Setting Hak Akses Fakultas', $e);
        }
    }

    /**
     * Ambil sub unit berdasarkan fakultas
     */
    public function getSubUnitsByFaculty(Request $request)
    {
        if (!$request->filled('fakultas')) {
            return response()->json([]);
        }

        $subUnits = User::where('unit', $request->fakultas)
            ->whereNotNull('sub_unit')
            ->where('sub_unit', '!=', '')
            ->distinct()
            ->orderBy('sub_unit')
            ->pluck('sub_unit');

        $options = [];
        foreach ($subUnits as $subUnit) {
            $options[] = ['value' => $subUnit, 'label' => $subUnit];
        }

        return response()->json($options);
    }

    /**
     * Ambil data user
     */
    public function getUserData($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'unit' => $user->unit,
            'sub_unit' => $user->sub_unit,
            'role' => $user->role,
        ]);
    }

    // =========================================================
    // PRIVATE HELPERS
    // =========================================================

    /**
     * Validasi data request
     */
    private function validateData(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'fakultas' => ['required', 'string', 'max:255'],
            'sub_unit' => ['nullable', 'array'],
            'sub_unit.*' => ['nullable', 'string', 'max:255'],
            'level_akses' => ['required', 'in:read,write'],
            'is_active' => ['nullable', 'boolean'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ], [
            'user_id.required' => 'User harus dipilih.',
            'user_id.exists' => 'User tidak ditemukan.',
            'fakultas.required' => 'Fakultas harus diisi.',
            'sub_unit.array' => 'Sub unit harus berupa pilihan yang valid.',
            'sub_unit.*.string' => 'Sub unit tidak valid.',
            'level_akses.required' => 'Level akses harus dipilih.',
            'level_akses.in' => 'Level akses tidak valid.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI SUB UNIT
        |--------------------------------------------------------------------------
        */
        $subUnits = $request->input('sub_unit', []);
        if (!is_array($subUnits)) $subUnits = [];

        // Bersihkan value kosong
        $subUnits = collect($subUnits)
            ->map(function ($value) { return trim((string) $value); })
            ->filter(function ($value) { return $value !== ''; })
            ->unique()
            ->values()
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Jika kosong = akses ke semua sub unit
        |--------------------------------------------------------------------------
        */
        $data['sub_unit'] = empty($subUnits) ? null : $subUnits;

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    /**
     * Cek duplicate setting
     *
     * Duplicate berdasarkan:
     * - user
     * - fakultas
     * - sub unit
     */
    private function isDuplicate(array $data, $exceptId = null)
    {
        $query = SettingHakAksesFakultas::query()
            ->where('user_id', $data['user_id'])
            ->where('fakultas', $data['fakultas']);

        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }

        /*
        |--------------------------------------------------------------------------
        | Data sub unit baru
        |--------------------------------------------------------------------------
        */
        $newSubUnits = $data['sub_unit'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Jika kosong = akses semua sub unit
        |--------------------------------------------------------------------------
        |
        | Setting dengan sub_unit NULL dianggap konflik
        | dengan setting NULL lainnya untuk user + fakultas yang sama.
        |
        */
        if (empty($newSubUnits)) {
            return $query->whereNull('sub_unit')->exists();
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil setting user + fakultas
        |--------------------------------------------------------------------------
        */
        $existingSettings = $query->whereNotNull('sub_unit')->get();

        /*
        |--------------------------------------------------------------------------
        | Cek apakah ada sub unit yang bentrok
        |--------------------------------------------------------------------------
        */
        foreach ($existingSettings as $existing) {
            $existingSubUnits = $existing->sub_unit;

            /*
             * Kalau model belum melakukan cast array,
             * coba decode manual.
             */
            if (is_string($existingSubUnits)) {
                $decoded = json_decode($existingSubUnits, true);
                $existingSubUnits = is_array($decoded) ? $decoded : [$existingSubUnits];
            }

            if (!is_array($existingSubUnits)) continue;

            /*
             * Cek irisan sub unit.
             *
             * Contoh:
             *
             * Existing: ["Teknik Informatika", "Akuntansi"]
             * Baru: ["Akuntansi", "Sistem Informasi"]
             * Hasil: ["Akuntansi"]
             * berarti duplicate.
             */
            $overlap = array_intersect($newSubUnits, $existingSubUnits);

            if (!empty($overlap)) return true;
        }

        return false;
    }

    /**
     * Response success
     */
    private function success($message, $data = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Response error
     */
    private function error($message, $status = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    /**
     * Response exception
     */
    private function exception($context, \Throwable $e)
    {
        Log::error($context, [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan pada server.',
            'error' => config('app.debug') ? $e->getMessage() : null,
        ], 500);
    }
}