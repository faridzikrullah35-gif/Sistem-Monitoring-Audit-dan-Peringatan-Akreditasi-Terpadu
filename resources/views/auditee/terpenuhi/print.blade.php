<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin-right: 50px;
        }
        .tg td {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }
        .tg th {
            font-family: 'Times New Roman', Times, serif;
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

        /* ===== STYLING RICH TEXT UNTUK CETAK ===== */
        .rich-text {
            max-width: 100%;
            word-wrap: break-word;
        }
        .rich-text p {
            margin-bottom: 8px;
        }
        .rich-text ul {
            list-style: disc;
            padding-left: 20px;
            margin-bottom: 8px;
        }
        .rich-text ol {
            list-style: decimal;
            padding-left: 20px;
            margin-bottom: 8px;
        }
        .rich-text li {
            margin-bottom: 4px;
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
        .rich-text h1 {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .rich-text h2 {
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .rich-text table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        .rich-text table td,
        .rich-text table th {
            border: 1px solid #000;
            padding: 6px;
        }
        .rich-text table th {
            font-weight: bold;
            background: #f0f0f0;
        }
        .rich-text *:last-child {
            margin-bottom: 0;
        }
    </style>
    <title>LAPORAN TERPENUHI - AUDITEE</title>
</head>
<body>
    <br><br>
    <div class="form-group">
        <table class="static" rules="all" border="1px" style="width: 95%;">
            <tr>
                <th rowspan="3"><img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75"></th>
                <th class="tg-0pky" style="width: 65%">FORMULIR</th>
                <td class="tg-0pky" style="width: 10%">No Dokumen</td>
                <td class="tg-0pky" style="width: 1%">:</td>
                <td class="tg-0pky" style="width: 25%">UM.BJM-LPM-FORM.TP-AMI-002</td>
            </tr>
            <tr>
                <td class="tg-0pky" rowspan="2">
                    <b><center>TERPENUHI</center></b>
                </td>
                <td class="tg-0pky">Tanggal Terbit</td>
                <td class="tg-0pky">:</td>
                <td class="tg-0pky">{{ now()->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">No. Revisi</td>
                <td class="tg-0pky">:</td>
                <td class="tg-0pky">00</td>
            </tr>
        </table>
    </div>
    <br><br>

    <div class="card-body">
        <div class="form-group">
            <table class="tg" rules="all" border="1px" style="width: 95%;">
                <tr>
                    <td class="tg-0pky" style="width:5%; text-align:center;">
                        <center>No</center>
                    </td>
                    <td class="tg-0pky" style="width:20%; text-align:center;">
                        <center>Discussed with</center>
                    </td>
                    <td class="tg-0pky" style="width:35%; text-align:center;">
                        <center>Recommendations and Improvement Suggestions</center>
                    </td>
                </tr>

                @forelse($terpenuhiItems as $item)
                    @php
                        $indikator = $item->pertanyaanAmiProdi?->isiIndikator?->indikator
                            ?? $item->pertanyaanAmiUnit?->isiIndikator?->indikator
                            ?? '-';
                    @endphp

                    <tr>
                        <td class="tg-0lax" style="text-align:center; vertical-align:middle; padding:0">
                            {{ $loop->iteration }}
                        </td>

                        {{-- DISCUSSED WITH (RICH TEXT) --}}
                        <td class="tg-0lax" style="text-align:left; vertical-align:top; padding:3;">
                            @if(!empty($item->discussed_with))
                                <div class="rich-text">
                                    {!! $item->discussed_with !!}
                                </div>
                            @else
                                <span style="color:#888;">-</span>
                            @endif
                        </td>

                        {{-- RECOMMENDATIONS (RICH TEXT) --}}
                        <td class="tg-0lax" style="text-align:left; vertical-align:top; padding:3; font-family:'Times New Roman', Times, serif;">
                            @if(!empty($item->rekomendasi))
                                <div class="rich-text">
                                    {!! $item->rekomendasi !!}
                                </div>
                            @else
                                <span style="color:#888;">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="tg-0lax" style="text-align:center; padding:20px;">
                            Tidak ada data terpenuhi untuk tahun akademik yang dipilih.
                        </td>
                    </tr>
                @endforelse
            </table>
            <br>
        </div>
    </div>
    <br><br><br>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>