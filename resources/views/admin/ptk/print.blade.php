<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN KETIDAKSESUAIAN (NCR)</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
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
        .header-table td, .header-table th {
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
        .content-table td, .content-table th {
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

        @media print {
            body { margin: 15px; }
            .no-print { display: none; }
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
                FORMULIR<br>LAPORAN KETIDAKSESUAIAN (NCR)
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

                {{-- URAIAN KETIDAKSESUAIAN --}}
                <tr>
                    <td colspan="4" class="bg-light" style="text-transform: uppercase;">Uraian Ketidaksesuaian</td>
                </tr>
                <tr>
                    <td colspan="4" style="min-height: 80px; padding-bottom: 20px;">
                        <div style="float: right; font-weight: bold; border: 1px solid #000; padding: 3px 8px; font-size: 11px;">
                            KATEGORI TEMUAN: {{ strtoupper($row->status_kategori) }}
                        </div>
                        <div style="clear: both; margin-top: 5px;">
                            {!! $row->macam_temuan !!}
                        </div>
                    </td>
                </tr>

                {{-- FAKTOR PENYEBAB & TINDAKAN KOREKSI --}}
                <tr>
                    <td colspan="2" class="bg-light" style="width: 50%;">URAIAN FAKTOR PENYEBAB KETIDAKSESUAIAN:</td>
                    <td colspan="2" class="bg-light" style="width: 50%;">TINDAKAN KOREKSI:</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 90px;">
                        {{ $row->faktor_penyebab }}
                    </td>
                    <td colspan="2">
                        {{ $row->tindakan_koreksi }}
                        <div style="margin-top: 25px; font-size: 11px; font-weight: bold;">
                            Tanggal Target Perbaikan: <span style="text-decoration: underline;">{{ $row->tanggal_target }}</span>
                        </div>
                    </td>
                </tr>

                {{-- TINDAKAN PENCEGAHAN --}}
                <tr>
                    <td colspan="4" class="bg-light">TINDAKAN PENCEGAHAN:</td>
                </tr>
                <tr>
                    <td colspan="4" style="height: 70px;">
                        {{ $row->tindakan_pencegahan }}
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
        <div style="text-align:center; padding:50px; border: 1px dashed #ccc; font-family: sans-serif;">
            <h3>Tidak ada data Laporan Ketidaksesuaian (NCR) yang tersedia.</h3>
        </div>
    @endforelse

    {{-- TOMBOL CETAK --}}
    <div class="no-print">
        <button onclick="window.print()">🖨 Cetak Dokumen NCR</button>
        <button onclick="window.close()" style="background:#6b7280; margin-left:10px;">✕ Tutup</button>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>