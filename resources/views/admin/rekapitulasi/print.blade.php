<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DAFTAR REKAPITULASI KETIDAKSESUAIAN DAN PERMINTAAN TINDAKAN PERBAIKAN</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background: #fff;
            padding: 10mm;
            line-height: 1.3;
        }

        .page {
            width: 100%;
            margin: 0 auto;
        }

        /* HEADER FORMULIR */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed; /* Mengunci lebar kolom header */
        }
        .header-table th, .header-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 13px;
            font-weight: bold;
            vertical-align: middle;
            text-align: left;
        }
        .logo-cell {
            width: 10%;
            text-align: center !important;
        }
        .logo-cell img {
            height: 60px;
            width: auto;
            object-fit: contain;
        }
        .title-cell {
            text-align: center !important;
            font-size: 14px;
            padding: 10px !important;
        }

        /* LOG STATUS */
        .log-status {
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: bold;
            line-height: 1.4;
        }

        /* TABEL UTAMA */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed; /* Mencegah kolom bergeser/melebar otomatis */
            word-wrap: break-word;
        }
        .main-table th {
            border: 1px solid #000;
            padding: 8px 4px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            background-color: #f3f4f6; /* Warna latar tipis untuk header tabel */
        }
        .main-table td {
            border: 1px solid #000;
            padding: 8px 6px;
            font-size: 11px;
            vertical-align: top;
            line-height: 1.4;
        }
        
        /* Mencegah baris tabel terpotong di tengah halaman saat print */
        .main-table tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .center {
            text-align: center !important;
        }

        /* Badge/Label kategori temuan agar rapi */
        .label-temuan {
            font-weight: bold;
            font-size: 11px;
            display: inline-block;
            border: 1px solid #000;
            padding: 1px 4px;
            margin-bottom: 5px;
            background-color: #eaeaea;
        }

        /* ===== RICH TEXT STYLING ===== */
        .content-rich {
            margin-top: 3px;
        }
        .content-rich ol,
        .content-rich ul {
            padding-left: 15px;
            margin: 3px 0;
        }
        .content-rich ol li,
        .content-rich ul li {
            margin-bottom: 2px;
            line-height: 1.4;
        }
        .content-rich p {
            margin: 3px 0;
            line-height: 1.4;
        }

        /* REKAP SUMMARY */
        .rekap-section {
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .rekap-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .rekap-table {
            width: 25%;
            border-collapse: collapse;
        }
        .rekap-table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 12px;
        }

        /* BUTTON PRINT CONTROL */
        .no-print {
            margin-bottom: 15px;
            display: flex;
            gap: 8px;
        }
        .no-print button {
            padding: 8px 16px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            cursor: pointer;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 4px;
        }
        .no-print button.btn-back {
            background: #6b7280;
        }

        /* CONFIG PRINT */
        @media print {
            @page { 
                size: landscape; 
                margin: 10mm;
            }
            body { 
                padding: 0;
            }
            .no-print { 
                display: none !important; 
            }
            .main-table, .header-table, .rekap-table { 
                width: 100% !important;
            }
            .rekap-table {
                width: 30% !important;
            }
        }
    </style>
</head>
<body>

<div class="page">

    {{-- TOMBOL CONTROL --}}
    <div class="no-print">
        <button onclick="window.print()">🖨 Print Laporan</button>
        <button class="btn-back" onclick="window.close()">✕ Tutup</button>
    </div>

    {{-- HEADER FORMULIR --}}
    <table class="header-table">
        <tr>
            <th rowspan="3" class="logo-cell">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" alt="Logo">
            </th>
            <td style="width: 50%; font-size: 14px; letter-spacing: 1px;">FORMULIR<br></td>
            <td style="width: 12%;">No Dokumen</td>
            <td style="width: 1%; text-align:center;">:</td>
            <td style="width: 27%;">UM.BJM-LPM-FORM.DR-AMI-00</td>
        </tr>
        <tr>
            <td class="title-cell" rowspan="2">
                DAFTAR REKAPITULASI KETIDAKSESUAIAN DAN PERMINTAAN TINDAKAN PERBAIKAN
            </td>
            <td>Tanggal Terbit</td>
            <td style="text-align:center;">:</td>
            <td>{{ now()->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>No. Revisi</td>
            <td style="text-align:center;">:</td>
            <td>00</td>
        </tr>
    </table>

    {{-- LOG STATUS --}}
    <div class="log-status">
        <span style="display:block; margin-bottom: 3px;">LOG STATUS</span>
        PERIODE : {{ $tahunNama }}
    </div>

    {{-- TABEL UTAMA --}}
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 7%;">No. NCR</th>
                <th style="width: 10%;">Tgl. Audit</th>
                <th style="width: 14%;">Bagian</th>
                <th style="width: 32%;">Macam Temuan / Deskripsi</th>
                <th style="width: 10%;">Tgl. Target Perbaikan</th>
                <th style="width: 10%;">Tgl. Verifikasi</th>
                <th style="width: 15%;">Auditor</th>
                <th style="width: 6%;">Status Open/ Close</th>
                <th style="width: 12%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['items'] as $index => $item)
            @php
                $kategori = strtoupper($item['macam_temuan'] ?? '-');
            @endphp
            <tr>
                <td class="center">{{ $loop->iteration }}</td>
                <td class="center" style="font-weight: bold;">{{ $item['no_ncr'] ?? '-' }}</td>
                <td class="center">{{ $item['tgl_audit'] ?? '-' }}</td>
                <td>{{ $item['bagian'] ?? '-' }}</td>

                {{-- ========== KOLOM MACAM TEMUAN ========== --}}
                <td>
                    <strong><u>{{ $kategori }}</u></strong>
                    <div class="content-rich">
                        {!! $item['uraian_temuan'] ?? '' !!}
                    </div>
                </td>

                <td class="center">{{ $item['tgl_target_perbaikan'] ?? '-' }}</td>
                <td class="center">{{ $item['tgl_verifikasi'] ?? '-' }}</td>
                <td>{!! nl2br(e($item['auditor'])) !!}</td>
                <td class="center">
                    <span style="font-weight: bold;">
                        {{ $item['status'] ?? '-' }}
                    </span>
                </td>

                {{-- ========== KOLOM KETERANGAN ========== --}}
                <td>
                    {!! $item['keterangan'] ?? '' !!}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="center" style="padding:20px; font-style:italic;">
                    Tidak ada data temuan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- REKAP SUMMARY --}}
    <div class="rekap-section">
        <div class="rekap-title">Rekap Kategori Temuan</div>
        <table class="rekap-table">
            @foreach($data['categories'] as $cat)
            <tr>
                <td>Total {{ $cat['label'] }}</td>
                <td style="text-align: center; width: 20px;">:</td>
                <td class="center"><b>{{ $cat['total'] }}</b></td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

<script>
    window.addEventListener('load', function () {
        // Menunda eksekusi print sebentar agar browser selesai merender style layout kaku
        setTimeout(function() {
            window.print();
        }, 500);
    });
</script>

</body>
</html>