<?php
    // Ambil semua data struktur organisasi
    $strukturs = App\Models\StrukturOrganisasi::with('user')
        ->orderBy('urutan', 'asc')
        ->get();

    // Kelompokkan berdasarkan jabatan
    $kepalaLPM = $strukturs->filter(function($item) {
        return str_contains($item->jabatan, 'Kepala Lembaga') ||
               str_contains($item->jabatan, 'Kepala LPM');
    })->first();

    $wakilKepala = $strukturs->filter(function($item) {
        return str_contains($item->jabatan, 'Wakil Kepala');
    })->first();

    $sekretaris = $strukturs->filter(function($item) {
        return str_contains($item->jabatan, 'Sekretaris');
    })->first();

    $kepalaBidang = $strukturs->filter(function($item) {
        return str_contains($item->jabatan, 'Koordinator') ||
               str_contains($item->jabatan, 'Kepala Bidang');
    })->all();

    $staff = $strukturs->filter(function($item) {
        return !str_contains($item->jabatan, 'Kepala Lembaga') &&
               !str_contains($item->jabatan, 'Kepala LPM') &&
               !str_contains($item->jabatan, 'Wakil Kepala') &&
               !str_contains($item->jabatan, 'Sekretaris') &&
               !str_contains($item->jabatan, 'Koordinator') &&
               !str_contains($item->jabatan, 'Kepala Bidang');
    })->all();

    $tier1 = array_filter([$wakilKepala, $sekretaris]);
    $hasTier1 = count($tier1) > 0;
    $hasTier2 = count($kepalaBidang) > 0;
    $hasTier3 = count($staff) > 0;

    // Helper avatar fallback (SVG data URI, dipakai berulang)
    $ocAvatarFallback = function ($size) {
        return "data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22{$size}%22 height=%22{$size}%22%3E%3Crect fill=%22%23eef1f6%22 width=%22{$size}%22 height=%22{$size}%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2218%22 fill=%22%23a0aec0%22%3E%F0%9F%91%A4%3C/text%3E%3C/svg%3E";
    };
?>

<section class="oc-section" id="struktur">
    <div class="oc-container">

        <div class="oc-heading reveal">
            <span class="oc-eyebrow">Struktur Organisasi</span>
            <h2 class="oc-title">Struktur Organisasi <span>Lembaga Penjaminan Mutu</span></h2>
            <p class="oc-subtitle">Pengelola mutu yang berdedikasi untuk kemajuan UM Banjarmasin.</p>
        </div>

        <?php if($strukturs->count() == 0): ?>
        <div class="oc-empty reveal">
            <div class="oc-empty-icon"><i class="fas fa-users"></i></div>
            <h3>Belum Ada Data Struktur Organisasi</h3>
            <p>Silakan tambahkan data struktur organisasi melalui admin panel.</p>
        </div>
        <?php else: ?>
        <div class="oc-chart reveal" id="ocChart">

            
            <?php if($kepalaLPM): ?>
            <div class="oc-tier oc-tier--root">
                <div class="oc-node oc-node--root">
                    <div class="oc-photo">
                        <img
                            src="<?php echo e($kepalaLPM->foto ? asset('storage/struktur_organisasi/' . $kepalaLPM->foto) : asset('images/default-avatar.png')); ?>"
                            alt="<?php echo e($kepalaLPM->nama); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e($ocAvatarFallback(80)); ?>'">
                    </div>
                    <div class="oc-info">
                        <span class="oc-label oc-label--root">Kepala</span>
                        <span class="oc-name"><?php echo e($kepalaLPM->nama); ?></span>
                    </div>
                </div>
            </div>

            <?php if($hasTier1): ?>
            <div class="oc-connector" data-target="ocTier1">
                <button type="button" class="oc-toggle" aria-label="Perluas/tutup">&minus;</button>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            
            <?php if($hasTier1): ?>
            <div class="oc-tier oc-tier--row" id="ocTier1">
                <?php if($wakilKepala): ?>
                <div class="oc-node oc-node--tier1">
                    <div class="oc-photo">
                        <img
                            src="<?php echo e($wakilKepala->foto ? asset('storage/struktur_organisasi/' . $wakilKepala->foto) : asset('images/default-avatar.png')); ?>"
                            alt="<?php echo e($wakilKepala->nama); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e($ocAvatarFallback(64)); ?>'">
                    </div>
                    <div class="oc-info">
                        <span class="oc-label oc-label--tier1">Wakil</span>
                        <span class="oc-name"><?php echo e($wakilKepala->nama); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($sekretaris): ?>
                <div class="oc-node oc-node--tier1">
                    <div class="oc-photo">
                        <img
                            src="<?php echo e($sekretaris->foto ? asset('storage/struktur_organisasi/' . $sekretaris->foto) : asset('images/default-avatar.png')); ?>"
                            alt="<?php echo e($sekretaris->nama); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e($ocAvatarFallback(64)); ?>'">
                    </div>
                    <div class="oc-info">
                        <span class="oc-label oc-label--tier1">Sekretaris</span>
                        <span class="oc-name"><?php echo e($sekretaris->nama); ?></span>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php if($hasTier2): ?>
            <div class="oc-connector" data-target="ocTier2">
                <button type="button" class="oc-toggle" aria-label="Perluas/tutup">&minus;</button>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            
            <?php if($hasTier2): ?>
            <div class="oc-tier oc-tier--row" id="ocTier2">
                <?php $__currentLoopData = $kepalaBidang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="oc-node oc-node--tier2">
                    <div class="oc-photo">
                        <img
                            src="<?php echo e($item->foto ? asset('storage/struktur_organisasi/' . $item->foto) : asset('images/default-avatar.png')); ?>"
                            alt="<?php echo e($item->nama); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e($ocAvatarFallback(64)); ?>'">
                    </div>
                    <div class="oc-info">
                        <span class="oc-label oc-label--tier2">Koordinator</span>
                        <span class="oc-name"><?php echo e($item->nama); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($hasTier3): ?>
            <div class="oc-connector" data-target="ocTier3">
                <button type="button" class="oc-toggle" aria-label="Perluas/tutup">&minus;</button>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            
            <?php if($hasTier3): ?>
            <div class="oc-tier oc-tier--row oc-tier--wrap" id="ocTier3">
                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="oc-node oc-node--leaf">
                    <div class="oc-photo">
                        <img
                            src="<?php echo e($item->foto ? asset('storage/struktur_organisasi/' . $item->foto) : asset('images/default-avatar.png')); ?>"
                            alt="<?php echo e($item->nama); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e($ocAvatarFallback(56)); ?>'">
                    </div>
                    <div class="oc-info">
                        <span class="oc-label oc-label--leaf"><?php echo e($item->jabatan); ?></span>
                        <span class="oc-name"><?php echo e($item->nama); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

        </div>
        <?php endif; ?>

    </div>
