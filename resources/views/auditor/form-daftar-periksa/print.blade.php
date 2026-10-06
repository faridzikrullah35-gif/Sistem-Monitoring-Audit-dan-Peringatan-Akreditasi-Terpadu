<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR PERIKSA ATAU PERTANYAAN AUDIT INTERNAL UNIT KERJA</title>
    <style type="text/css">
        /* ===== GLOBAL FONT: Aptos Display ===== */
        * {
            font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin-right: 50px;
        }
        .tg td {
            font-size: 14px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }
        .tg th {
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }
        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top;
            font-weight: bold;
        }
        .tg .tg-0lax {
            text-align: left;
            vertical-align: top;
        }
        .static {
            width: 95%;
            border-collapse: collapse;
        }
        .static td, .static th {
            border: 1px solid black;
            padding: 8px 5px;
            font-size: 14px;
            vertical-align: top;
        }
        .no-border-table td, .no-border-table th {
            border: none;
            padding: 6px 4px;
            vertical-align: top;
        }
        .center-text {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
        u {
            text-decoration: underline;
        }

        /* ===== Rich text styling ===== */
        .rich-text p {
            margin: 0 0 5px 0;
        }
        .rich-text ul,
        .rich-text ol {
            margin: 0 0 5px 0;
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
            margin: 5px 0;
        }
        .rich-text table {
            border-collapse: collapse;
            width: 100%;
            margin: 5px 0;
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

<br><br>

<div class="form-group">
    <table class="static" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th rowspan="3">
                <img
                    src="https://lpm.umbjm.ac.id/img/logo/a.png"
                    height="70"
                    width="75"
                >
            </th>
            <th class="tg-0pky" style="width: 65%">
                FORMULIR
            </th>
            <td class="tg-0pky" style="width: 10%">
                No Dokumen
            </td>
            <td class="tg-0pky" style="width: 1%">
                :
            </td>
            <td class="tg-0pky" style="width: 25%">
                {{ $settingHeaderCetak?->no_dokumen ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="tg-0pky" rowspan="2">
                <b>
                    <center>
                        DAFTAR PERIKSA ATAU PERTANYAAN AUDIT INTERNAL UNIT KERJA
                    </center>
                </b>
            </td>
            <td class="tg-0pky">
                Tanggal Terbit
            </td>
            <td class="tg-0pky">
                :
            </td>
            <td class="tg-0pky">
                {{ $settingHeaderCetak?->tanggal_terbit?->format('d-m-Y') ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="tg-0pky">
                No. Revisi
            </td>
            <td class="tg-0pky">
                :
            </td>
            <td class="tg-0pky">
                {{ $settingHeaderCetak?->no_revisi ?? '-' }}
            </td>
        </tr>
    </table>
</div>

<br><br>

<div class="card-body">
    <div class="form-group">
        <table class="no-border-table" style="width: 95%;">
            <!-- Tanggal Audit -->
            <tr>
                <td style="width: 20%">Tanggal Audit</td>
                <td style="width: 2%; text-align:center;">:</td>
                <td><u>{{ $tanggal_audit ?? '-' }}</u></td>
            </tr>
            <!-- Lokasi Audit -->
            <tr>
                <td>Lokasi Audit/ Unit Kerja</td>
                <td style="text-align:center;">:</td>
                <td><u>{{ $lokasi_audit ?? '-' }}</u></td>
            </tr>
            <!-- AUDITOR (satu baris, tanpa rowspan) -->
            <tr>
                <td style="vertical-align:top;">Auditor</td>
                <td style="vertical-align:top; text-align:center;">:</td>
                <td style="vertical-align:top;">
                    @forelse($auditors ?? [] as $a)
                        <u>{{ $loop->iteration }}. {{ $a['nama'] }} {!! $a['role'] ? '<b>('.$a['role'].')</b>' : '' !!}</u><br>
                    @empty
                        <u>-</u>
                    @endforelse
                </td>
            </tr>
            <!-- AUDITEE (satu baris, tanpa rowspan, rapi sejajar dengan Auditor) -->
            <tr>
                <td style="vertical-align:top;">Auditee</td>
                <td style="vertical-align:top; text-align:center;">:</td>
                <td style="vertical-align:top;">
                    @forelse($auditees ?? [] as $a)
                        <u>{{ $loop->iteration }}. {{ $a->nama_auditiee }}</u><br>
                    @empty
                        <u>-</u>
                    @endforelse
                </td>
            </tr>
        </table>
    </div>
</div>

<br><br>
<div class="card-body">
    <div class="form-group">
        <table class="tg" rules="all" border="1px" style="width: 95%;">
            <thead>
                <tr>
                    <th class="tg-0pky" style="width: 5%; text-align:center;">No</th>
                    <th class="tg-0pky" style="text-align:center;">Deskripsi / Uraian Temuan</th>
                    <th class="tg-0pky" style="text-align:center;">Analisis Penyebab</th>
                    <th class="tg-0pky" style="text-align:center;">Akibat</th>
                    <th class="tg-0pky" style="text-align:center;">Indikator</th>
                    <th class="tg-0pky" style="text-align:center;">Skor (1-4)</th>
                    <th class="tg-0pky" style="text-align:center;">Panduan Pengisian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                @php
                    // Ambil model pertanyaan (Prodi atau Unit)
                    $pertanyaan = $item->pertanyaanAmiProdi ?? $item->pertanyaanAmiUnit;
                    
                    // Ambil indikator dari relasi isiIndikator
                    $indikator = $pertanyaan?->isiIndikator?->indikator ?? '-';
                @endphp
                <tr>
                    <td class="tg-0lax" style="text-align:center;">{{ $i + 1 }}</td>
                    <td class="tg-0lax">{{ $item->uraian_temuan ?? '-' }}</td>
                    <td class="tg-0lax">{{ $item->analisis_penyebab ?? '-' }}</td>
                    <td class="tg-0lax">{{ $item->akibat ?? '-' }}</td>
                    <td class="tg-0lax">{{ $indikator }}</td>
                    <td class="tg-0lax" style="text-align:center;">{{ $item->score->nilai_score ?? '-' }}</td>
                    
                    {{-- ===== KOLOM PANDUAN PENGISIAN – DUKUNGAN RICH TEXT ===== --}}
                    <td class="tg-0lax">
                        @if($item->panduan_pengisian)
                            <div class="rich-text">{!! $item->panduan_pengisian !!}</div>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="card-body">
    <div class="form-group">
        <table style="width: 95%;">
            <tr>
                <td colspan="3"><b>Catatan :</b></td>
            </tr>
            <tr>
                <td style="width: 3%;"></td>
                <td style="text-align:right; vertical-align:top;">-</td>
                <td>Skor 4 menunjukkan kategori Conformity (Kesesuaian)</td>
            </tr>
            <tr>
                <td style="width: 3%;"></td>
                <td style="text-align:right; vertical-align:top;">-</td>
                <td>Skor 3 menunjukkan kategori Observasi (Saran/ peluang perbaikan), selanjutnya hasil temuan visitasi dikonversikan ke dalam form OBSERVASI</td>
            </tr>
            <tr>
                <td style="width: 3%;"></td>
                <td style="text-align:right; vertical-align:top;">-</td>
                <td>Skor 2 & 1 menunjukkan kategori Non Conformity (Ketidaksesuaian), selanjutnya hasil temuan visitasi dikonversikan ke dalam form NCR (Non Conformity/Ketidaksesuaian)</td>
            </tr>
        </table>
    </div>
</div>

<br><br><br>

<div class="card-body">
    <div class="form-group">
        <table style="width: 95%;">
            <tr>
                <th style="text-align:left; vertical-align:top; width: 50%;">Mengetahui,</th>
                <th></th>
                <th colspan="5" style="text-align:left; vertical-align:top; width: 50%;">Barito Kuala, {{ now()->format('d F Y') }}</th>
            </tr>
            <tr>
                <td>Kepala Bagian Penjaminan Mutu Internal</td>
                <td></td>
                <td colspan="5">Auditor Mutu Internal :</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="5">Lead Auditor</td>
            </tr>
            <tr>
                <td style="height: 80px;"><br><br><br></td>
                <td></td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <!-- Tanda tangan Kepala Bagian Penjaminan Mutu Internal -->
                <td><u><u>{{ $kabalai->auditor->nama_auditor }}</u></u></td>
                <td></td>
                <!-- LEAD AUDITOR: dinamis dari database -->
                <td colspan="5"><u>{{ $leadAuditorName }}</u></td>
            </tr>
            <tr>
                <td>NIDN. {{ $kabalai->auditor->identity_number }}</td>
                <td></td>
                <td colspan="5">NIDN. {{ $leadAuditorNidn }}</td>
            </tr>
            <tr>
                <td><br><br></td>
            </tr>
            <tr>
                <th colspan="7" style="text-align:center; vertical-align:top;">Menyetujui,</th>
            </tr>
            <tr>
                <td colspan="7" style="text-align:center; vertical-align:top;">Kepala Lembaga Penjaminan Mutu</td>
            </tr>
            <tr>
                <td colspan="7" style="height: 80px;"><br><br><br></td>
            </tr>
            <tr>
                <!-- Tanda tangan Kepala LPM -->
                <td colspan="7" style="text-align:center; vertical-align:top;"><u><u>{{ $kepalaLPM->auditor->nama_auditor }}</u></u></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align:center; vertical-align:top;">NIDN. {{ $kepalaLPM->auditor->identity_number }}</td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">
    window.print();
</script>

</body>
</html>