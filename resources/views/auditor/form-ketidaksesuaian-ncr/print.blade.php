<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN KETIDAKSESUAIAN (NCR)</title>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 20px;
        }
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .tg td, .tg th {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            padding: 8px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
            vertical-align: top;
        }
        .static {
            width: 100%;
            border-collapse: collapse;
        }
        .static td, .static th {
            border: 1px solid black;
            padding: 8px 5px;
            font-family: 'Times New Roman', Times, serif;
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
        .page-break {
            page-break-before: always;
        }
        .header-logo {
            width: 75px;
            height: auto;
        }
    </style>
</head>
<body>

@php
    $noDokumen = 'UM.BJM-LPM-FORM.NCR-AMI-000';
    $tanggalTerbit = now()->format('d-m-Y');
    $revisi = '00';
@endphp

<br><br>
<div class="form-group">
    <table class="static" rules="all" border="1px" style="width: 100%;">
        <tr>
            <th rowspan="3" style="width: 15%;"><img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75"></th>
            <th class="tg-0pky" style="width: 55%">FORMULIR</th>
            <td class="tg-0pky" style="width: 10%">No Dokumen</td>
            <td class="tg-0pky" style="width: 1%">:</td>
            <td class="tg-0pky" style="width: 24%">{{ $noDokumen }}</td>
        </tr>
        <tr>
            <td class="tg-0pky" rowspan="2">
                <b><center>LAPORAN KETIDAKSESUAIAN (NCR)</center></b>
             </td>
            <td class="tg-0pky">Tanggal Terbit</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky">{{ $tanggalTerbit }}</td>
        </tr>
        <tr>
            <td class="tg-0pky">No. Revisi</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky">{{ $revisi }}</td>
        </tr>
    </table>
</div>
<br><br>

<!-- <div class="card-body">
    <div class="form-group">
        <table class="no-border-table" style="width: 100%;">
            <tr>
                <td style="width: 20%">Tahun Akademik</td>
                <td style="width: 2%; text-align:center;">:</td>
                <td><u>{{ $tahunAkademik->tahun_akademik ?? '-' }} {{ $tahunAkademik->semester ?? '' }}</u></td>
            </tr>
            <tr>
                <td>Lokasi Audit/Unit Kerja</td>
                <td style="text-align:center;">:</td>
                <td><u>{{ $lokasi_audit ?? '-' }}</u></td>
            </tr>
            <tr>
                <td style="vertical-align:top;">Auditor</td>
                <td style="vertical-align:top; text-align:center;">:</td>
                <td>
                    @forelse($auditors ?? [] as $a)
                        <u>{{ $loop->iteration }}. {{ $a['nama'] }} {!! $a['role'] ? '<b>('.$a['role'].')</b>' : '' !!}</u><br>
                    @empty
                        <u>-</u>
                    @endforelse
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;">Auditee</td>
                <td style="vertical-align:top; text-align:center;">:</td>
                <td>
                    @forelse($auditees ?? [] as $a)
                        <u>{{ $loop->iteration }}. {{ $a->nama_auditiee ?? $a }}</u><br>
                    @empty
                        <u>-</u>
                    @endforelse
                </td>
            </tr>
        </table>
    </div>
</div>
<br><br> -->

{{-- Loop setiap NCR --}}
@foreach($ncrItems as $index => $ncr)
<div class="card-body" style="{{ $loop->first ? '' : 'page-break' }}">
    <div class="form-group">
        <table class="tg" rules="all" border="1px" style="width: 100%;">
            {{-- BARIS 1: No NCR dan Tanggal --}}
            <tr>
                <td style="width: 15%;"><b>No NCR</b></td>
                <td style="width: 1%;">:</td>
                <td style="width: 34%;">{{ $ncr->no_ncr ?? '-' }}</td>
                <td style="width: 15%;"><b>Tanggal</b></td>
                <td style="width: 1%;">:</td>
                <td style="width: 34%;">{{ $ncr->created_at ? \Carbon\Carbon::parse($ncr->created_at)->translatedFormat('d F Y') : '-' }}</td>
            </tr>

            {{-- BARIS 2: Klausul/Dokumen dan Divisi/Lokasi --}}
            <tr>
                <td><b>Klausul/Dokumen</b></td>
                <td>:</td>
                <td>{{ $ncr->klausul_dokumen ?? '-' }}</td>
                <td><b>Divisi/Lokasi</b></td>
                <td>:</td>
                <td>{{ $lokasi_audit ?? '-' }}</td>
            </tr>

            {{-- BARIS 3: Auditor dan Auditee --}}
            <tr>
                <td style="vertical-align:top;"><b>Auditor</b></td>
                <td style="vertical-align:top;">:</td>
                <td style="vertical-align:top;">
                    @forelse($auditors ?? [] as $a)
                        {{ $a['nama'] }} {!! $a['role'] ? '<b>('.$a['role'].')</b>' : '' !!}<br>
                    @empty
                        {{ $ncr->auditor_names ?? '-' }}
                    @endforelse
                </td>
                <td style="vertical-align:top;"><b>Auditee</b></td>
                <td style="vertical-align:top;">:</td>
                <td style="vertical-align:top;">
                    @forelse($auditees ?? [] as $a)
                        {{ $a->nama_auditiee ?? $a }}<br>
                    @empty
                        {{ $ncr->auditee_names ?? '-' }}
                    @endforelse
                </td>
            </tr>

            {{-- BARIS 4: Indikator (gabung 6 kolom) --}}
            <tr>
                <td colspan="6" style="padding:8px;">
                    <b>INDIKATOR :</b> 
                    {{
                        $ncr->pertanyaanAmiProdi?->isiIndikator?->indikator
                        ?? $ncr->pertanyaanAmiUnit?->isiIndikator?->indikator
                        ?? '-'
                    }}
                </td>
            </tr>

            {{-- BARIS 5: Deskripsi / Uraian Temuan (gabung 6 kolom) --}}
            <tr>
                <td colspan="6" style="padding:8px;">
                    <b>DESKRIPSI / URAIAN TEMUAN</b><br>
                    {!! $ncr->deskripsi_uraian_temuan ?? '-' !!}
                </td>
            </tr>

            {{-- BARIS 6: Kategori Temuan (gabung 6 kolom) --}}
            <tr>
                <td colspan="6" style="padding:8px;">
                    <b>KATEGORI TEMUAN :</b> 
                    <b>{{ strtoupper($ncr->kategori_temuan ?? '-') }}</b>
                </td>
            </tr>

            {{-- BARIS 7: Analisis Penyebab (3 kolom) dan Akibat (3 kolom) --}}
            <tr>
                <td colspan="3" style="padding:8px;">
                    <b>ANALISIS PENYEBAB :</b><br>
                    {{ $ncr->analisis_penyebab ?? '-' }}
                </td>
                <td colspan="3" style="padding:8px;">
                    <b>AKIBAT :</b><br>
                    {{ $ncr->akibat ?? '-' }}
                </td>
            </tr>

            {{-- BARIS 8: Rencana Tindakan Perbaikan (gabung 6 kolom) --}}
            <tr>
                <td colspan="6" style="padding:8px;">
                    <b>RENCANA TINDAKAN PERBAIKAN :</b><br>
                    {!! nl2br(e(strip_tags($ncr->rencana_tindakan_perbaikan_auditee ?? '-'))) !!}
                    <br><br>
                    <b>Tanggal Target Perbaikan :</b> 
                    {{ $ncr->tanggal_target_perbaikan_auditee
                        ? \Carbon\Carbon::parse($ncr->tanggal_target_perbaikan_auditee)->translatedFormat('d F Y')
                        : '-' }}
                </td>
            </tr>

            {{-- BARIS 9: TTD Auditor, TTD Auditee, Tindakan Pencegahan --}}
            <tr>
                <td colspan="2" style="text-align:center;"><b>TTD Auditor</b></td>
                <td colspan="1" style="text-align:center;"><b>TTD Auditee</b></td>
                <td colspan="3" style="padding:8px;">
                    <b>TINDAKAN PENCEGAHAN :</b><br>
                    {{ $ncr->tindakan_pencegahan_auditee ?? '-' }}
                </td>
            </tr>

            {{-- BARIS 10: Ruang kosong untuk tanda tangan (2 kolom kiri digabung, 1 kolom tengah, 3 kolom kanan diisi ulang tindakan pencegahan? lebih baik kosong saja) --}}
            <tr>
                <td colspan="2" style="height: 80px;"><br><br><br></td>
                <td colspan="1"><br></td>
                <td colspan="3" rowspan="3" style="padding:8px;">
                    <b>VERIFIKASI PELAKSANAAN TINDAKAN KOREKSI DAN PENCEGAHAN</b><br><br>
                    {{ $ncr->verifikasi ?? '-' }}
                </td>
            </tr>

            {{-- BARIS 11: Tanggal Mulai dan Tanggal Selesai --}}
            <tr>
                <td colspan="2">
                    <b>Tanggal Mulai :</b><br>
                    {{ $ncr->created_at ? \Carbon\Carbon::parse($ncr->created_at)->translatedFormat('d F Y') : '-' }}
                </td>
                <td colspan="1"><b>Tanggal</b></td>
            </tr>

            {{-- BARIS 12: Tanggal Selesai dan kolom kosong --}}
            <tr>
                <td colspan="2">
                    <b>Tanggal Selesai :</b><br>
                    {{ $ncr->tanggal_selesai ? \Carbon\Carbon::parse($ncr->tanggal_selesai)->translatedFormat('d F Y') : '-' }}
                </td>
                <td colspan="1" style="text-align:center;">
                    {{ $ncr->tanggal_verifikasi ? \Carbon\Carbon::parse($ncr->tanggal_verifikasi)->translatedFormat('d F Y') : '-' }}
                </td>
            </tr>

            {{-- BARIS 13: TTD Auditor verifikasi --}}
            <tr>
                <td colspan="3" style="text-align:center;">
                    <b>TTD Auditor</b><br><br><br><br>
                </td>
                <td colspan="3" style="text-align:center;">
                    <b>Tanggal Verifikasi :</b><br>
                    {{ $ncr->tanggal_verifikasi ? \Carbon\Carbon::parse($ncr->tanggal_verifikasi)->translatedFormat('d F Y') : '-' }}
                </td>
            </tr>
        </table>
    </div>
</div>
@if(!$loop->last)
    <br style="page-break-before: always;">
@endif
@endforeach

@if($ncrItems->isEmpty())
    <div style="text-align:center; padding:50px;">
        <p>Tidak ada data NCR untuk tahun akademik yang dipilih.</p>
    </div>
@endif

<script type="text/javascript">
    window.print();
</script>

</body>
</html>