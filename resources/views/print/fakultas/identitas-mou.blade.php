<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
    <style type="text/css">
        * { font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        @page { size: A4 landscape; margin: 10mm; }
        .tg { border-collapse: collapse; border-spacing: 0; width: 100%; }
        .tg td { font-size: 10px; padding: 5px 4px; border: 1px solid black; word-break: normal; vertical-align: top; }
        .tg th { font-size: 10px; font-weight: bold; padding: 5px 4px; border: 1px solid black; background-color: #f2f2f2; text-align: center; }
        .static { width: 100%; border-collapse: collapse; }
        .static td, .static th { border: 1px solid black; padding: 8px 5px; font-size: 13px; vertical-align: top; }
        .no-border-table td, .no-border-table th { border: none; padding: 6px 4px; vertical-align: top; }
        u { text-decoration: underline; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

<br>

<div class="form-group">
    <table class="static" rules="all" border="1px">
        <tr>
            <th rowspan="3" style="width: 80px;">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75">
            </th>
            <th class="tg-0pky" style="width: 65%">FORMULIR</th>
            <td class="tg-0pky" style="width: 10%">No Dokumen</td>
            <td class="tg-0pky" style="width: 1%">:</td>
            <td class="tg-0pky" style="width: 25%">{{ $headerNoDokumen ?? '-' }}</td>
        </tr>
        <tr>
            <td class="tg-0pky" rowspan="2">
                <b><center>{{ $judul }}</center></b>
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

<div class="card-body">
    <div class="form-group">
        <table class="no-border-table" style="width: 100%;">
            <tr>
                <td style="width: 15%">Fakultas</td>
                <td style="width: 2%; text-align:center;">:</td>
                <td><u>{{ $namaFakultas }}</u></td>
            </tr>
            <tr>
                <td>Unit</td>
                <td style="text-align:center;">:</td>
                <td><u>{{ $unit }}</u></td>
            </tr>
            @if(!empty($filterInfo))
            <tr>
                <td>Filter</td>
                <td style="text-align:center;">:</td>
                <td><b>{{ $filterInfo }}</b></td>
            </tr>
            @endif
        </table>
    </div>
</div>

<br><br>

<div class="card-body">
    <div class="form-group">
        <table class="tg" rules="all" border="1px">
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th>Prodi</th>
                    <th>Nama Dokumen</th>
                    <th>Tgl Penetapan</th>
                    <th>Tgl Berakhir</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @if($dokumen->isEmpty())
                    <tr>
                        <td colspan="6" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data MoU.
                        </td>
                    </tr>
                @else
                    @foreach($dokumen as $i => $item)
                    @php
                        $isFak = $filterSource === 'fakultas';
                        $prodiName = $isFak
                            ? 'Fakultas'
                            : (optional(optional($item->profilProdi)->user)->sub_unit ?? '-');
                    @endphp
                    <tr>
                        <td class="tg-0lax text-center">{{ $i + 1 }}</td>
                        <td class="tg-0lax">{{ $prodiName }}</td>
                        <td class="tg-0lax">{{ $item->nama_dokumen ?? '-' }}</td>
                        <td class="tg-0lax text-center">
                            {{ $item->tanggal_penetapan
                                ? \Carbon\Carbon::parse($item->tanggal_penetapan)->format('d/m/Y')
                                : '-' }}
                        </td>
                        <td class="tg-0lax text-center">
                            {{ $item->tanggal_revisi
                                ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y')
                                : '-' }}
                        </td>
                        <td class="tg-0lax">{{ $item->keterangan ?? '-' }}</td>
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