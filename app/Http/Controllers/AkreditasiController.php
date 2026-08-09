<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AkreditasiController extends Controller
{
    public function index()
    {
        $akreditasi = Akreditasi::orderBy('created_at', 'desc')->paginate(10);
        // Tambahkan atribut tambahan untuk status & sisa kadaluarsa
        foreach ($akreditasi as $item) {
            $item->status_daluwarsa = $this->getStatus($item->tanggal_kadaluarsa);
            $item->sisa_kadaluarsa = $this->getSisa($item->tanggal_kadaluarsa);
        }
        return view('pages.akreditasi', compact('akreditasi'));
    }

    public function earlyWarning()
    {
        // Ambil data yang hampir kadaluarsa (misal < 90 hari) atau bisa juga semua
        $akreditasi = Akreditasi::where('tanggal_kadaluarsa', '<=', now()->addDays(90))
            ->orderBy('tanggal_kadaluarsa', 'asc')
            ->paginate(10);

        foreach ($akreditasi as $item) {
            $item->status_daluwarsa = $this->getStatus($item->tanggal_kadaluarsa);
            $item->sisa_kadaluarsa = $this->getSisa($item->tanggal_kadaluarsa);
        }

        return view('pages.early-warning-system', compact('akreditasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program'                => 'required|string',
            'program_studi'          => 'required|string',
            'nomor_sk'               => 'nullable|string',
            'tanggal_sk'             => 'nullable|date',
            'peringkat_akreditasi'   => 'nullable|string',
            'tanggal_kadaluarsa'     => 'nullable|date',
            'akreditasi_nasional'    => 'nullable|string',
            'akreditasi_internasional'=> 'nullable|string',
            'keterangan'             => 'nullable|string',
            'upcoming_ts3'           => 'nullable|date',
            'upcoming_ts2'           => 'nullable|date',
            'upcoming_ts1'           => 'nullable|date',
            'upcoming_ts'            => 'nullable|date',
            'tanggal_pendampingan'   => 'nullable|date',
            'led'                    => 'nullable|string',
            'lkpt'                   => 'nullable|string',
        ]);

        Akreditasi::create($validated);

        return redirect()->route('akreditasi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, Akreditasi $akreditasi)
    {
        $validated = $request->validate([
            'program'                => 'required|string',
            'program_studi'          => 'required|string',
            'nomor_sk'               => 'nullable|string',
            'tanggal_sk'             => 'nullable|date',
            'peringkat_akreditasi'   => 'nullable|string',
            'tanggal_kadaluarsa'     => 'nullable|date',
            'akreditasi_nasional'    => 'nullable|string',
            'akreditasi_internasional'=> 'nullable|string',
            'keterangan'             => 'nullable|string',
            'upcoming_ts3'           => 'nullable|date',
            'upcoming_ts2'           => 'nullable|date',
            'upcoming_ts1'           => 'nullable|date',
            'upcoming_ts'            => 'nullable|date',
            'tanggal_pendampingan'   => 'nullable|date',
            'led'                    => 'nullable|string',
            'lkpt'                   => 'nullable|string',
        ]);

        $akreditasi->update($validated);

        return redirect()->route('akreditasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Akreditasi $akreditasi)
    {
        $akreditasi->delete();
        return redirect()->route('akreditasi.index')->with('success', 'Data berhasil dihapus.');
    }

    // Helper untuk status daluwarsa
    private function getStatus($tanggal_kadaluarsa)
    {
        if (!$tanggal_kadaluarsa) return 'Tidak Ada';
        $now = now();
        $expiry = Carbon::parse($tanggal_kadaluarsa);
        if ($now->greaterThan($expiry)) {
            return 'Kadaluarsa';
        } elseif ($now->diffInDays($expiry) <= 30) {
            return 'Akan Kadaluarsa';
        } else {
            return 'Aktif';
        }
    }

    private function getSisa($tanggal_kadaluarsa)
    {
        if (!$tanggal_kadaluarsa) return '-';
        $now = now();
        $expiry = Carbon::parse($tanggal_kadaluarsa);
        $diff = $now->diffInDays($expiry, false);
        return $diff < 0 ? '0 Hari' : $diff . ' Hari';
    }
}