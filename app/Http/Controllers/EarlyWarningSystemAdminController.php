<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use App\Models\User;
use Illuminate\Http\Request;

class EarlyWarningSystemAdminController extends Controller
{
    /**
     * Menampilkan halaman Early Warning System
     */
    public function index()
    {
        $akreditasis = Akreditasi::orderBy('id', 'asc')
            ->paginate(10);

        $units = User::whereNotNull('unit')
            ->select('unit')
            ->distinct()
            ->orderBy('unit')
            ->pluck('unit');

        return view('pages.early-warning-system', compact('akreditasis', 'units'));
    }

    /**
     * Ambil daftar sub unit berdasarkan unit
     */
    public function getSubUnit($unit)
    {
        $subUnits = User::where('unit', $unit)
            ->whereNotNull('sub_unit')
            ->select('sub_unit')
            ->distinct()
            ->orderBy('sub_unit')
            ->pluck('sub_unit');

        return response()->json($subUnits);
    }

    /**
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program'                  => 'required|string|max:255',
            'unit'                     => 'required|string|max:255',
            'sub_unit'                 => 'required|string|max:255',
            'nomor_sk'                 => 'required|string|max:255',
            'tanggal_sk'               => 'required',
            'peringkat_akreditasi'     => 'required|string|max:255',
            'tanggal_kadaluarsa'       => 'required',
            'akreditasi_nasional'      => 'nullable|string|max:255',
            'akreditasi_internasional' => 'nullable|string|max:255',
            'keterangan'               => 'nullable|string',
        ]);

        $akreditasi = Akreditasi::create($validated);

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan.',
                'data'    => $akreditasi,
            ]);
        }

        return redirect()
            ->route('admin.early-warning-system.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Mengambil data berdasarkan ID (untuk modal edit AJAX)
     */
    public function edit($id)
    {
        $data = Akreditasi::findOrFail($id);

        return response()->json($data);
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $akreditasi = Akreditasi::findOrFail($id);

        $validated = $request->validate([
            'program'                   => 'required|string|max:255',
            'unit'                      => 'required|string|max:255',
            'sub_unit'                  => 'required|string|max:255',
            'nomor_sk'                  => 'required|string|max:255',
            'tanggal_sk'                => 'required|date',
            'peringkat_akreditasi'      => 'required|string|max:255',
            'tanggal_kadaluarsa'        => 'required|date',
            'akreditasi_nasional'       => 'nullable|string|max:255',
            'akreditasi_internasional'  => 'nullable|string|max:255',
            'keterangan'                => 'nullable|string',
        ]);

        $akreditasi->update($validated);

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'data'    => $akreditasi->fresh(),
            ]);
        }

        return redirect()
            ->route('admin.early-warning-system.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy(Request $request, $id)
    {
        $akreditasi = Akreditasi::findOrFail($id);

        $akreditasi->delete();

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('admin.early-warning-system.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}