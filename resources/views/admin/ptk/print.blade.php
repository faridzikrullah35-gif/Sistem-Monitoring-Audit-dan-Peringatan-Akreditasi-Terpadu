<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN KETIDAKSESUAIAN (PTK)</title>
    <style type="text/css">
        /* ===== GLOBAL FONT ===== */
        * {
            font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            margin: 20px;
            padding: 0;
            background: #fff;
            color: #1a1a1a;
        }

        /* ===== TABEL UTAMA ===== */
        .table-main {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            font-size: 13px;
        }

        .table-main td,
        .table-main th {
            border: 1px solid #000;
            padding: 8px 10px;
            vertical-align: top;
            line-height: 1.5;
        }

        .table-main .label {
            font-weight: 700;
            width: 15%;
        }

        .table-main .colon {
            width: 1%;
            text-align: center;
            font-weight: 700;
        }

        .table-main .value {
            width: 34%;
        }

        /* ===== HEADER FORM ===== */
        .table-header {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .table-header td,
        .table-header th {
            border: 1px solid #000;
            padding: 8px 10px;
            vertical-align: middle;
            line-height: 1.5;
        }

        .table-header .header-title {
            font-weight: 700;
            font-size: 16px;
            text-align: center;
            letter-spacing: 1px;
        }

        .table-header .label-doc {
            font-weight: 700;
            text-align: center;
            width: 15%;
        }

        .table-header .value-doc {
            width: 40%;
            padding: 8px 12px;
        }

        .table-header .logo-cell {
            text-align: center;
            vertical-align: middle;
            width: 15%;
        }

        .table-header .logo-cell img {
            max-height: 70px;
            width: auto;
        }

        /* ===== RICH TEXT ===== */
        .rich-text p {
            margin: 0 0 4px 0;
        }
        .rich-text ul,
        .rich-text ol {
            margin: 0 0 4px 0;
            padding-left: 20px;
        }
        .rich-text li {
            margin-bottom: 2px;
        }
        .rich-text strong {
            font-weight: 700;
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
            font-weight: 700;
            margin: 4px 0;
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
        .rich-text {
            word-wrap: break-word;
            white-space: normal;
        }

        /* ===== PAGE BREAK ===== */
        .page-break {
            page-break-before: always;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px dashed #ccc;
        }

        .page-break:first-of-type {
            page-break-before: auto;
            border-top: none;
            margin-top: 0;
            padding-top: 0;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            font-size: 16px;
            color: #6c757d;
        }

        /* ===== NO PRINT (Tombol) ===== */
        .no-print {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
        }

        .no-print button {
            padding: 10px 24px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 8px;
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

        /* ===== PRINT STYLE ===== */
        @media print {
            body {
                margin: 10px 15px;
                padding: 0;
            }

            .table-main td,
            .table-main th,
            .table-header td,
            .table-header th {
                padding: 6px 8px;
                font-size: 12px;
            }

            .table-header .header-title {
                font-size: 14px;
            }

            .page-break {
                page-break-before: always;
                border-top: none;
                margin-top: 0;
                padding-top: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    @php
        $noDokumen = 'UM.BJM-LPM-FORM.NCR-AMI-000';
        $tanggalTerbit = now()->format('d-m-Y');
        $revisi = '00';
    @endphp

    {{-- ============================================================ --}}
    {{-- HEADER FORM --}}
    {{-- ============================================================ --}}
    <table class="table-header">
        <tr>
            <td class="logo-cell" rowspan="4">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" alt="Logo">
            </td>
            <td class="header-title" colspan="3">
                FORMULIR LAPORAN KETIDAKSESUAIAN (PTK)
            </td>
        </tr>
        <tr>
            <td class="label-doc">No Dokumen</td>
            <td style="width:2%; text-align:center; font-weight:700; padding:8px 2px;">:</td>
            <td class="value-doc">{{ $noDokumen }}</td>
        </tr>
        <tr>
            <td class="label-doc">Tanggal Terbit</td>
            <td style="width:2%; text-align:center; font-weight:700; padding:8px 2px;">:</td>
            <td class="value-doc">{{ $tanggalTerbit }}</td>
        </tr>
        <tr>
            <td class="label-doc">No. Revisi</td>
            <td style="width:2%; text-align:center; font-weight:700; padding:8px 2px;">:</td>
            <td class="value-doc">{{ $revisi }}</td>
        </tr>
    </table>

    {{-- ============================================================ --}}
    {{-- LOOP NCR ITEMS --}}
    {{-- ============================================================ --}}
    @foreach($items as $index => $row)
        <div class="{{ $loop->first ? '' : 'page-break' }}">
            <table class="table-main">
                {{-- BARIS 1: No NCR & Tanggal Audit --}}
                <tr>
                    <td class="label"><b>No NCR</b></td>
                    <td class="colon">:</td>
                    <td class="value"><b>{{ $row->no_ncr ?? '-' }}</b></td>
                    <td class="label"><b>Tanggal Audit</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $row->tanggal_audit ?? '-' }}</td>
                </tr>

                {{-- BARIS 2: Klausul/Dokumen & Divisi/Lokasi --}}
                <tr>
                    <td class="label"><b>Klausul/Dokumen</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $row->klausul ?? '-' }}</td>
                    <td class="label"><b>Divisi/Lokasi</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $row->bagian ?? '-' }}</td>
                </tr>

                {{-- BARIS 3: Auditor & Auditee --}}
                <tr>
                    <td class="label" style="vertical-align:top;"><b>Auditor</b></td>
                    <td class="colon" style="vertical-align:top;">:</td>
                    <td style="vertical-align:top;">{{ $row->auditor ?? '-' }}</td>
                    <td class="label" style="vertical-align:top;"><b>Auditee</b></td>
                    <td class="colon" style="vertical-align:top;">:</td>
                    <td style="vertical-align:top;">{{ $row->auditee ?? '-' }}</td>
                </tr>

                {{-- BARIS 4: Uraian Ketidaksesuaian & Kategori Temuan --}}
                <tr>
                    <td colspan="3" style="padding:10px; vertical-align:top;">
                        <b>URAIAN KETIDAKSESUAIAN</b><br>
                        @if($row->macam_temuan)
                            <div class="rich-text">{!! $row->macam_temuan !!}</div>
                        @else
                            -
                        @endif
                    </td>
                    <td colspan="3" style="padding:10px; vertical-align:top;">
                        <b>KATEGORI TEMUAN :</b>
                        <b>{{ strtoupper($row->status_kategori ?? '-') }}</b>
                    </td>
                </tr>

                {{-- BARIS 5: Faktor Penyebab & Tindakan Koreksi --}}
                <tr>
                    <td colspan="3" style="padding:10px; vertical-align:top;">
                        <b>URAIAN FAKTOR PENYEBAB KETIDAKSESUAIAN :</b><br>
                        @if($row->faktor_penyebab)
                            <div class="rich-text">{!! $row->faktor_penyebab !!}</div>
                        @else
                            -
                        @endif
                    </td>
                    <td colspan="3" style="padding:10px; vertical-align:top;">
                        <b>TINDAKAN KOREKSI :</b><br>
                        @if($row->tindakan_koreksi)
                            <div class="rich-text">{!! $row->tindakan_koreksi !!}</div>
                        @else
                            -
                        @endif
                        <br>
                        <b>Tanggal Target Perbaikan :</b><br>
                        {{ $row->tanggal_target ?? '-' }}
                    </td>
                </tr>

                {{-- BARIS 6: Tindakan Pencegahan --}}
                <tr>
                    <td colspan="6" style="padding:10px; vertical-align:top;">
                        <b>TINDAKAN PENCEGAHAN :</b><br>
                        @if($row->tindakan_pencegahan)
                            <div class="rich-text">{!! $row->tindakan_pencegahan !!}</div>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                {{-- BARIS 7: Status --}}
                <tr>
                    <td class="label"><b>Status</b></td>
                    <td class="colon">:</td>
                    <td class="value" colspan="4">
                        <b>{{ $row->status ?? '-' }}</b>
                    </td>
                </tr>

                {{-- BARIS 8: Tanda Tangan Auditee --}}
                <tr>
                    <td colspan="6" style="padding:10px; text-align:center; vertical-align:middle;">
                        <b>Auditee</b>
                        <br><br><br><br>
                        <span style="text-decoration:underline;">(............................................)</span>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach

    {{-- ============================================================ --}}
    {{-- EMPTY STATE --}}
    {{-- ============================================================ --}}
    @if($items->isEmpty())
        <div class="empty-state">
            <p>Tidak ada data NCR untuk tahun akademik yang dipilih.</p>
        </div>
    @endif

    {{-- ============================================================ --}}
    {{-- TOMBOL CETAK & TUTUP --}}
    {{-- ============================================================ --}}
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

    {{-- ============================================================ --}}
    {{-- AUTO PRINT --}}
    {{-- ============================================================ --}}
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>

</body>
</html>