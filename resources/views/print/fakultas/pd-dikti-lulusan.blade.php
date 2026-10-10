<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA LULUSAN PD-DIKTI FAKULTAS</title>
    <style type="text/css">
        * { font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        @page { size: A4 landscape; margin: 10mm; }
        .tg { border-collapse: collapse; border-spacing: 0; width: 100%; }
        .tg td { font-size: 11px; padding: 5px 4px; border: 1px solid black; word-break: normal; vertical-align: top; }
        .tg th { font-size: 11px; font-weight: bold; padding: 5px 4px; border: 1px solid black; background-color: #f2f2f2; text-align: center; }
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
                <b><center>DATA LULUSAN PD-DIKTI FAKULTAS</center></b>
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
                    <th>TA-3</th>
                    <th>TA-2</th>
                    <th>TA-1</th>
                    <th>TA</th>
                    <th>Persentase Penurunan</th>
                </tr>
            </thead>
            <tbody>
                @if($lulusan->isEmpty())
                    <tr>
                        <td colspan="7" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data lulusan.
                        </td>
                    </tr>
                @else
                    @foreach($lulusan as $i => $item)
                    <tr>
                        <td class="tg-0lax text-center">{{ $i + 1 }}</td>
                        <td class="tg-0lax">
                            {{ optional($item->user)->sub_unit ?? $item->nama_prodi ?? 'Fakultas' }}
                        </td>
                        <td class="tg-0lax text-center">{{ $item->ta_3 ?? '-' }}</td>
                        <td class="tg-0lax text-center">{{ $item->ta_2 ?? '-' }}</td>
                        <td class="tg-0lax text-center">{{ $item->ta_1 ?? '-' }}</td>
                        <td class="tg-0lax text-center">{{ $item->ta ?? '-' }}</td>
                        <td class="tg-0lax text-center">
                            {{ number_format($item->persentase_penurunan ?? 0, 2) }}%
                        </td>
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