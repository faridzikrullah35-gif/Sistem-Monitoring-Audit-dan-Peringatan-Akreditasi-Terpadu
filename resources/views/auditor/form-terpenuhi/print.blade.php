<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

        .rich-content ul {
            list-style-type: disc;
            padding-left: 20px;
            margin: 5px 0;
        }

        .rich-content ol {
            list-style-type: decimal;
            padding-left: 20px;
            margin: 5px 0;
        }

        .rich-content li {
            margin-bottom: 3px;
        }

        .rich-content p {
            margin: 3px 0;
        }

        .rich-content strong {
            font-weight: bold;
        }

        .rich-content em {
            font-style: italic;
        }
    </style>

    <title>LAPORAN TERPENUHI</title>
</head>

<body>

    <br>
    <br>

    <div class="form-group">
        <table class="static" rules="all" border="1px" style="width:95%;">
            <tr>
                <th rowspan="3">
                    <img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75">
                </th>

                <th class="tg-0pky" style="width:65%">
                    FORMULIR
                </th>

                <td class="tg-0pky" style="width:10%">
                    No Dokumen
                </td>

                <td class="tg-0pky" style="width:1%">
                    :
                </td>

                <td class="tg-0pky" style="width:25%">
                    UM.BJM-LPM-FORM.TP-AMI-002
                </td>
            </tr>

            <tr>
                <td class="tg-0pky" rowspan="2">
                    <b>
                        <center>TERPENUHI</center>
                    </b>
                </td>

                <td class="tg-0pky">
                    Tanggal Terbit
                </td>

                <td class="tg-0pky">
                    :
                </td>

                <td class="tg-0pky"></td>
            </tr>

            <tr>
                <td class="tg-0pky">
                    No. Revisi
                </td>

                <td class="tg-0pky">
                    :
                </td>

                <td class="tg-0pky">
                    00
                </td>
            </tr>
        </table>
    </div>

    <br>
    <br>

    <div class="card-body">
        <div class="form-group">

            <table class="tg" rules="all" border="1px" style="width:95%;">

                <tr>
                    <td class="tg-0pky" style="width:5%;">
                        <center>No</center>
                    </td>

                    <td class="tg-0pky" style="width:40%;">
                        <center>Indikator</center>
                    </td>

                    <td class="tg-0pky" style="width:20%;">
                        <center>Discussed With</center>
                    </td>

                    <td class="tg-0pky" style="width:35%;">
                        <center>Recommendations and Improvement Suggestions</center>
                    </td>
                </tr>

                @forelse($terpenuhiItems as $item)

                    @php
                        $indikator =
                            $item->pertanyaanAmiProdi?->isiIndikator?->indikator
                            ?? $item->pertanyaanAmiUnit?->isiIndikator?->indikator
                            ?? '-';
                    @endphp

                    <tr>

                        <td class="tg-0lax"
                            style="text-align:center;vertical-align:middle;padding:0">
                            {{ $loop->iteration }}
                        </td>

                        <td class="tg-0lax"
                            style="text-align:left;vertical-align:top;padding:3;">
                            {{ $indikator }}
                        </td>

                        <td class="tg-0lax"
                            style="text-align:left;vertical-align:top;padding:3;">

                            @if($item->discussed_with)
                                <div class="rich-content">
                                    {!! $item->discussed_with !!}
                                </div>
                            @else
                                -
                            @endif

                        </td>

                        <td class="tg-0lax"
                            style="text-align:left;vertical-align:top;padding:3;font-family:'Times New Roman', Times, serif;">

                            @if($item->rekomendasi)
                                <div class="rich-content">
                                    {!! $item->rekomendasi !!}
                                </div>
                            @else
                                -
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4"
                            class="tg-0lax"
                            style="text-align:center;padding:20px;">
                            Tidak ada data terpenuhi untuk tahun akademik yang dipilih.
                        </td>
                    </tr>

                @endforelse

            </table>

            <br>

        </div>
    </div>

    <br>
    <br>
    <br>

    <script>
        window.print();
    </script>

</body>

</html>