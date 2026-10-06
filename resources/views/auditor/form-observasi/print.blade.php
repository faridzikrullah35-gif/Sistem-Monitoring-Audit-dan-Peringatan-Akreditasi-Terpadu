<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .rich-text {
            word-break: break-word;
        }

        .rich-text p {
            margin: 0 0 6px 0;
        }

        .rich-text ul {
            margin: 0 0 6px 20px;
            padding-left: 18px;
            list-style-type: disc;
        }

        .rich-text ol {
            margin: 0 0 6px 20px;
            padding-left: 18px;
            list-style-type: decimal;
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

        .rich-text table {
            width: 100%;
            border-collapse: collapse;
        }

        .rich-text table,
        .rich-text th,
        .rich-text td {
            border: 1px solid #000;
        }

        .rich-text th,
        .rich-text td {
            padding: 4px;
        }

        /* Tambahan untuk header static */
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
        .static .tg-0pky {
            font-weight: bold;
        }
        .center-text {
            text-align: center;
        }
        u {
            text-decoration: underline;
        }
    </style>
    <title>LAPORAN OBSERVASI</title>
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
                            OBSERVASI
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
            <table class="tg" rules="all" border="1px" style="width: 95%;">
                <tr>
                    <td class="tg-0pky" style="width:5%; text-align:center;">
                        <center>No</center>
                    </td>
                    <td class="tg-0pky" style="width:40%; text-align:center;">
                        <center>Indikator</center>
                    </td>
                    <td class="tg-0pky" style="width:20%; text-align:center;">
                        <center>Discussed with</center>
                    </td>
                    <td class="tg-0pky" style="width:35%; text-align:center;">
                        <center>Recommendations and Improvement Suggestions</center>
                    </td>
                </tr>
                @forelse($observasiItems as $item)

                @php
                    $indikator =
                        $item->pertanyaanAmiProdi?->isiIndikator?->indikator
                        ?? $item->pertanyaanAmiUnit?->isiIndikator?->indikator
                        ?? '-';
                @endphp

                <tr>
                    <td class="tg-0lax" style="text-align:center; vertical-align:middle; padding:0">
                        {{ $loop->iteration }}
                    </td>

                    <td class="tg-0lax" style="text-align:left; vertical-align:top; padding:3;">
                        {{ $indikator }}
                    </td>

                    <td class="tg-0lax" style="text-align:left; vertical-align:top; padding:3;">
                        @if(!empty($item->discussed_with))
                            <div class="rich-text">
                                {!! $item->discussed_with !!}
                            </div>
                        @else
                            -
                        @endif
                    </td>

                    <td class="tg-0lax" style="text-align:left; vertical-align:top; padding:3;">
                        @if(!empty($item->rekomendasi))
                            <div class="rich-text">
                                {!! $item->rekomendasi !!}
                            </div>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="4" class="tg-0lax" style="text-align:center; padding:20px;">
                        Tidak ada data observasi untuk tahun akademik yang dipilih.
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