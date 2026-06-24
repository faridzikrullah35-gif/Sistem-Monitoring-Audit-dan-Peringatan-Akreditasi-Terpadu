<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR PERIKSA AUDIT INTERNAL</title>
    <style>
        /* Gaya dasar untuk cetak */
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin: 30px 40px;
            line-height: 1.5;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td, .header-table th {
            border: 1px solid #000;
            padding: 8px 5px;
            vertical-align: middle;
        }
        .header-table .label {
            font-weight: bold;
            width: 12%;
        }
        .header-table .title {
            font-weight: bold;
            text-align: center;
            font-size: 16px;
        }
        .header-table .logo-cell {
            width: 10%;
            text-align: center;
        }
        .header-table .logo-cell img {
            max-height: 70px;
        }

        /* Tabel info audit tanpa border (seperti contoh) */
        .no-border-table {
            width: 100%;
            border-collapse: collapse;
        }
        .no-border-table td {
            border: none;
            padding: 4px 4px;
            vertical-align: top;
            font-size: 14px;
        }
        .no-border-table .label-col {
            width: 20%;
            font-weight: bold;
        }
        .no-border-table .colon-col {
            width: 2%;
            text-align: center;
        }
        .no-border-table .value-col {
            width: 78%;
        }
        .no-border-table u {
            text-decoration: underline;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .main-table th, .main-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
            text-align: left;
        }
        .main-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .main-table .no-col {
            width: 5%;
            text-align: center;
        }
        .main-table .skor-col {
            width: 8%;
            text-align: center;
        }

        /* Rich text styling untuk isi tabel */
        .rich-text {
            max-width: 100%;
            word-wrap: break-word;
        }
        .rich-text p {
            margin: 0 0 4px 0;
        }
        .rich-text ul, .rich-text ol {
            padding-left: 20px;
            margin: 4px 0;
        }
        .rich-text li {
            margin-bottom: 2px;
        }
        .rich-text strong { font-weight: bold; }
        .rich-text em { font-style: italic; }
        .rich-text u { text-decoration: underline; }
        .rich-text h1, .rich-text h2, .rich-text h3 {
            font-weight: bold;
            margin: 6px 0 4px 0;
        }
        .rich-text table {
            border-collapse: collapse;
            width: 100%;
            margin: 4px 0;
        }
        .rich-text table td, .rich-text table th {
            border: 1px solid #000;
            padding: 4px 6px;
        }
        .rich-text table th {
            background: #f0f0f0;
        }

        @media print {
            body { margin: 20px; }
            .no-print { display: none; }
        }
        .no-print {
            text-align: center;
            margin-top: 20px;
        }
        .no-print button {
            padding: 8px 20px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>

    {{-- ===================== HEADER FORMULIR ===================== --}}
    <table class="header-table">
        <tr>
            <td class="logo-cell" rowspan="3">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" alt="Logo">
            </td>
            <th class="title" style="width:60%;" rowspan="3">
                DAFTAR PERIKSA ATAU PERTANYAAN<br>
                AUDIT INTERNAL UNIT KERJA
            </th>
            <td class="label">No Dokumen</td>
            <td style="width:25%;">UM.BJM-LPM-FORM.DP-AMI-002</td>
        </tr>
        <tr>
            <td class="label">Tanggal Terbit</td>
            <td>{{ now()->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="label">No. Revisi</td>
            <td>00</td>
        </tr>
    </table>

    {{-- ===================== INFO AUDIT (tanpa border, pakai underline) ===================== --}}
    <table class="no-border-table" style="margin-top:15px;">
        <tr>
            <td class="label-col">Tanggal Audit</td>
            <td class="colon-col">:</td>
            <td class="value-col"><u>{{ $tanggal_audit ?? now()->format('d F Y') }}</u></td>
        </tr>
        <tr>
            <td class="label-col">Lokasi Audit/ Unit Kerja</td>
            <td class="colon-col">:</td>
            <td class="value-col"><u>{{ $lokasi_audit ?? '-' }}</u></td>
        </tr>
        <tr>
            <td class="label-col" style="vertical-align:top;">Auditor</td>
            <td class="colon-col" style="vertical-align:top;">:</td>
            <td class="value-col" style="vertical-align:top;">
                @foreach($auditors as $auditor)
                    <u>{{ $loop->iteration }}. {{ $auditor['nama'] ?? '-' }} @if(($auditor['role'] ?? '') === 'Lead Auditor') <b>(Lead Auditor)</b> @endif</u><br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="label-col" style="vertical-align:top;">Auditee</td>
            <td class="colon-col" style="vertical-align:top;">:</td>
            <td class="value-col" style="vertical-align:top;">
                @foreach($auditees as $auditee)
                    <u>{{ $loop->iteration }}. {{ $auditee->nama_auditiee ?? $auditee->nama_auditee ?? '-' }}</u><br>
                @endforeach
            </td>
        </tr>
    </table>

    {{-- ===================== TABEL UTAMA ===================== --}}
    <table class="main-table">
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th style="width:18%;">Tujuan</th>
                <th style="width:18%;">Indikator</th>
                <th style="width:30%;">Lingkup Pertanyaan</th>
                <th class="skor-col">Skor (1-4)</th>
                <th style="width:20%;">Panduan Pengisian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $row)
                <tr>
                    <td class="no-col">{{ $loop->iteration }}</td>
                    <td>
                        <div class="rich-text">{!! $row->tujuan !!}</div>
                    </td>
                    <td>
                        <div class="rich-text">{!! $row->indikator !!}</div>
                    </td>
                    <td>
                        <div class="rich-text">{!! $row->lingkup_pertanyaan !!}</div>
                    </td>
                    <td class="skor-col">{{ $row->skor }}</td>
                    <td>
                        <div class="rich-text">{!! $row->panduan !!}</div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:20px;">
                        Tidak ada data audit untuk filter yang dipilih.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ===================== CATATAN ===================== --}}
    <div style="margin-top:20px; font-size:13px;">
        <p><strong>Catatan :</strong></p>
        <ul>
            <li>Skor 4 menunjukkan kategori Conformity (Kesesuaian)</li>
            <li>Skor 3 menunjukkan kategori Observasi (Saran/ peluang perbaikan), selanjutnya hasil temuan visitasi dikonversikan ke dalam form OBSERVASI</li>
            <li>Skor 2 &amp; 1 menunjukkan kategori Non Conformity (Ketidaksesesuaian), selanjutnya hasil temuan visitasi dikonversikan ke dalam form NCR (Non Conformity/Ketidaksesuaian)</li>
        </ul>
    </div>

    {{-- ===================== TANDA TANGAN (sesuai contoh kedua) ===================== --}}
    <table style="width:100%; border-collapse:collapse; margin-top:40px;">
        <tr>
            <td style="width:50%; vertical-align:top; text-align:left; font-weight:bold;">Mengetahui,</td>
            <td style="width:50%; vertical-align:top; text-align:left; font-weight:bold;">Barito Kuala, {{ now()->format('d F Y') }}</td>
        </tr>
        <tr>
            <td style="vertical-align:top; text-align:left;">Koordinator Bidang Audit Mutu Internal</td>
            <td style="vertical-align:top; text-align:left;">Auditor Mutu Internal : Lead Auditor</td>
        </tr>
        <tr>
            <td style="height:80px;"></td>
            <td style="height:80px;"></td>
        </tr>
        <tr>
            <td style="vertical-align:top; text-align:left;">
                <u><u>{{ $kabalai->auditor->nama_auditor ?? '_________________________' }}</u></u>
            </td>
            <td style="vertical-align:top; text-align:left;">
                <u><u>{{ $leadAuditorName ?? '_________________________' }}</u></u>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top; text-align:left;">NIDN. {{ $kabalai->auditor->identity_number ?? '' }}</td>
            <td style="vertical-align:top; text-align:left;">NIDN. {{ $leadAuditorNidn ?? '' }}</td>
        </tr>
    </table>

    {{-- Menyetujui --}}
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr>
            <td style="text-align:center; font-weight:bold;">Menyetujui,</td>
        </tr>
        <tr>
            <td style="text-align:center;">Kepala Lembaga Penjaminan Mutu</td>
        </tr>
        <tr>
            <td style="height:80px;"></td>
        </tr>
        <tr>
            <td style="text-align:center;">
                <u><u>{{ $kepalaLPM->auditor->nama_auditor ?? '_________________________' }}</u></u>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;">NIDN. {{ $kepalaLPM->auditor->identity_number ?? '' }}</td>
        </tr>
    </table>

    {{-- ===================== TOMBOL CETAK ===================== --}}
    <div class="no-print" style="text-align:center; margin-top:20px;">
        <button onclick="window.print()" style="padding:8px 20px; background:#2563eb; color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:14px; display:inline-flex; align-items:center; gap:6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
            Cetak / Print
        </button>
        <button onclick="window.close()" style="padding:8px 20px; background:#6b7280; color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:14px; margin-left:10px; display:inline-flex; align-items:center; gap:6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854z"/>
            </svg>
            Tutup
        </button>
    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>

</body>
</html>