<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use App\Models\AuditPtk;
use App\Models\FormObservasi;
use App\Models\AuditPeriksa;
use App\Models\SettingScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CetakRekapitulasiController extends Controller
{
    public function index()
    {
        $tahunAkademikList = TahunAkademik::orderBy('id', 'desc')->get();
        return view('pages.cetak-rekapitulasi-AMI', compact('tahunAkademikList'));
    }

    public function getData(Request $request)
    {
        $tahunAkademikId = $request->query('tahun_akademik_id');
        
        $defaultResponse = [
            'data' => [],
            'categories' => [],
            'no_dokumen' => 'UM.BJM-LPM-FORM.DR-AMI-00',
            'tanggal_terbit' => date('d F Y'),
            'no_revisi' => '00',
        ];

        if (!$tahunAkademikId) {
            return response()->json($defaultResponse);
        }

        // Ambil audit_periksa_id yang terhubung ke tahun akademik
        $auditPeriksaIds = DB::table('audit_periksa as ap')
            ->leftJoin('pertanyaan_ami_prodi as pap', 'ap.pertanyaan_ami_prodi_id', '=', 'pap.id')
            ->leftJoin('pertanyaan_ami_unit as pau', 'ap.pertanyaan_ami_unit_id', '=', 'pau.id')
            ->where(function($q) use ($tahunAkademikId) {
                $q->where('pap.tahun_akademik_id', $tahunAkademikId)
                  ->orWhere('pau.tahun_akademik_id', $tahunAkademikId);
            })
            ->select('ap.id')
            ->pluck('id');

        if ($auditPeriksaIds->isEmpty()) {
            return response()->json($defaultResponse);
        }

        // Kategori temuan dari setting_scores
        $kategoriTemuan = SettingScore::where('generate_ncr', 1)->get();
        $listKategoriTemuan = $kategoriTemuan->pluck('keterangan')->toArray();
        
        $kategoriObservasi = SettingScore::where('generate_ncr', 0)
            ->where('keterangan', 'Observasi')
            ->first();

        // Data temuan
        $temuan = AuditPtk::whereIn('audit_periksa_id', $auditPeriksaIds)
            ->whereIn('kategori_temuan', $listKategoriTemuan)
            ->get();

        // Data observasi (gunakan FormObservasi sesuai model Anda)
        $observasi = collect();
        if ($kategoriObservasi) {
            $observasi = FormObservasi::whereIn('audit_periksa_id', $auditPeriksaIds)->get();
        }

        // Format items
        $items = [];
        foreach ($temuan as $t) {
            $ap = AuditPeriksa::find($t->audit_periksa_id);
            $items[] = [
                'no_ncr' => $t->no_ncr ?? '-',
                'tgl_audit' => $t->created_at ? $t->created_at->format('d F Y') : '-',
                'bagian' => $ap ? ($ap->pertanyaan_ami_prodi_id ? 'Program Studi' : 'Unit Kerja') : '-',
                'macam_temuan' => $t->kategori_temuan,
                'uraian_temuan' => $t->deskripsi_uraian_temuan ?? ($ap->uraian_temuan ?? ''),
                'tgl_target_perbaikan' => $t->tanggal_target_perbaikan_auditee ? date('d F Y', strtotime($t->tanggal_target_perbaikan_auditee)) : '-',
                'tgl_verifikasi' => $t->tanggal_selesai ? date('d F Y', strtotime($t->tanggal_selesai)) : '-',
                'auditor' => User::find($t->users_id)?->name ?? 'Auditor',
                'status' => $t->status_ncr ?? 'Open',
                'keterangan' => '',
            ];
        }

        foreach ($observasi as $obs) {
            $ap = AuditPeriksa::find($obs->audit_periksa_id);
            $items[] = [
                'no_ncr' => '-',
                'tgl_audit' => $obs->created_at ? $obs->created_at->format('d F Y') : '-',
                'bagian' => $ap ? ($ap->pertanyaan_ami_prodi_id ? 'Program Studi' : 'Unit Kerja') : '-',
                'macam_temuan' => 'Observasi',
                'uraian_temuan' => $obs->rekomendasi ?? ($obs->discussed_with ?? ''),
                'tgl_target_perbaikan' => '-',
                'tgl_verifikasi' => '-',
                'auditor' => User::find($obs->users_id)?->name ?? 'Auditor',
                'status' => '-',
                'keterangan' => $obs->catatan ?? '',
            ];
        }

        // Hitung rekap kategori
        $categories = [];
        $warna = ['Mayor' => 'text-red-600', 'Minor' => 'text-yellow-600', 'Observasi' => 'text-blue-600'];
        
        foreach ($kategoriTemuan as $kt) {
            $categories[] = [
                'label' => $kt->keterangan,
                'total' => $temuan->where('kategori_temuan', $kt->keterangan)->count(),
                'color' => $warna[$kt->keterangan] ?? 'text-gray-600',
            ];
        }
        
        if ($kategoriObservasi) {
            $categories[] = [
                'label' => 'Observasi',
                'total' => $observasi->count(),
                'color' => 'text-blue-600',
            ];
        }

        return response()->json([
            'data' => $items,
            'categories' => $categories,
            'no_dokumen' => 'UM.BJM-LPM-FORM.DR-AMI-00',
            'tanggal_terbit' => date('d F Y'),
            'no_revisi' => '00',
        ]);
    }

    public function print(Request $request)
    {
        $tahunAkademikId = $request->query('tahun_akademik_id');
        $tahun = TahunAkademik::find($tahunAkademikId);
        $response = $this->getData($request);
        $data = $response->getData(true);
        return view('pages.cetak-rekapitulasi-AMI-print', compact('data', 'tahun'));
    }
}