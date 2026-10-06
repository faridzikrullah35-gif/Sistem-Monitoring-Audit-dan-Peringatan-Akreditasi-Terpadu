`<!DOCTYPE html>
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
            <td class="value-doc">{{ $settingHeaderCetak?->no_dokumen ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-doc">Tanggal Terbit</td>
            <td style="width:2%; text-align:center; font-weight:700; padding:8px 2px;">:</td>
            <td class="value-doc">{{ $settingHeaderCetak?->tanggal_terbit?->format('d-m-Y') ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-doc">No. Revisi</td>
            <td style="width:2%; text-align:center; font-weight:700; padding:8px 2px;">:</td>
            <td class="value-doc">{{ $settingHeaderCetak?->no_revisi ?? '-' }}</td>
        </tr>
    </table>

    {{-- ============================================================ --}}
    {{-- LOOP NCR ITEMS --}}
    {{-- ============================================================ --}}
    @foreach($ncrItems as $index => $ncr)
        <div class="{{ $loop->first ? '' : 'page-break' }}">
            <table class="table-main">
                {{-- BARIS 1: No NCR & Tanggal --}}
                <tr>
                    <td class="label"><b>No NCR</b></td>
                    <td class="colon">:</td>
                    <td class="value"><b>{{ $ncr->no_ncr ?? '-' }}</b></td>
                    <td class="label"><b>Tanggal</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $ncr->created_at ? \Carbon\Carbon::parse($ncr->created_at)->translatedFormat('d F Y') : '-' }}</td>
                </tr>

                {{-- BARIS 2: Klausul/Dokumen & Divisi/Lokasi --}}
                <tr>
                    <td class="label"><b>Klausul/Dokumen</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $ncr->klausul_dokumen ?? '-' }}</td>
                    <td class="label"><b>Divisi/Lokasi</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $lokasi_audit ?? '-' }}</td>
                </tr>

                {{-- BARIS 3: Auditor & Auditee --}}
                <tr>
                    <td class="label" style="vertical-align:top;"><b>Auditor</b></td>
                    <td class="colon" style="vertical-align:top;">:</td>
                    <td style="vertical-align:top;">
                        @forelse($auditors ?? [] as $a)
                            {{ $a['nama'] }} {!! $a['role'] ? '<b>('.$a['role'].')</b>' : '' !!}<br>
                        @empty
                            {{ $ncr->auditor_names ?? '-' }}
                        @endforelse
                    </td>
                    <td class="label" style="vertical-align:top;"><b>Auditee</b></td>
                    <td class="colon" style="vertical-align:top;">:</td>
                    <td style="vertical-align:top;">
                        @forelse($auditees ?? [] as $a)
                            {{ $a->nama_auditiee ?? $a }}<br>
                        @empty
                            {{ $ncr->auditee_names ?? '-' }}
                        @endforelse
                    </td>
                </tr>

                {{-- BARIS 4: Indikator --}}
                <tr>
                    <td colspan="6" style="padding:10px;">
                        <b>INDIKATOR :</b>
                        {{ $ncr->pertanyaanAmiProdi?->isiIndikator?->indikator
                           ?? $ncr->pertanyaanAmiUnit?->isiIndikator?->indikator
                           ?? '-' }}
                    </td>
                </tr>

                {{-- BARIS 5: Deskripsi Temuan --}}
                <tr>
                    <td colspan="6" style="padding:10px;">
                        <b>DESKRIPSI / URAIAN TEMUAN</b><br>
                        @if($ncr->deskripsi_uraian_temuan)
                            <div class="rich-text">{!! $ncr->deskripsi_uraian_temuan !!}</div>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                {{-- BARIS 6: Kategori Temuan --}}
                <tr>
                    <td colspan="6" style="padding:10px;">
                        <b>KATEGORI TEMUAN :</b>
                        <b>{{ strtoupper($ncr->kategori_temuan ?? '-') }}</b>
                    </td>
                </tr>

                {{-- BARIS 7: Analisis Penyebab & Akibat --}}
                <tr>
                    <td colspan="3" style="padding:10px;">
                        <b>ANALISIS PENYEBAB :</b><br>
                        {{ $ncr->analisis_penyebab ?? '-' }}
                    </td>
                    <td colspan="3" style="padding:10px;">
                        <b>AKIBAT :</b><br>
                        {{ $ncr->akibat ?? '-' }}
                    </td>
                </tr>

                {{-- BARIS 8: Rencana Tindakan Perbaikan --}}
                <tr>
                    <td colspan="6" style="padding:10px;">
                        <b>RENCANA TINDAKAN PERBAIKAN :</b><br>
                        {!! nl2br(e(strip_tags($ncr->rencana_tindakan_perbaikan_auditee ?? '-'))) !!}
                        <br><br>
                        <b>Tanggal Target Perbaikan :</b>
                        {{ $ncr->tanggal_target_perbaikan_auditee
                            ? \Carbon\Carbon::parse($ncr->tanggal_target_perbaikan_auditee)->translatedFormat('d F Y')
                            : '-' }}
                    </td>
                </tr>

                {{-- BARIS 9: TTD Auditee & Tindakan Pencegahan --}}
                <tr>
                    <td colspan="1" style="text-align:center; vertical-align:middle;">
                        <b>TTD Auditee</b>
                    </td>
                    <td colspan="5" style="padding:10px;">
                        <b>TINDAKAN PENCEGAHAN :</b><br>
                        @if($ncr->tindakan_pencegahan_auditee)
                            <div class="rich-text">{!! $ncr->tindakan_pencegahan_auditee !!}</div>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                {{-- BARIS 10: Tanggal Mulai & Tanggal Selesai --}}
                <tr>
                    <td class="label"><b>Tanggal Mulai</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $ncr->created_at ? \Carbon\Carbon::parse($ncr->created_at)->translatedFormat('d F Y') : '-' }}</td>
                    <td class="label"><b>Tanggal Selesai</b></td>
                    <td class="colon">:</td>
                    <td class="value">{{ $ncr->tanggal_selesai ? \Carbon\Carbon::parse($ncr->tanggal_selesai)->translatedFormat('d F Y') : '-' }}</td>
                </tr>

                {{-- BARIS 11: Status --}}
                <tr>
                    <td class="label"><b>Status</b></td>
                    <td class="colon">:</td>
                    <td class="value" colspan="4">
                        <b>{{ $ncr->status_ncr ?? '-' }}</b>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach

    {{-- ============================================================ --}}
    {{-- EMPTY STATE --}}
    {{-- ============================================================ --}}
    @if($ncrItems->isEmpty())
        <div class="empty-state">
            <p>Tidak ada data NCR untuk tahun akademik yang dipilih.</p>
        </div>
    @endif

    {{-- ============================================================ --}}
    {{-- AUTO PRINT --}}
    {{-- ============================================================ --}}
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>

</body>
</html>`