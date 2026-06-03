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
        }

        .page {
            width: 100%;
            margin: 0 auto;
        }

        /* HEADER FORMULIR */
        .header-table {
            width: 95%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table th, .header-table td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 14px;
            font-weight: bold;
            vertical-align: middle;
            text-align: left;
        }
        .logo-cell {
            width: 80px;
            text-align: center !important;
        }
        .logo-cell img {
            height: 70px;
            width: 75px;
        }
        .title-cell {
            text-align: center !important;
            font-size: 16px;
        }

        /* LOG STATUS */
        .log-status {
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.5;
        }

        /* TABEL UTAMA */
        .main-table {
            width: 95%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .main-table th {
            border: 1px solid #000;
            padding: 10px 5px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }
        .main-table td {
            border: 1px solid #000;
            padding: 10px 5px;
            font-size: 13px; /* Ukuran pas agar muat banyak text di landscape */
            vertical-align: top;
            line-height: 1.4;
        }
        .center {
            text-align: center !important;
        }

        .label-temuan {
            font-weight: bold;
            text-decoration: underline;
            display: block;
            margin-bottom: 5px;
        }

        /* REKAP SUMMARY */
        .rekap-section {
            margin-top: 25px;
        }
        .rekap-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .rekap-table {
            width: 15%;
            border-collapse: collapse;
        }
        .rekap-table td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 14px;
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
                width: 100% !important; /* Memaksimalkan lebar kertas pas di-print */
            }
            .rekap-table {
                width: 25% !important;
            }
        }
    </style>
</head>
<body>

<div class="page">

    {{-- TOMBOL CONTROL (Hanya muncul di web, hilang saat di-print) --}}
    <div class="no-print">
        <button onclick="window.print()">Print Laporan</button>
    </div>

    {{-- HEADER FORMULIR (Sesuai Struktur Asli Universitas Muhammadiyah Banjarmasin) --}}
    <table class="header-table">
        <tr>
            <th rowspan="3" class="logo-cell">
                <img src="{{ asset('img/logo/a.png') }}" alt="Logo">
            </th>
            <td class="tg-0pky" style="width: 65%;">FORMULIR</td>
            <td class="tg-0pky" style="width: 10%;">No Dokumen</td>
            <td class="tg-0pky" style="width: 1%; text-align:center;">:</td>
            <td class="tg-0pky" style="width: 24%;">{{ $data['no_dokumen'] ?? 'UM.BJM-LPM-FORM.DR-AMI-00' }}</td>
        </tr>
        <tr>
            <td class="title-cell" rowspan="2">
                DAFTAR REKAPITULASI KETIDAKSESUAIAN DAN PERMINTAAN TINDAKAN PERBAIKAN
            </td>
            <td class="tg-0pky">Tanggal Terbit</td>
            <td class="tg-0pky" style="text-align:center;">:</td>
            <td class="tg-0pky">{{ $data['tanggal_terbit'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="tg-0pky">No. Revisi</td>
            <td class="tg-0pky" style="text-align:center;">:</td>
            <td class="tg-0pky">{{ $data['no_revisi'] ?? '00' }}</td>
        </tr>
    </table>

    {{-- LOG STATUS --}}
    <div class="log-status">
        <span style="display:block; margin-bottom: 5px;">LOG STATUS</span>
        PERIODE : {{ $tahun->nama_tahun_akademik ?? ($tahun->tahun_akademik ?? '2020/2021 Genap') }}
    </div>

    {{-- TABEL UTAMA --}}
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 5%;">No. NCR</th>
                <th style="width: 10%;">Tgl. Audit</th>
                <th style="width: 15%;">Bagian</th>
                <th style="width: 35%;">Macam Temuan</th>
                <th style="width: 10%;">Tgl. Target Perbaikan</th>
                <th style="width: 10%;">Tgl. Verifikasi</th>
                <th style="width: 12%;">Auditor</th>
                <th style="width: 5%;">Status Open/ Close</th>
                <th style="width: 15%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['data'] as $index => $item)
            @php
                $kategori = strtoupper($item['macam_temuan'] ?? '-');
            @endphp
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td class="center">{{ $item['no_ncr'] ?? '-' }}</td>
                <td class="center">{{ $item['tgl_audit'] ?? '-' }}</td>
                <td>{{ $item['bagian'] ?? '-' }}</td>
                <td>
                    <span class="label-temuan"><u>{{ $kategori }}</u></span>
                    
                    {{-- Kondisi jika Observasi, teks bagian/jabatan tampil di sini --}}
                    @if(strpos(strtolower($kategori), 'observasi') !== false)
                        <p>{{ $item['uraian_temuan_opsional'] ?? 'Ka.Prodi S1 Teknik Sipil UM Banjarmasin' }}</p>
                    @else
                        <p>{{ $item['uraian_temuan'] ?? '' }}</p>
                    @endif
                </td>
                <td class="center">{{ $item['tgl_target_perbaikan'] ?? '-' }}</td>
                <td class="center">{{ $item['tgl_verifikasi'] ?? '-' }}</td>
                <td>
                    {!! $item['auditor'] ?? 'M Fahrin Azhari, Ns, M.Kep., <b>(Lead Auditor)</b> <br> Hafizhatu Nadia., M.Pd.' !!}
                </td>
                <td class="center">
                    <b>{{ $item['status'] ?? '-' }}</b>
                </td>
                <td>
                    {{-- Kalau observasi, detail temuannya masuk ke kolom keterangan sesuai format asli PDF --}}
                    @if(strpos(strtolower($kategori), 'observasi') !== false)
                        <p>{{ $item['uraian_temuan'] ?? '' }}</p>
                    @else
                        {{ $item['keterangan'] ?? '' }}
                    @endif
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
        <div class="rekap-title">Rekap Mayor Minor Observasi</div>
        <table class="rekap-table">
            @foreach($data['categories'] as $cat)
            <tr>
                <td>Total {{ $cat['label'] }}</td>
                <td style="text-align: center; width: 30px;">:</td>
                <td class="center"><b>{{ $cat['total'] }}</b></td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

<script type="text/javascript">
    window.addEventListener('load', function () {
        // Otomatis trigger print pas load selesai
        window.print();
    });
</script>

</body>
</html>