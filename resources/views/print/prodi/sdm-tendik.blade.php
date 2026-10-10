<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA TENDIK PRODI</title>
    <style type="text/css">
        * { font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        .tg { border-collapse: collapse; border-spacing: 0; margin-right: 50px; }
        .tg td { font-size: 11px; padding: 6px 4px; border: 1px solid black; overflow: hidden; word-break: normal; }
        .tg th { font-size: 11px; font-weight: bold; padding: 6px 4px; border: 1px solid black; background-color: #f2f2f2; }
        .tg .tg-0pky { border-color: inherit; text-align: left; vertical-align: top; font-weight: bold; }
        .tg .tg-0lax { text-align: left; vertical-align: top; }
        .static { width: 95%; border-collapse: collapse; }
        .static td, .static th { border: 1px solid black; padding: 8px 5px; font-size: 14px; vertical-align: top; }
        .no-border-table td, .no-border-table th { border: none; padding: 6px 4px; vertical-align: top; }
        u { text-decoration: underline; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

<br><br>

{{-- ==================== HEADER FORMULIR ==================== --}}
<div class="form-group">
    <table class="static" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th rowspan="3">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75">
            </th>
            <th class="tg-0pky" style="width: 65%">FORMULIR</th>
            <td class="tg-0pky" style="width: 10%">No Dokumen</td>
            <td class="tg-0pky" style="width: 1%">:</td>
            <td class="tg-0pky" style="width: 25%">{{ $headerNoDokumen ?? '-' }}</td>
        </tr>
        <tr>
            <td class="tg-0pky" rowspan="2">
                <b><center>DATA TENDIK PRODI</center></b>
            </td>
            <td class="tg-0pky">Tanggal Terbit</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky">{{ $headerTanggalTerbit ?? '-' }}</td>
        </tr>
        <tr>
            <td class="tg-0pky">No. Revisi</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky">{{ $headerNoRevisi ?? '-' }}</td>
        </tr>
    </table>
</div>

<br><br>

{{-- ==================== INFO PRODI ==================== --}}
<div class="card-body">
    <div class="form-group">
        <table class="no-border-table" style="width: 95%;">
            <tr>
                <td style="width: 20%">Program Studi</td>
                <td style="width: 2%; text-align:center;">:</td>
                <td><u>{{ $namaProdi }}</u></td>
            </tr>
            <tr>
                <td>Unit</td>
                <td style="text-align:center;">:</td>
                <td><u>{{ $unit }}</u></td>
            </tr>
        </table>
    </div>
</div>

<br><br>

{{-- ==================== TABEL TENDIK ==================== --}}
<div class="card-body">
    <div class="form-group">
        <table class="tg" rules="all" border="1px" style="width: 95%;">
            <thead>
                <tr>
                    <th style="text-align:center; width: 3%;">No</th>
                    <th style="text-align:center;">Nama</th>
                    <th style="text-align:center;">Posisi / Jabatan</th>
                    <th style="text-align:center;">Terhitung Mulai Tgl</th>
                    <th style="text-align:center;">Latar Pendidikan</th>
                    <th style="text-align:center;">Sertifikasi</th>
                    <th style="text-align:center;">SK Pegawai Tetap</th>
                </tr>
            </thead>
            <tbody>
                @if($tendik->isEmpty())
                    <tr>
                        <td colspan="7" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data tendik.
                        </td>
                    </tr>
                @else
                    @foreach($tendik as $i => $item)
                    <tr>
                        <td class="tg-0lax text-center">{{ $i + 1 }}</td>
                        <td class="tg-0lax">{{ $item->nama ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->posisi ?? '-' }}</td>
                        <td class="tg-0lax text-center">
                            {{ $item->terhitung_mulai_tanggal
                                ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y')
                                : '-' }}
                        </td>
                        <td class="tg-0lax">{{ $item->latar_pendidikan ?? '-' }}</td>
                        <td class="tg-0lax text-center">{{ $item->sertifikasi ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->sk_pegawai_tetap ?? '-' }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    window.print();
</script>

</body>
</html>