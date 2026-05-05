<?php

namespace App\Http\Controllers;
use App\Models\SettingAksesAuditor;
use App\Models\User;
use App\Models\TahunAkademik;
use App\Models\DataAuditor;
use App\Models\IsiAksesAuditor;
use Illuminate\Http\Request;

class SettingAksesAuditorController extends Controller
{
    public function index()
    {
        $akses = SettingAksesAuditor::with(['user', 'tahunAkademik'])
        ->latest()
        ->paginate(10);

        $units = User::whereIn('role', ['auditor'])
        ->orderBy('name')
        ->get();

        $tahunAkademiks = TahunAkademik::where('status', 'Aktif')
        ->orderBy('tahun_akademik', 'desc')
        ->orderBy('semester')
        ->get();

        $auditors = DataAuditor::where('status', 'aktif') // ambil auditor aktif
            ->orderBy('nama_auditor', 'asc')
            ->get();

        $isiAkses = collect();

        return view('pages.setting-akses-auditor', compact('units', 'tahunAkademiks', 'auditors', 'akses', 'isiAkses'));
    }
    
    public function getIsiAkses($id)
    {
        $data = IsiAksesAuditor::with('auditor')
            ->where('setting_akses_auditor_id', $id)
            ->get();

        return response()->json($data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'unit' => 'required|exists:users,id',
            'tahun_akademik' => 'required|exists:tahun_akademik,id',
            'tgl_audit' => 'required|date',
        ]);

        $data = SettingAksesAuditor::create([
            'user_id' => $request->unit,
            'tahun_akademik_id' => $request->tahun_akademik,
            'tgl_audit' => $request->tgl_audit,
        ]);

        return response()->json([
            'message' => 'Akses auditor berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $data = SettingAksesAuditor::findOrFail($id);

        return response()->json([
            'id' => $data->id,
            'unit_id' => $data->user_id,
            'tahun_akademik_id' => $data->tahun_akademik_id,
            'tgl_audit' => $data->tgl_audit,
        ]);
    }

    public function update(Request $request, $id)
    {
        $akses = SettingAksesAuditor::findOrFail($id);

        $request->validate([
            'unit' => 'required|exists:users,id',
            'tahun_akademik' => 'required|exists:tahun_akademik,id',
            'tgl_audit' => 'required|date',
        ]);

        $akses->update([
            'user_id' => $request->unit,
            'tahun_akademik_id' => $request->tahun_akademik,
            'tgl_audit' => $request->tgl_audit,
        ]);

        return response()->json([
            'message' => 'Akses auditor berhasil diupdate',
            'data' => $akses
        ]);
    }

    public function destroy($id)
    {
        $akses = SettingAksesAuditor::findOrFail($id);
        $akses->delete();

        return response()->json([
            'message' => 'Akses auditor berhasil dihapus'
        ]);
    }

}