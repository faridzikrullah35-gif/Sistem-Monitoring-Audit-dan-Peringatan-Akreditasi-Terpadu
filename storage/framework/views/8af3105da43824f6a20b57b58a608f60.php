<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR KERJASAMA MoU / MoA PROGRAM STUDI</title>
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

        /* ===== RICH TEXT ===== */
        .rich-text p { margin: 0 0 5px 0; }
        .rich-text ul,
        .rich-text ol { margin: 0 0 5px 0; padding-left: 20px; }
        .rich-text li { margin-bottom: 2px; }
        .rich-text strong { font-weight: bold; }
        .rich-text em { font-style: italic; }
        .rich-text u { text-decoration: underline; }
        .rich-text h1,
        .rich-text h2,
        .rich-text h3 { font-weight: bold; margin: 5px 0; }
        .rich-text table { border-collapse: collapse; width: 100%; margin: 5px 0; }
        .rich-text table td,
        .rich-text table th { border: 1px solid black; padding: 4px; }
        .rich-text { word-wrap: break-word; white-space: normal; }
    </style>
</head>
<body>

<br><br>


<div class="form-group">
    <table class="static" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th rowspan="3">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png"
                     height="70"
                     width="75">
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
                <?php echo e($headerNoDokumen ?? '-'); ?>

            </td>
        </tr>
        <tr>
            <td class="tg-0pky" rowspan="2">
                <b>
                    <center>
                        DAFTAR KERJASAMA MoU / MoA PROGRAM STUDI
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
                <?php echo e($headerTanggalTerbit ?? '-'); ?>

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
                <?php echo e($headerNoRevisi ?? '-'); ?>

            </td>
        </tr>
    </table>
</div>

<br><br>


<div class="card-body">
    <div class="form-group">
        <table class="no-border-table" style="width: 95%;">
            <tr>
                <td style="width: 20%">Program Studi</td>
                <td style="width: 2%; text-align:center;">:</td>
                <td><u><?php echo e($namaProdi); ?></u></td>
            </tr>
            <tr>
                <td>Unit</td>
                <td style="text-align:center;">:</td>
                <td><u><?php echo e($unit); ?></u></td>
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
                    <th class="tg-0pky" style="width: 4%; text-align:center;">No</th>
                    <th class="tg-0pky" style="text-align:center;">Nama Dokumen</th>
                    <th class="tg-0pky" style="text-align:center;">Tgl Penetapan</th>
                    <th class="tg-0pky" style="text-align:center;">Tgl Berakhir</th>
                    <th class="tg-0pky" style="text-align:center;">Sisa Kadaluarsa</th>
                    <th class="tg-0pky" style="text-align:center;">Tingkat</th>
                    <th class="tg-0pky" style="text-align:center;">File</th>
                </tr>
            </thead>
            <tbody>
                <?php if($dokumenMou->isEmpty()): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data MoU untuk prodi ini.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $__currentLoopData = $dokumenMou; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tg-0lax" style="text-align:center;"><?php echo e($i + 1); ?></td>
                        <td class="tg-0lax"><?php echo e($item->nama_dokumen ?? '-'); ?></td>
                        <td class="tg-0lax">
                            <?php echo e($item->tanggal_penetapan
                                ? \Carbon\Carbon::parse($item->tanggal_penetapan)->format('d/m/Y')
                                : '-'); ?>

                        </td>
                        <td class="tg-0lax">
                            <?php echo e($item->tanggal_revisi
                                ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y')
                                : '-'); ?>

                        </td>
                        <td class="tg-0lax">
                            <?php if($item->tanggal_revisi): ?>
                                <?php
                                    $tanggalBerakhir = \Carbon\Carbon::parse($item->tanggal_revisi)->startOfDay();
                                    $hariIni         = \Carbon\Carbon::today();
                                    $selisihHari     = $hariIni->diffInDays($tanggalBerakhir, false);
                                    $diff            = $hariIni->diff($tanggalBerakhir);
                                    $tahun           = $diff->y;
                                    $bulan           = $diff->m;
                                    $hari            = $diff->d;
                                    $isExpired       = $selisihHari < 0;
                                    $isToday         = $selisihHari === 0;

                                    $parts = [];
                                    if ($tahun > 0) $parts[] = $tahun . ' tahun';
                                    if ($bulan > 0) $parts[] = $bulan . ' bulan';
                                    if ($hari > 0)  $parts[] = $hari . ' hari';
                                    $text = implode(' ', $parts) ?: '0 hari';
                                ?>

                                <?php if($isToday): ?>
                                    Kadaluarsa hari ini
                                <?php elseif($isExpired): ?>
                                    Kadaluarsa <?php echo e($text); ?> lalu
                                <?php else: ?>
                                    <?php echo e($text); ?> lagi
                                <?php endif; ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td class="tg-0lax"><?php echo e($item->keterangan ?? '-'); ?></td>
                        <td class="tg-0lax">
                            <?php if($item->file): ?>
                                <?php echo e(basename($item->file)); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<br>

<br><br><br>

<script type="text/javascript">
    window.print();
</script>

</body>
</html><?php /**PATH F:\Project-2\audit-app\resources\views/print/prodi/mou.blade.php ENDPATH**/ ?>