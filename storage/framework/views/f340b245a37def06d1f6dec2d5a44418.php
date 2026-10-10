<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'profil' => null
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'profil' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div id="rasioContainer" class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6" data-id="<?php echo e($profil->id ?? 0); ?>">
    <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white/90">Rasio Dosen : Mahasiswa</h4>
    
    <?php
        $totalDosen = ($profil->jumlah_magister ?? 0) + ($profil->jumlah_doktor ?? 0);
        $jumlahMahasiswa = $profil->jumlah_mahasiswa ?? 0;
        $rasio = $totalDosen > 0 ? round($jumlahMahasiswa / $totalDosen, 2) : 0;
    ?>

    <div class="flex items-center justify-between">
        <div>
            <div class="text-3xl font-bold text-gray-800 dark:text-white rasio-value">
                1 : <?php echo e($rasio); ?>

            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 rasio-detail">
                <span class="font-medium"><?php echo e($totalDosen); ?></span> Dosen : 
                <span class="font-medium"><?php echo e($jumlahMahasiswa); ?></span> Mahasiswa
            </p>
        </div>
        <div class="text-right">
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Otomatis
            </span>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4 border-t border-gray-200 pt-4 dark:border-gray-700">
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Total Dosen (S2 + S3)</p>
            <p class="text-lg font-semibold text-gray-800 dark:text-white">
                <span class="total-dosen"><?php echo e($totalDosen); ?></span>
                <span class="text-xs font-normal text-gray-500 dark:text-gray-400 detail-dosen">
                    (S2: <?php echo e($profil->jumlah_magister ?? 0); ?>, S3: <?php echo e($profil->jumlah_doktor ?? 0); ?>)
                </span>
            </p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Mahasiswa</p>
            <p class="text-lg font-semibold text-gray-800 dark:text-white total-mahasiswa">
                <?php echo e($jumlahMahasiswa); ?>

            </p>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict';

        // ============================================
        // REFRESH RASIO
        // ============================================
        function refreshRasio() {
            const container = document.getElementById('rasioContainer');
            if (!container) return;
            
            const profilId = container.dataset.id;
            if (!profilId || profilId === '0') return;
            
            const url = '<?php echo e(route("prodi.identitas-prodi.rasio", ["id" => ":id"])); ?>'.replace(':id', profilId);
            
            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status && data.data) {
                    const d = data.data;
                    
                    const rasioEl = container.querySelector('.rasio-value');
                    if (rasioEl) {
                        rasioEl.textContent = `1 : ${d.rasio}`;
                    }
                    
                    const detailEl = container.querySelector('.rasio-detail');
                    if (detailEl) {
                        detailEl.innerHTML = `
                            <span class="font-medium">${d.total_dosen}</span> Dosen : 
                            <span class="font-medium">${d.jumlah_mahasiswa}</span> Mahasiswa
                        `;
                    }
                    
                    const totalDosenEl = container.querySelector('.total-dosen');
                    if (totalDosenEl) {
                        totalDosenEl.textContent = d.total_dosen;
                    }
                    
                    const detailDosenEl = container.querySelector('.detail-dosen');
                    if (detailDosenEl) {
                        detailDosenEl.textContent = `(S2: ${d.jumlah_magister}, S3: ${d.jumlah_doktor})`;
                    }
                    
                    const totalMahasiswaEl = container.querySelector('.total-mahasiswa');
                    if (totalMahasiswaEl) {
                        totalMahasiswaEl.textContent = d.jumlah_mahasiswa;
                    }
                }
            })
            .catch(() => {});
        }

        // ============================================
        // OVERRIDE FUNCTION REFRESH DARI COMPONENT LAIN
        // ============================================
        function overrideRefresh(originalFn) {
            if (typeof window[originalFn] === 'function') {
                const original = window[originalFn];
                window[originalFn] = function() {
                    const result = original.apply(this, arguments);
                    setTimeout(refreshRasio, 500);
                    return result;
                };
            } else {
                setTimeout(function() {
                    overrideRefresh(originalFn);
                }, 1000);
            }
        }

        // ============================================
        // OBSERVER UNTUK DETECT PERUBAHAN DI TABLE
        // ============================================
        function setupObserver() {
            const tables = document.querySelectorAll('#dtpsTableBody, #mahasiswaTableBody');
            
            tables.forEach(table => {
                const observer = new MutationObserver(function() {
                    setTimeout(refreshRasio, 300);
                });
                
                observer.observe(table, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });
            });
        }

        // ============================================
        // INIT
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            overrideRefresh('refreshDtpsTable');
            overrideRefresh('refreshMahasiswaTable');
            setupObserver();
        });

        window.refreshRasio = refreshRasio;

    })();
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/identitas-prodi/rasio.blade.php ENDPATH**/ ?>