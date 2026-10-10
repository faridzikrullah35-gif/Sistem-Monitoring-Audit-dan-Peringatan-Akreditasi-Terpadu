<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA DOSEN PRODI</title>
    <style type="text/css">
        * { font-family: 'Aptos Display', 'Aptos', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        .tg { border-collapse: collapse; border-spacing: 0; margin-right: 50px; }
        .tg td { font-size: 10px; padding: 6px 4px; border: 1px solid black; overflow: hidden; word-break: normal; }
        .tg th { font-size: 10px; font-weight: bold; padding: 6px 4px; border: 1px solid black; background-color: #f2f2f2; }
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
                <b><center>DATA DOSEN PRODI</center></b>
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
                    <th rowspan="2" style="text-align:center; width: 3%;">No</th>
                    <th rowspan="2" style="text-align:center;">Nama</th>
                    <th colspan="5" style="text-align:center;">Pendidikan</th>
                    <th colspan="2" style="text-align:center;">Sertifikasi & Jabatan</th>
                    <th colspan="2" style="text-align:center;">Posisi / Jabatan</th>
                    <th colspan="4" style="text-align:center;">Status & Identitas</th>
                </tr>
                <tr>
                    <th style="text-align:center;">Latar Pendidikan</th>
                    <th style="text-align:center;">Doktor</th>
                    <th style="text-align:center;">Magister</th>
                    <th style="text-align:center;">Sarjana</th>
                    <th style="text-align:center;">Instansi Asal</th>
                    <th style="text-align:center;">Sertifikasi</th>
                    <th style="text-align:center;">Jabatan Akademik</th>
                    <th style="text-align:center;">Posisi / Jabatan</th>
                    <th style="text-align:center;">Tgl Mulai</th>
                    <th style="text-align:center;">SK Dosen Tetap</th>
                    <th style="text-align:center;">Status</th>
                    <th style="text-align:center;">NIDN</th>
                    <th style="text-align:center;">NUPTK</th>
                </tr>
            </thead>
            <tbody>
                <?php if($dosen->isEmpty()): ?>
                    <tr>
                        <td colspan="14" style="text-align: center; font-style: italic; color: #888;">
                            Belum ada data dosen.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="tg-0lax text-center"><?php echo e($i + 1); ?></td>
                        <td class="tg-0lax"><?php echo e($item->nama ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->latar_pendidikan ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->doktor ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->magister ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->sarjana ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->nama_instansi_asal ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->sertifikasi ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->jabatan_akademik ?? '-'); ?></td>
                        <td class="tg-0lax"><?php echo e($item->posisi_jabatan ?? '-'); ?></td>
                        <td class="tg-0lax text-center">
                            <?php echo e($item->terhitung_mulai_tanggal
                                ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y')
                                : '-'); ?>

                        </td>
                        <td class="tg-0lax"><?php echo e($item->sk_dosen_tetap ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->status ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->nidn ?? '-'); ?></td>
                        <td class="tg-0lax text-center"><?php echo e($item->nuptk ?? '-'); ?></td>
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
</html><?php /**PATH F:\Project-2\audit-app\resources\views/print/prodi/sdm-dosen.blade.php ENDPATH**/ ?>