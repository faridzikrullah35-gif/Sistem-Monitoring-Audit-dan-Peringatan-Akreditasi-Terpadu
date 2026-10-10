<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA PENELITIAN DOSEN FAKULTAS</title>
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


<div class="form-group">
    <table class="static" rules="all" border="1px">
        <tr>
            <th rowspan="3" style="width: 80px;">
                <img src="https://lpm.umbjm.ac.id/img/logo/a.png" height="70" width="75">
            </th>
            <th class="tg-0pky" style="width: 65%">FORMULIR</th>
            <td class="tg-0pky" style="width: 10%">No Dokumen</td>
            <td class="tg-0pky" style="width: 1%">:</td>
            <td class="tg-0pky" style="width: 25%"><?php echo e($headerNoDokumen ?? '-'); ?></td>
        </tr>
        <tr>
            <td class="tg-0pky" rowspan="2">
                <b><center>DATA PENELITIAN DOSEN FAKULTAS</center></b>
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
        <table class="no-border-table" style="width: 100%;">
            <tr>
                <td style="width: 15%">Fakultas</td>
                <td style="width: 2%; text-align:center;">:</td>
                <td><u><?php echo e($namaFakultas); ?></u></td>
            </tr>
            <tr>
                <td>Unit</td>
                <td style="text-align:center;">:</td>
                <td><u><?php echo e($unit); ?></u></td>
            </tr>
            <?php if(!empty($filterInfo)): ?>
            <tr>
                <td>Filter</td>
                <td style="text-align:center;">:</td>
                <td><b><?php echo e($filterInfo); ?></b></td>
            </tr>
            <?php endif; ?>
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
                    <th>Ketua/Anggota</th>
                    <th>Nama Dosen</th>
                    <th style="min-width: 200px;">Judul Penelitian</th>
                    <th>Lembaga Mitra</th>
                    <th>Tingkat</th>
                    <th>Tahun Akademik</th>
                    <th>Skema</th>
                    <th>Sumber Dana</th>
                    <th>Luaran</th>
                </tr>
            </thead>
            <tbody>
                <?php if($penelitian->isEmpty()): ?>
                    <tr>
                        <td colspan="11" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data penelitian.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $__currentLoopData = $penelitian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tg-0lax text-center"><?php echo e($i + 1); ?></td>
                        <td class="tg-0lax"><?php echo e(optional($item->user)->sub_unit ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->ketua_anggota ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->nama_dosen ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->judul_penelitian ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->lembaga_mitra ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->tingkat ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->tahun_akademik ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->skema ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->sumber_dana ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->luaran ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    window.print();
</script>

</body>
</html><?php /**PATH F:\Project-2\audit-app\resources\views/print/fakultas/penelitian.blade.php ENDPATH**/ ?>