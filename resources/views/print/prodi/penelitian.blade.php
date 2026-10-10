<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA PENELITIAN DOSEN PRODI</title>
    <style type="text/css">
        * { font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }

        @page { size: A4 landscape; margin: 10mm; }

        .tg { border-collapse: collapse; border-spacing: 0; width: 100%; }
        .tg td { font-size: 10px; padding: 5px 4px; border: 1px solid black; overflow: hidden; word-break: normal; vertical-align: top; }
        .tg th { font-size: 10px; font-weight: bold; padding: 5px 4px; border: 1px solid black; background-color: #f2f2f2; text-align: center; }
        .tg .tg-0pky { border-color: inherit; text-align: left; vertical-align: top; font-weight: bold; }
        .tg .tg-0lax { text-align: left; vertical-align: top; }

        .static { width: 100%; border-collapse: collapse; }
        .static td, .static th { border: 1px solid black; padding: 8px 5px; font-size: 13px; vertical-align: top; }

        .no-border-table td, .no-border-table th { border: none; padding: 6px 4px; vertical-align: top; }

        u { text-decoration: underline; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

<br>

{{-- ==================== HEADER FORMULIR ==================== --}}
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
                <b><center>DATA PENELITIAN DOSEN PRODI</center></b>
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
        <table class="no-border-table" style="width: 100%;">
            <tr>
                <td style="width: 15%">Program Studi</td>
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

{{-- ==================== TABEL PENELITIAN ==================== --}}
<div class="card-body">
    <div class="form-group">
        <table class="tg" rules="all" border="1px">
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th>Ketua/Anggota</th>
                    <th>Nama Dosen</th>
                    <th style="min-width: 200px;">Judul Penelitian</th>
                    <th>Tahun Akademik</th>
                    <th>Lembaga Mitra</th>
                    <th>Tingkat</th>
                    <th>Skema</th>
                    <th>Sumber Dana</th>
                    <th>Luaran</th>
                    <th>Link Bukti</th>
                </tr>
            </thead>
            <tbody>
                @if($penelitian->isEmpty())
                    <tr>
                        <td colspan="11" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data penelitian.
                        </td>
                    </tr>
                @else
                    @foreach($penelitian as $i => $item)
                    <tr>
                        <td class="tg-0lax text-center">{{ $i + 1 }}</td>
                        <td class="tg-0lax text-center">{{ $item->ketua_anggota ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->nama_dosen ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->judul_penelitian ?? '-' }}</td>
                        <td class="tg-0lax text-center">{{ $item->tahun_akademik ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->lembaga_mitra ?? '-' }}</td>
                        <td class="tg-0lax text-center">{{ $item->tingkat ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->skema ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->sumber_dana ?? '-' }}</td>
                        <td class="tg-0lax">{{ $item->luaran ?? '-' }}</td>
                        <td class="tg-0lax" style="word-break: break-all;">
                            {{ $item->link_bukti ?? '-' }}
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