</section>

<style>
    /* ===================== Variabel warna khusus org chart ===================== */
    #struktur {
        --oc-root: var(--primary);
        --oc-tier1: var(--secondary, #1d4e89);
        --oc-tier2: #2a8fd6;
        --oc-leaf: #4caf6e;
        --oc-line: #c7cdd6;
    }

    /* ===================== Layout dasar ===================== */
    .oc-section { padding: 90px 20px 100px; background: var(--bg); overflow-x: auto; }
    .oc-container { max-width: 1200px; margin: 0 auto; }

    /* ===================== Heading ===================== */
    .oc-heading { text-align: center; max-width: 640px; margin: 0 auto 60px; }
    .oc-eyebrow {
        display: inline-block; font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase; color: var(--primary);
        background: color-mix(in srgb, var(--primary) 10%, transparent);
        padding: 6px 16px; border-radius: 999px; margin-bottom: 16px;
    }
    .oc-title { font-family: 'Poppins', sans-serif; font-size: clamp(26px, 4vw, 34px); font-weight: 700; color: var(--text); line-height: 1.3; margin: 0 0 12px; }
    .oc-title span { color: var(--primary); }
    .oc-subtitle { font-family: 'Inter', sans-serif; font-size: 15px; color: var(--text-light); line-height: 1.6; margin: 0; }

    /* ===================== Chart wrapper ===================== */
    .oc-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 680px;
        width: fit-content;
        margin: 0 auto;
    }

    /* ===================== Connector (garis + tombol toggle) ===================== */
    .oc-connector {
        position: relative;
        width: 1px;
        height: 40px;
        background: var(--oc-line);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .oc-toggle {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 1px solid var(--oc-line);
        background: var(--white);
        color: var(--text-light);
        font-size: 14px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        transition: transform 0.2s ease, color 0.2s ease, border-color 0.2s ease;
    }
    .oc-toggle:hover { color: var(--primary); border-color: var(--primary); transform: scale(1.1); }

    /* ===================== Tier: baris berisi beberapa node dengan bus line ===================== */
    .oc-tier { position: relative; }
    .oc-tier--root { padding-bottom: 0; }

    .oc-tier--row {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 32px;
        padding-top: 34px;
        margin-bottom: 4px;
    }
    .oc-tier--wrap { flex-wrap: wrap; row-gap: 34px; }

    /* garis horizontal (bus) di atas baris */
    .oc-tier--row::before {
        content: '';
        position: absolute;
        top: 0;
        left: 8%;
        right: 8%;
        height: 1px;
        background: var(--oc-line);
    }
    .oc-tier--row:has(> .oc-node:only-child)::before { left: 50%; right: 50%; }

    /* garis vertikal turun dari bus ke setiap node */
    .oc-node { position: relative; }
    .oc-tier--row > .oc-node::before {
        content: '';
        position: absolute;
        top: -34px;
        left: 50%;
        width: 1px;
        height: 34px;
        background: var(--oc-line);
    }

    /* ===================== Kartu node ===================== */
    /* Lebar mengikuti konten (auto), dibatasi min/max agar tetap rapi.
       Teks tidak lagi dipotong (ellipsis) - dibiarkan wrap ke baris baru bila
       melebihi max-width, sehingga tidak ada data yang hilang dari tampilan. */
    .oc-node {
        display: inline-grid;
        grid-template-columns: auto 1fr;
        grid-template-rows: auto auto;
        align-items: stretch;
        background: var(--white);
        border: 1px solid var(--oc-line);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        width: max-content;
        min-width: 210px;
        max-width: 340px;
        flex-shrink: 0;
    }
    .oc-node:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px -10px rgba(15, 23, 42, 0.18);
        z-index: 2;
    }
    .oc-node--root { min-width: 260px; max-width: 400px; }
    .oc-node--leaf { min-width: 190px; max-width: 300px; }

    .oc-photo {
        grid-row: 1 / 3;
        width: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f4f9;
        border-right: 1px solid var(--oc-line);
        flex-shrink: 0;
    }
    .oc-node--root .oc-photo { width: 74px; }
    .oc-photo img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; flex-shrink: 0; }
    .oc-node--root .oc-photo img { width: 52px; height: 52px; }

    .oc-info { display: flex; flex-direction: column; min-width: 0; }
    .oc-label {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        color: var(--white);
        padding: 8px 12px;
        white-space: normal;
        overflow-wrap: break-word;
        word-break: break-word;
        line-height: 1.35;
    }
    .oc-label--root { background: var(--oc-root); font-size: 13px; padding: 12px 14px; }
    .oc-label--tier1 { background: var(--oc-tier1); }
    .oc-label--tier2 { background: var(--oc-tier2); }
    .oc-label--leaf { background: var(--oc-leaf); }

    .oc-name {
        font-family: 'Inter', sans-serif;
        font-style: italic;
        font-size: 13px;
        color: var(--text);
        padding: 8px 12px;
        display: flex;
        align-items: center;
        flex: 1;
        white-space: normal;
        overflow-wrap: break-word;
        word-break: break-word;
        line-height: 1.35;
    }
    .oc-node--root .oc-name { font-size: 14px; padding: 10px 14px; }

    /* ===================== Collapsed state ===================== */
    .oc-tier.oc-collapsed,
    .oc-connector.oc-collapsed-line + .oc-tier { display: none; }
    .oc-hidden { display: none !important; }

    /* ===================== Empty state ===================== */
    .oc-empty { text-align: center; padding: 60px 24px; background: var(--white); border: 1px dashed color-mix(in srgb, var(--text) 15%, transparent); border-radius: 20px; }
    .oc-empty-icon { font-size: 40px; color: #94a3b8; margin-bottom: 16px; }
    .oc-empty h3 { font-family: 'Poppins', sans-serif; font-size: 18px; color: #64748b; margin: 0 0 8px; }
    .oc-empty p { font-family: 'Inter', sans-serif; font-size: 14px; color: #94a3b8; margin: 0; }

    /* ===================== Reveal animation ===================== */
    .reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.is-visible, .reveal:not([class*="js-reveal"]) { opacity: 1; transform: translateY(0); }

    /* ===================== Responsive ===================== */
    @media (max-width: 768px) {
        .oc-section { padding: 60px 16px 70px; }
        .oc-node { width: 200px; }
        .oc-node--leaf { width: 170px; }
        .oc-tier--row { gap: 20px; }
    }
</style>

<script>
(function () {
    document.querySelectorAll('#struktur .oc-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var connector = btn.closest('.oc-connector');
            var targetId = connector.getAttribute('data-target');
            var target = document.getElementById(targetId);
            if (!target) return;

            var willHide = !target.classList.contains('oc-hidden');
            target.classList.toggle('oc-hidden', willHide);
            btn.textContent = willHide ? '+' : '\u2212';

            // Sembunyikan juga semua tier & connector di bawahnya (efek cascade)
            var node = target.nextElementSibling;
            while (node) {
                node.classList.toggle('oc-hidden', willHide);
                node = node.nextElementSibling;
            }
        });
    });
})();
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/landing/structure.blade.php ENDPATH**/ ?>