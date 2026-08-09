<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN KETIDAKSESUAIAN (PTK) - prodi</title>
    <style>
        /* ===== GLOBAL FONT: Aptos Display ===== */
        * {
            font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-size: 12px;
            margin: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }
        .header-table td,
        .header-table th {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
        }
        .header-table th {
            font-weight: bold;
            text-align: center;
        }

        .ncr-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .ncr-table td,
        .ncr-table th {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }
        .ncr-table .label {
            font-weight: bold;
            white-space: nowrap;
        }
        .ncr-table .value {
            font-weight: normal;
        }

        .center {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
        .ttd-space {
            height: 40px;
        }
        .small-text {
            font-size: 10px;
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
            margin: 4px 0;
        }
        .rich-text table {
            border-collapse: collapse;
            width: 100%;
            margin: 4px 0;
        }
        .rich-text table td,
        .rich-text table th {
            border: 1px solid black;
            padding: 4px;
        }
        .rich-text {
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
</head>
<body>
    <div class="container">

        {{-- HEADER FORMULIR --}}
        <table class="header-table">
            <tr>
                <td rowspan="3" style="width: 80px; text-align: center;">
                    <img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75">
                </td>
                <th style="width: 60%;">FORMULIR</th>
                <td style="width: 12%;">No Dokumen</td>
                <td style="width: 1%;">:</td>
                <td style="width: 25%;">UM.BJM-LPM-FORM.NCR-AMI-000</td>
            </tr>
            <tr>
                <td rowspan="2" style="text-align: center; font-weight: bold; font-size: 14px;">
                    LAPORAN KETIDAKSESUAIAN (PTK)
                </td>
                <td>Tanggal Terbit</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>No. Revisi</td>
                <td>:</td>
                <td>00</td>
            </tr>
        </table>

        {{-- LOOP SETIAP NCR --}}
        @forelse ($ptkList as $index => $item)
            <table class="ncr-table">
                {{-- Baris 1: No NCR & Tanggal --}}
                <tr>
                    <td class="label" style="width: 12%;">No NCR</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 25%;">{{ $item->no_ncr ?? '-' }}</td>
                    <td class="label" style="width: 12%;">Tanggal</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 25%;">
                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') : '-' }}
                    </td>
                </tr>
                {{-- Baris 2: Klausul & Divisi/Lokasi --}}
                <tr>
                    <td class="label">Klausul/Dokumen</td>
                    <td>:</td>
                    <td>{{ $item->klausul_dokumen ?? '-' }}</td>
                    <td class="label">Divisi/Lokasi</td>
                    <td>:</td>
                    <td>
                        {{ $item->user->unit ?? '' }} {{ $item->user->sub_unit ?? '' }}
                    </td>
                </tr>
                {{-- Baris 3: Auditor & Auditee --}}
                <tr>
                    <td class="label" style="vertical-align: top;">Auditor</td>
                    <td style="vertical-align: top;">:</td>
                    <td style="vertical-align: top;">
                        @forelse($auditors ?? [] as $a)
                            {{ $a['nama'] }}
                            {!! !empty($a['role']) ? '<b>(' . $a['role'] . ')</b>' : '' !!}
                            <br>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td class="label" style="vertical-align: top;">Auditee</td>
                    <td style="vertical-align: top;">:</td>
                    <td style="vertical-align: top;">
                        @forelse($auditees ?? [] as $a)
                            {{ $a->nama_auditiee }}<br>
                        @empty
                            -
                        @endforelse
                    </td>
                </tr>

                {{-- ===== URAIAN KETIDAKSESUAIAN (Rich Text) ===== --}}
                <tr>
                    <td colspan="3" style="vertical-align: top;">
                        <span class="bold">URAIAN KETIDAKSESUAIAN</span>
                        @if($item->deskripsi_uraian_temuan)
                            <div class="rich-text">{!! $item->deskripsi_uraian_temuan !!}</div>
                        @else
                            <p>-</p>
                        @endif
                    </td>
                    <td colspan="3" style="vertical-align: top;">
                        <span class="bold">KATEGORI TEMUAN :</span>
                        <span class="bold">{{ $item->kategori_temuan ?? '-' }}</span>
                    </td>
                </tr>

                {{-- ===== Penyebab & Tindakan Koreksi (Rich Text) ===== --}}
                <tr>
                    <td colspan="3" style="vertical-align: top;">
                        <span class="bold">URAIAN FAKTOR PENYEBAB KETIDAKSESUAIAN :</span>
                        @if($item->auditPeriksa->analisis_penyebab ?? null)
                            <div class="rich-text">{!! $item->auditPeriksa->analisis_penyebab !!}</div>
                        @else
                            <p>-</p>
                        @endif
                    </td>
                    <td colspan="3" style="vertical-align: top;">
                        <span class="bold">TINDAKAN KOREKSI :</span>
                        @if($item->rencana_tindakan_perbaikan_auditee)
                            <div class="rich-text">{!! $item->rencana_tindakan_perbaikan_auditee !!}</div>
                        @else
                            <p>-</p>
                        @endif
                        <br>
                        <span class="bold">Tanggal Target Perbaikan :</span><br>
                        {{ $item->tanggal_target_perbaikan_auditee ? \Carbon\Carbon::parse($item->tanggal_target_perbaikan_auditee)->translatedFormat('d F Y') : '-' }}
                    </td>
                </tr>

                {{-- Baris 6: TTD Auditor & Auditee + Tindakan Pencegahan (Rich Text) --}}
                <tr>
                    <td colspan="2">
                        <div class="center">TTD Auditor</div>
                    </td>
                    <td>
                        <div class="center">TTD Auditee</div>
                    </td>
                    <td colspan="3" rowspan="4" style="vertical-align: top;">
                        <span class="bold">TINDAKAN PENCEGAHAN :</span><br>
                        @if($item->tindakan_pencegahan_auditee)
                            <div class="rich-text">{!! $item->tindakan_pencegahan_auditee !!}</div>
                        @else
                            <p>-</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="ttd-space"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="bold">Tanggal Mulai :</span><br>
                        {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td>
                        <div class="center">Tanggal</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="bold">Tanggal Selesai :</span><br>
                        {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td>
                        <div class="center">{{ $item->status_ncr ?? '-' }}</div>
                    </td>
                </tr>

                {{-- Baris 7: Verifikasi --}}
                <tr>
                    <td colspan="3">
                        <div class="center">TTD Auditor</div>
                        <br><br>
                        <br><br>
                        <br><br>
                    </td>
                    <td colspan="3" rowspan="2" style="vertical-align: top;">
                        <div class="center bold">VERIFIKASI PELAKSANAAN TINDAKAN KOREKSI DAN PENCEGAHAN</div>
                        @if($item->verifikasi ?? null)
                            <div class="rich-text">{!! $item->verifikasi !!}</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <span class="bold">Tanggal Verifikasi :</span><br>
                        {{ $item->tanggal_verifikasi ? \Carbon\Carbon::parse($item->tanggal_verifikasi)->translatedFormat('d F Y') : '-' }}
                    </td>
                </tr>
            </table>

            {{-- Tambahkan page break setelah setiap NCR kecuali yang terakhir --}}
            @if (!$loop->last)
                <div class="page-break"></div>
            @endif

        @empty
            <p style="margin-top: 30px; text-align: center;">Tidak ada data NCR untuk dicetak.</p>
        @endforelse

    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>