<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN TERPENUHI</title>
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

        .no-border-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .no-border-table td {
            border: none;
            padding: 3px 4px;
            vertical-align: top;
            font-size: 12px;
        }
        .no-border-table .label-col {
            width: 18%;
            font-weight: bold;
        }
        .no-border-table .colon-col {
            width: 2%;
            text-align: center;
        }
        .no-border-table .value-col {
            width: 80%;
        }
        .no-border-table u {
            text-decoration: underline;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }
        .main-table th,
        .main-table td {
            border: 1px solid #000;
            padding: 4px 6px;
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

        .rich-text {
            max-width: 100%;
            word-wrap: break-word;
        }
        .rich-text p {
            margin: 0 0 4px 0;
        }
        .rich-text ul {
            list-style: disc;
            padding-left: 20px;
            margin: 4px 0;
        }
        .rich-text ol {
            list-style: decimal;
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
            margin: 8px 0 4px 0;
        }
        .rich-text h1 {
            font-size: 1.4em;
        }
        .rich-text h2 {
            font-size: 1.2em;
        }
        .rich-text h3 {
            font-size: 1.1em;
        }
        .rich-text table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
        }
        .rich-text table td,
        .rich-text table th {
            border: 1px solid #000;
            padding: 4px 6px;
        }
        .rich-text table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        @media print {
            body {
                margin: 15px;
            }
            .no-print {
                display: none;
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

    {{-- HEADER --}}
    <table class="header-table">
        <tr>
            <td class="logo-cell" rowspan="3">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" alt="Logo">
                <div style="font-size: 9px; font-weight: bold; margin-top: 3px;">
                    UNIVERSITAS MUHAMMADIYAH BANJARMASIN
                </div>
            </td>

            <th class="title" rowspan="3">
                LAPORAN TERPENUHI<br>AUDIT INTERNAL UNIT KERJA
            </th>

            <td class="meta-label">No. Dokumen</td>
            <td class="meta-val">
                {{ $noDokumen }}
            </td>
        </tr>

        <tr>
            <td class="meta-label">Tanggal Terbit</td>
            <td class="meta-val">
                {{ $tanggalTerbit }}
            </td>
        </tr>

        <tr>
            <td class="meta-label">No. Revisi</td>
            <td class="meta-val">
                {{ $noRevisi }}
            </td>
        </tr>
    </table>

    {{-- TABEL TERPENUHI (tanpa kolom Discussed with) --}}
    <table class="main-table">
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th style="width:35%;">Indikator</th>
                <th style="width:60%;">Recommendations and Improvement Suggestions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $row)
                <tr>
                    <td class="no-col">{{ $loop->iteration }}</td>
                    <td>{{ $row->indikator }}</td>
                    <td>
                        <div class="rich-text">
                            {!! $row->rekomendasi !!}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center; padding:15px;">Tidak ada data terpenuhi untuk filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TOMBOL CETAK --}}
    <div class="no-print">
        <button onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
            Cetak
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