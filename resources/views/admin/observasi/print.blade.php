<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN OBSERVASI</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
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
        .main-table th, .main-table td {
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

        /* ===== RICH TEXT STYLING UNTUK PRINT ===== */
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
        .rich-text h1, .rich-text h2, .rich-text h3, .rich-text h4, .rich-text h5, .rich-text h6 {
            font-weight: bold;
            margin: 8px 0 4px 0;
        }
        .rich-text h1 { font-size: 1.4em; }
        .rich-text h2 { font-size: 1.2em; }
        .rich-text h3 { font-size: 1.1em; }
        .rich-text table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
        }
        .rich-text table td, .rich-text table th {
            border: 1px solid #000;
            padding: 4px 6px;
        }
        .rich-text table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .rich-text br {
            display: block;
        }

        @media print {
            body { margin: 15px; }
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

    {{-- HEADER --}}
    <table class="header-table">
        <tr>
            <td class="logo-cell" rowspan="3">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" alt="Logo">
            </td>
            <th class="title" rowspan="3">
                LAPORAN OBSERVASI<br>AUDIT INTERNAL UNIT KERJA
            </th>
            <td class="meta-label">No. Dokumen</td>
            <td class="meta-val">UM.BJM-LPM-FORM.OBS-AMI-000</td>
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

    {{-- TABEL OBSERVASI --}}
    <table class="main-table">
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th style="width:25%;">Indikator</th>
                <th style="width:30%;">Discussed with</th>
                <th style="width:40%;">Recommendations and Improvement Suggestions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $row)
                <tr>
                    <td class="no-col">{{ $loop->iteration }}</td>
                    <td>{{ $row->indikator }}</td>
                    <td>
                        <div class="rich-text">
                            {!! $row->discussed_with !!}
                        </div>
                    </td>
                    <td>
                        <div class="rich-text">
                            {!! $row->rekomendasi !!}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:15px;">Tidak ada data observasi untuk filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TOMBOL CETAK --}}
    <div class="no-print">
        <button onclick="window.print()">🖨 Cetak</button>
        <button onclick="window.close()" style="background:#6b7280; margin-left:10px;">✕ Tutup</button>
    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>

</body>
</html>