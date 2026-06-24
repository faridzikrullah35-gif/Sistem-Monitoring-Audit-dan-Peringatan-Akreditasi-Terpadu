<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use App\Models\AuditPtk;
use App\Models\FormObservasi;
use App\Models\FormTerpenuhi;
use App\Models\AuditPeriksa;
use App\Models\SettingScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CetakRekapitulasiAuditeeController extends Controller
{
    public function index()
    {
        $tahunAkademikList = TahunAkademik::where('status', 'Aktif')
            ->orderBy('tahun_akademik', 'asc')
            ->orderBy('semester', 'asc')
            ->get();

        // Change this line:
        return view('pages.cetak-rekapitulasi-auditee', compact('tahunAkademikList'));
    }

    public function getData(Request $request)
    {
        try {
            $user = auth()->user();
            $tahunAkademikId = $request->query('tahun_akademik_id');

            $defaultResponse = [
                'data'           => [],
                'categories'     => [],
                'no_dokumen'     => 'UM.BJM-LPM-FORM.DR-AMI-00',
                'tanggal_terbit' => now()->format('d F Y'),
                'no_revisi'      => '00',
            ];

            if (!$tahunAkademikId) {
                return response()->json($defaultResponse);
            }

            // Ambil audit_periksa_id berdasarkan unit/sub_unit auditee
            $auditPeriksaIds = DB::table('audit_periksa as ap')
                ->leftJoin('pertanyaan_ami_prodi as pap', 'ap.pertanyaan_ami_prodi_id', '=', 'pap.id')
                ->leftJoin('pertanyaan_ami_unit as pau', 'ap.pertanyaan_ami_unit_id', '=', 'pau.id')
                ->join('users as u', 'ap.users_id', '=', 'u.id') // auditor
                ->where('u.unit', $user->unit)
                ->where('u.sub_unit', $user->sub_unit)
                ->where(function ($q) use ($tahunAkademikId) {
                    $q->where('pap.tahun_akademik_id', $tahunAkademikId)
                    ->orWhere('pau.tahun_akademik_id', $tahunAkademikId);
                })
                ->pluck('ap.id')
                ->unique()
                ->values();

            if ($auditPeriksaIds->isEmpty()) {
                return response()->json($defaultResponse);
            }

            // Kategori temuan
            $kategoriTemuan    = SettingScore::where('generate_ncr', 1)->get();
            $listKategori      = $kategoriTemuan->pluck('keterangan');
            $kategoriObservasi = SettingScore::where('generate_ncr', 0)
                                    ->where('keterangan', 'Observasi')
                                    ->first();

            // Map audit_periksa
            $auditMap = AuditPeriksa::with(['pertanyaanAmiProdi', 'pertanyaanAmiUnit'])
                ->whereIn('id', $auditPeriksaIds)
                ->get()
                ->keyBy('id');

            // Ambil data temuan (NCR)
            $temuan = AuditPtk::with('user')
                ->whereIn('audit_periksa_id', $auditPeriksaIds)
                ->whereIn('kategori_temuan', $listKategori)
                ->get();

            // Observasi
            $observasi = $kategoriObservasi
                ? FormObservasi::with('user')->whereIn('audit_periksa_id', $auditPeriksaIds)->get()
                : collect();

            // Terpenuhi
            $terpenuhi = FormTerpenuhi::with(['pertanyaanAmiProdi', 'pertanyaanAmiUnit', 'user'])
                ->whereIn('audit_periksa_id', $auditPeriksaIds)
                ->get();

            $items = [];

            // --- TEMUAN (Mayor / Minor) ---
            foreach ($temuan as $t) {
                $ap = $auditMap[$t->audit_periksa_id] ?? null;
                $items[] = [
                    'no_ncr'               => $t->no_ncr ?? '-',
                    'tgl_audit'            => $t->created_at ? date('d F Y', strtotime($t->created_at)) : '-',
                    'bagian'               => $ap ? ($ap->pertanyaan_ami_prodi_id ? 'Program Studi' : 'Unit Kerja') : '-',
                    'macam_temuan'         => $t->kategori_temuan,
                    'uraian_temuan'        => $t->deskripsi_uraian_temuan ?? '-',
                    'tgl_target_perbaikan' => $t->tanggal_target_perbaikan_auditee ? date('d F Y', strtotime($t->tanggal_target_perbaikan_auditee)) : '-',
                    'tgl_verifikasi'       => $t->tanggal_selesai ? date('d F Y', strtotime($t->tanggal_selesai)) : '-',
                    'auditor'              => $t->user?->name ?? 'Auditor',
                    'status'               => $t->status_ncr ?? 'Open',
                    'keterangan'           => '',
                ];
            }

            // --- OBSERVASI ---
            foreach ($observasi as $obs) {
                $ap = $auditMap[$obs->audit_periksa_id] ?? null;
                $items[] = [
                    'no_ncr'               => '-',
                    'tgl_audit'            => $obs->created_at ? date('d F Y', strtotime($obs->created_at)) : '-',
                    'bagian'               => $ap ? ($ap->pertanyaan_ami_prodi_id ? 'Program Studi' : 'Unit Kerja') : '-',
                    'macam_temuan'         => 'Observasi',
                    'uraian_temuan'        => $obs->rekomendasi ?? '-',
                    'tgl_target_perbaikan' => '-',
                    'tgl_verifikasi'       => '-',
                    'auditor'              => $obs->user?->name ?? 'Auditor',
                    'status'               => '-',
                    'keterangan'           => $obs->catatan ?? '',
                ];
            }

            // --- TERPENUHI ---
            foreach ($terpenuhi as $tp) {
                $items[] = [
                    'no_ncr'               => '-',
                    'tgl_audit'            => $tp->created_at ? date('d F Y', strtotime($tp->created_at)) : '-',
                    'bagian'               => $tp->pertanyaanAmiProdi ? 'Program Studi' : 'Unit Kerja',
                    'macam_temuan'         => 'Terpenuhi',
                    'uraian_temuan'        => $tp->rekomendasi ?? '',
                    'tgl_target_perbaikan' => '-',
                    'tgl_verifikasi'       => '-',
                    'auditor'              => $tp->user?->name ?? 'Auditor',
                    'status'               => '-',
                    'keterangan'           => '',
                ];
            }

            // --- KATEGORI REKAP ---
            $categories = [];
            foreach ($kategoriTemuan as $kt) {
                $categories[] = [
                    'label' => $kt->keterangan,
                    'total' => $temuan->where('kategori_temuan', $kt->keterangan)->count(),
                    'color' => match ($kt->keterangan) {
                        'Mayor'  => 'text-red-600',
                        'Minor'  => 'text-yellow-600',
                        default  => 'text-gray-600',
                    },
                ];
            }
            if ($kategoriObservasi) {
                $categories[] = [
                    'label' => 'Observasi',
                    'total' => $observasi->count(),
                    'color' => 'text-blue-600',
                ];
            }
            $categories[] = [
                'label' => 'Terpenuhi',
                'total' => $terpenuhi->count(),
                'color' => 'text-green-600',
            ];

            return response()->json([
                'data'           => $items,
                'categories'     => $categories,
                'no_dokumen'     => $defaultResponse['no_dokumen'],
                'tanggal_terbit' => $defaultResponse['tanggal_terbit'],
                'no_revisi'      => $defaultResponse['no_revisi'],
            ]);

        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'message' => 'Internal Server Error',
                'error'   => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function print(Request $request)
    {
        $tahunAkademikId = $request->query('tahun_akademik_id');
        $tahun = TahunAkademik::find($tahunAkademikId);
        $response = $this->getData($request);
        $data = $response->getData(true);
        return view('pages.cetak-rekapitulasi-auditee-print', compact('data', 'tahun'));
    }
}