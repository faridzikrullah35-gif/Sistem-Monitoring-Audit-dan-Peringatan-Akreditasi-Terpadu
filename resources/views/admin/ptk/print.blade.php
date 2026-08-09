<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN KETIDAKSESUAIAN (PTK)</title>
    <style>
        /* ===== GLOBAL FONT: Aptos Display ===== */
        * {
            font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            font-size: 13px;
            margin: 20px;
            line-height: 1.4;
            color: #000;
        }

        .ncr-container {
            width: 100%;
            margin-bottom: 40px;
        }

        /* Header Table Style */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .header-table td,
        .header-table th {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }
        .header-table .title {
            font-weight: bold;
            text-align: center;
            font-size: 15px;
            text-transform: uppercase;
        }
        .header-table .logo-cell {
            width: 15%;
            text-align: center;
        }
        .header-table .logo-cell img {
            max-height: 60px;
        }
        .header-table .meta-label {
            font-size: 11px;
            width: 15%;
        }
        .header-table .meta-val {
            font-size: 11px;
            width: 25%;
        }

        /* Body Content Table Style */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
        }
        .content-table td,
        .content-table th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .bg-light {
            background-color: #f3f4f6;
            font-weight: bold;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding: 0 10px;
        }
        .sig-box {
            text-align: center;
            width: 200px;
        }
        .sig-space {
            height: 50px;
        }

        /* ===== Rich text styling ===== */
        .rich-text {
            max-width: 100%;
            word-wrap: break-word;
        }
        .rich-text p {
            margin: 0 0 4px 0;
        }
        .rich-text ul,
        .rich-text ol {
            padding-left: 20px;
            margin: 4px 0;
        }
        .rich-text li {
            margin-bottom: 2px;
        }
        .rich-text strong {
            font-weight: bold;
        }
        .rich-text em {
            font-style: italic;
        }
        .rich-text u {
            text-decoration: underline;
        }
        .rich-text h1,
        .rich-text h2,
        .rich-text h3 {
            font-weight: bold;
            margin: 6px 0 4px 0;
        }
        .rich-text table {
            border-collapse: collapse;
            width: 100%;
            margin: 4px 0;
        }
        .rich-text table td,
        .rich-text table th {
            border: 1px solid #000;
            padding: 4px 6px;
        }
        .rich-text table th {
            background: #f0f0f0;
        }

        @media print {
            body {
                margin: 15px;
            }
            .no-print {
                display: none;
            }
            .page-break {
                page-break-after: always;
            }
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
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .no-print button:hover {
            background: #1d4ed8;
        }
        .no-print button:last-child {
            background: #6b7280;
        }
        .no-print button:last-child:hover {
            background: #4b5563;
        }
    </style>
</head>
<body>

    {{-- ==================== HEADER (SEKALI) ==================== --}}
    <table class="header-table">
        <tr>
            <td class="logo-cell" rowspan="3">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" alt="Logo">
                <div style="font-size: 9px; font-weight: bold; margin-top: 3px;">UNIVERSITAS MUHAMMADIYAH BANJARMASIN</div>
            </td>
            <th class="title" rowspan="3">
                FORMULIR<br>LAPORAN KETIDAKSESUAIAN (PTK)
            </th>
            <td class="meta-label">No. Dokumen</td>
            <td class="meta-val">UM.BJM-LPM-FORM.NCR-AMI-000</td>
        </tr>
        <tr>
            <td class="meta-label">Tanggal Terbit</td>
            <td class="meta-val">{{ now()->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="meta-label">No. Revisi</td>
            <td class="meta-val">00</td>
        </tr>
    </table>

    {{-- ==================== LOOP PER NCR ==================== --}}
    @forelse($items as $index => $row)
        <div class="ncr-container {{ !$loop->last ? 'page-break' : '' }}">

            {{-- Content NCR --}}
            <table class="content-table">
                <tr>
                    <td style="width: 15%; font-weight: bold;">No NCR</td>
                    <td style="width: 35%;">: {{ $row->no_ncr }}</td>
                    <td style="width: 15%; font-weight: bold;">Tanggal Audit</td>
                    <td style="width: 35%;">: {{ $row->tanggal_audit }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Klausul/Dokumen</td>
                    <td>: {{ $row->klausul }}</td>
                    <td style="font-weight: bold;">Divisi/Lokasi</td>
                    <td>: {{ $row->bagian }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Auditor</td>
                    <td>: {{ $row->auditor }}</td>
                    <td style="font-weight: bold;">Auditee</td>
                    <td>: {{ $row->auditee }}</td>
                </tr>

                {{-- ===== URAIAN KETIDAKSESUAIAN (Rich Text) ===== --}}
                <tr>
                    <td colspan="4" class="bg-light" style="text-transform: uppercase;">Uraian Ketidaksesuaian</td>
                </tr>
                <tr>
                    <td colspan="4" style="min-height: 80px; padding-bottom: 20px;">
                        <div style="float: right; font-weight: bold; border: 1px solid #000; padding: 3px 8px; font-size: 11px;">
                            KATEGORI TEMUAN: {{ strtoupper($row->status_kategori) }}
                        </div>
                        <div style="clear: both; margin-top: 5px;">
                            @if($row->macam_temuan)
                                <div class="rich-text">{!! $row->macam_temuan !!}</div>
                            @else
                                -
                            @endif
                        </div>
                    </td>
                </tr>

                {{-- ===== FAKTOR PENYEBAB & TINDAKAN KOREKSI (Rich Text) ===== --}}
                <tr>
                    <td colspan="2" class="bg-light" style="width: 50%;">URAIAN FAKTOR PENYEBAB KETIDAKSESUAIAN:</td>
                    <td colspan="2" class="bg-light" style="width: 50%;">TINDAKAN KOREKSI:</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 90px;">
                        @if($row->faktor_penyebab)
                            <div class="rich-text">{!! $row->faktor_penyebab !!}</div>
                        @else
                            -
                        @endif
                    </td>
                    <td colspan="2">
                        @if($row->tindakan_koreksi)
                            <div class="rich-text">{!! $row->tindakan_koreksi !!}</div>
                        @else
                            -
                        @endif
                        <div style="margin-top: 25px; font-size: 11px; font-weight: bold;">
                            Tanggal Target Perbaikan: <span style="text-decoration: underline;">{{ $row->tanggal_target }}</span>
                        </div>
                    </td>
                </tr>

                {{-- ===== TINDAKAN PENCEGAHAN (Rich Text) ===== --}}
                <tr>
                    <td colspan="4" class="bg-light">TINDAKAN PENCEGAHAN:</td>
                </tr>
                <tr>
                    <td colspan="4" style="height: 70px;">
                        @if($row->tindakan_pencegahan)
                            <div class="rich-text">{!! $row->tindakan_pencegahan !!}</div>
                        @else
                            -
                        @endif
                        <div style="margin-top: 15px; font-size: 11px;">
                            <strong>Tanggal Verifikasi:</strong> {{ $row->tanggal_verifikasi ?? '-' }}
                        </div>
                    </td>
                </tr>

                {{-- VERIFIKASI AKHIR & TANDA TANGAN --}}
                <tr>
                    <td colspan="4" class="bg-light" style="text-align: center; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">
                        Verifikasi Pelaksanaan Tindakan Koreksi dan Pencegahan
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="margin-bottom: 35px;">
                            <strong>Status Saat Ini:</strong> <span style="text-transform: uppercase; font-weight: bold;">{{ $row->status }}</span>
                        </div>

                        <div class="signature-section">
                            <div class="sig-box">
                                <div>Auditor,</div>
                                <div class="sig-space"></div>
                                <div style="text-decoration: underline; font-weight: bold;">(............................................)</div>
                            </div>
                            <div class="sig-box">
                                <div>Auditee,</div>
                                <div class="sig-space"></div>
                                <div style="text-decoration: underline; font-weight: bold;">(............................................)</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    @empty
        <div style="text-align:center; padding:50px; border: 1px dashed #ccc;">
            <h3>Tidak ada data Laporan Ketidaksesuaian (PTK) yang tersedia.</h3>
        </div>
    @endforelse

    {{-- TOMBOL CETAK --}}
    <div class="no-print">
        <button onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
            Cetak Dokumen PTK
        </button>
        <button onclick="window.close()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854z"/>
            </svg>
            Tutup
        </button>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>