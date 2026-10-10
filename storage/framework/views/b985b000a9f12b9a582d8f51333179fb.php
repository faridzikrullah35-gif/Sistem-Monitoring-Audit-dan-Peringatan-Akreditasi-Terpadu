<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA MAHASISWA PRODI (PD DIKTI)</title>
    <style type="text/css">
        * {
            font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin-right: 50px;
        }
        .tg td {
            font-size: 12px;
            padding: 8px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }
        .tg th {
            font-size: 12px;
            font-weight: bold;
            padding: 8px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
            background-color: #f2f2f2;
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
        .center-text { text-align: center; }
        .bold { font-weight: bold; }
        u { text-decoration: underline; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

<br><br>


<div class="form-group">
    <table class="static" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th rowspan="3">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75">
            </th>
            <th class="tg-0pky" style="width: 65%">FORMULIR</th>
            <td class="tg-0pky" style="width: 10%">No Dokumen</td>
            <td class="tg-0pky" style="width: 1%">:</td>
            <td class="tg-0pky" style="width: 25%"><?php echo e($headerNoDokumen ?? '-'); ?></td>
        </tr>
        <tr>
            <td class="tg-0pky" rowspan="2">
                <b><center>DATA MAHASISWA PRODI (PD DIKTI)</center></b>
            </td>
            <td class="tg-0pky">Tanggal Terbit</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky"><?php echo e($headerTanggalTerbit ?? '-'); ?></td>
        </tr>
        <tr>
            <td class="tg-0pky">No. Revisi</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky"><?php echo e($headerNoRevisi ?? '-'); ?></td>
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
                    <th rowspan="2" style="text-align:center; width: 4%;">No</th>
                    <th rowspan="2" style="text-align:center;">Tahun Akademik</th>
                    <th colspan="7" style="text-align:center;">Jumlah Mahasiswa</th>
                    <th rowspan="2" style="text-align:center;">Jumlah Lulusan Akhir TA</th>
                </tr>
                <tr>
                    <th style="text-align:center;">TA-6</th>
                    <th style="text-align:center;">TA-5</th>
                    <th style="text-align:center;">TA-4</th>
                    <th style="text-align:center;">TA-3</th>
                    <th style="text-align:center;">TA-2</th>
                    <th style="text-align:center;">TA-1</th>
                    <th style="text-align:center;">TA</th>
                </tr>
            </thead>
            <tbody>
                <?php if($mahasiswa->isEmpty()): ?>
                    <tr>
                        <td colspan="10" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data mahasiswa.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tg-0lax text-center"><?php echo e($i + 1); ?></td>
                        <td class="tg-0lax"><?php echo e($item->tahun_akademik ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ta_6 ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ta_5 ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ta_4 ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ta_3 ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ta_2 ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ta_1 ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ta ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->lulusan_akhir_ta ?? '-'); ?></td>
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
</html><?php /**PATH F:\Project-2\audit-app\resources\views/print/prodi/pd-dikti-mahasiswa.blade.php ENDPATH**/ ?>