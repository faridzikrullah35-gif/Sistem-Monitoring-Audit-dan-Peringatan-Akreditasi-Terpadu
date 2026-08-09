<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataAkreditasiController extends Controller
{
    /**
     * Menampilkan daftar data akreditasi.
     */
    public function index()
    {
        $akreditasis = Akreditasi::orderBy('id')->paginate(10);

        return view('pages.data-akreditasi', compact('akreditasis'));
    }

    /**
     * Menyimpan data akreditasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_studi_id' => 'required|exists:program_studi,id',
            'nomor_sk'         => 'required|string|max:255',
            'peringkat'        => 'required|string|max:50',
            'tanggal_sk'       => 'required|date',
            'kadaluarsa'       => 'required|date|after:tanggal_sk',
        ]);

        $akreditasi = Akreditasi::create($validated);

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data akreditasi berhasil ditambahkan.',
                'data'    => $akreditasi,
            ]);
        }

        return redirect()
            ->route('data-akreditasi')
            ->with('success', 'Data akreditasi berhasil ditambahkan.');
    }

    /**
     * Mengambil data untuk modal edit / lengkapi.
     */
    public function show($id)
    {
        return response()->json(
            Akreditasi::findOrFail($id)
        );
    }

    /**
     * Update data akreditasi (untuk edit data utama dan lengkapi).
     * Menangani kedua mode secara bersamaan.
     */
    public function update(Request $request, $id)
    {
        $akreditasi = Akreditasi::findOrFail($id);

        $validated = $request->validate([
            // Field utama (edit)
            'program_studi_id' => 'nullable|exists:program_studi,id',
            'nomor_sk'         => 'nullable|string|max:255',
            'peringkat'        => 'nullable|string|max:50',
            'tanggal_sk'       => 'nullable|date',
            'kadaluarsa'       => 'nullable|date',

            // Field pelengkap (lengkapi)
            'upcoming_ts3'         => 'nullable|string|max:255',
            'upcoming_ts2'         => 'nullable|string|max:255',
            'upcoming_ts1'         => 'nullable|string|max:255',
            'upcoming_ts'          => 'nullable|string|max:255',
            'tanggal_pendampingan' => 'nullable|date',

            'led'  => 'nullable|file|mimes:pdf|max:2048',
            'lkpt' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = collect($validated)
            ->except(['led','lkpt'])
            ->toArray();

        // Proses file LED
        if ($request->hasFile('led')) {
            if ($akreditasi->led && Storage::disk('public')->exists($akreditasi->led)) {
                Storage::disk('public')->delete($akreditasi->led);
            }
            $data['led'] = $request->file('led')->store('led_files', 'public');
        }

        // Proses file LKPT
        if ($request->hasFile('lkpt')) {
            if ($akreditasi->lkpt && Storage::disk('public')->exists($akreditasi->lkpt)) {
                Storage::disk('public')->delete($akreditasi->lkpt);
            }
            $data['lkpt'] = $request->file('lkpt')->store('lkpt_files', 'public');
        }

        $akreditasi->update($data);

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data akreditasi berhasil diperbarui.',
                'data'    => $akreditasi->fresh(),
            ]);
        }

        return redirect()
            ->route('data-akreditasi')
            ->with('success', 'Data akreditasi berhasil diperbarui.');
    }

    /**
     * Method khusus untuk lengkapi data (hanya field pelengkap).
     * Bisa digunakan jika ingin memisahkan logika dari update.
     * Secara internal memanggil update() agar tidak duplikasi kode.
     */
    public function lengkapi(Request $request, $id)
    {
        // Hanya validasi field pelengkap
        $request->validate([
            'upcoming_ts3'         => 'nullable|string|max:255',
            'upcoming_ts2'         => 'nullable|string|max:255',
            'upcoming_ts1'         => 'nullable|string|max:255',
            'upcoming_ts'          => 'nullable|string|max:255',
            'tanggal_pendampingan' => 'nullable|date',
            'led'                  => 'nullable|file|mimes:pdf|max:2048',
            'lkpt'                 => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Panggil method update dengan request yang sama
        return $this->update($request, $id);
    }

    /**
     * Menghapus data akreditasi beserta file-file terkait.
     */
    public function destroy($id)
    {
        $akreditasi = Akreditasi::findOrFail($id);

        // Hapus file LED jika ada
        if ($akreditasi->led && Storage::disk('public')->exists($akreditasi->led)) {
            Storage::disk('public')->delete($akreditasi->led);
        }

        // Hapus file LKPT jika ada
        if ($akreditasi->lkpt && Storage::disk('public')->exists($akreditasi->lkpt)) {
            Storage::disk('public')->delete($akreditasi->lkpt);
        }

        $akreditasi->delete();

        if (request()->ajax() || request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data akreditasi berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('data-akreditasi')
            ->with('success', 'Data akreditasi berhasil dihapus.');
    }
}