<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['publikasi']));

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

foreach (array_filter((['publikasi']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
    <div class="p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3 flex-wrap">
                <label for="filterTahunAkademik" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter Tahun Akademik:
                </label>
                
                <select 
                    id="filterTahunAkademik" 
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    <?php
                        $tahunList = $publikasi->pluck('tahun_akademik')->unique()->sort()->values();
                    ?>
                    <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tahun); ?>"><?php echo e($tahun); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <button 
                    type="button"
                    onclick="resetFilterPublikasi()"
                    class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </button>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span id="totalDataDisplay">Total: <span class="font-semibold text-gray-700 dark:text-gray-300"><?php echo e($publikasi->count()); ?></span> data</span>
                </div>
                
                <?php if($publikasi->count() > 0): ?>
                    <div class="text-xs text-gray-400 dark:text-gray-500">
                        <span id="visibleDataDisplay">Menampilkan: <span class="font-semibold text-gray-600 dark:text-gray-400"><?php echo e($publikasi->count()); ?></span></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterSelect = document.getElementById('filterTahunAkademik');
    const rows = document.querySelectorAll('.publikasi-row');
    const totalDisplay = document.getElementById('totalDataDisplay');
    const visibleDisplay = document.getElementById('visibleDataDisplay');

    // Filter function
    window.filterPublikasiTable = function() {
        if (!filterSelect) return;
        
        const selectedTahun = filterSelect.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const tahun = row.dataset.tahun;
            if (selectedTahun === '' || tahun === selectedTahun) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update nomor urut
        let counter = 1;
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const td = row.querySelector('td:first-child');
                if (td) {
                    td.textContent = counter++;
                }
            }
        });

        // Update total data
        if (totalDisplay) {
            const total = rows.length;
            const span = totalDisplay.querySelector('.font-semibold');
            if (span) span.textContent = total;
        }

        // Update visible data
        if (visibleDisplay) {
            const span = visibleDisplay.querySelector('.font-semibold');
            if (span) span.textContent = visibleCount;
        }

        // Handle empty state
        const tbody = document.getElementById('publikasiTableBody');
        const emptyStateRow = document.getElementById('emptyStateRow');
        const hasData = rows.length > 0;
        const hasVisible = visibleCount > 0;

        if (hasData && !hasVisible) {
            // Remove existing empty state if any
            const existingEmpty = tbody.querySelector('.filter-empty-row');
            if (existingEmpty) existingEmpty.remove();
            
            // Create filtered empty state
            const tr = document.createElement('tr');
            tr.className = 'filter-empty-row';
            tr.innerHTML = `
                <td colspan="13" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada data untuk tahun <span class="font-semibold">${selectedTahun}</span></p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Ubah filter atau tambahkan data baru</p>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
            
            // Hide original empty state if exists
            if (emptyStateRow) emptyStateRow.style.display = 'none';
        } else if (hasVisible) {
            // Remove filtered empty state
            const filteredEmpty = tbody.querySelector('.filter-empty-row');
            if (filteredEmpty) filteredEmpty.remove();
            
            // Show original empty state if no data at all
            if (emptyStateRow && rows.length === 0) {
                emptyStateRow.style.display = '';
            } else if (emptyStateRow) {
                emptyStateRow.style.display = 'none';
            }
        } else if (!hasData && !hasVisible) {
            // No data at all, show original empty state
            if (emptyStateRow) emptyStateRow.style.display = '';
            const filteredEmpty = tbody.querySelector('.filter-empty-row');
            if (filteredEmpty) filteredEmpty.remove();
        }
    };

    // Event listener untuk filter
    if (filterSelect) {
        filterSelect.addEventListener('change', window.filterPublikasiTable);
    }

    // Re-run filter after initial load
    setTimeout(window.filterPublikasiTable, 100);
});

// Reset filter
window.resetFilterPublikasi = function() {
    const filterSelect = document.getElementById('filterTahunAkademik');
    if (filterSelect) {
        filterSelect.value = '';
        filterSelect.dispatchEvent(new Event('change'));
    }
};

// Refresh function untuk update filter setelah CRUD
window.refreshPublikasiTable = function() {
    fetch(window.location.href, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Update tbody
        const newTbody = doc.querySelector('#publikasiTableBody');
        const currentTbody = document.getElementById('publikasiTableBody');
        if (newTbody && currentTbody) {
            currentTbody.innerHTML = newTbody.innerHTML;
        }
        
        // Update filter options
        const newFilterSelect = doc.querySelector('#filterTahunAkademik');
        const currentFilterSelect = document.getElementById('filterTahunAkademik');
        if (newFilterSelect && currentFilterSelect) {
            const selectedValue = currentFilterSelect.value;
            currentFilterSelect.innerHTML = newFilterSelect.innerHTML;
            currentFilterSelect.value = selectedValue;
        }
        
        // Re-initialize rows
        const rows = document.querySelectorAll('.publikasi-row');
        
        // Re-run filter
        if (window.filterPublikasiTable) {
            window.filterPublikasiTable();
        }
        
        // Update total display
        const totalDisplay = document.getElementById('totalDataDisplay');
        if (totalDisplay) {
            const total = rows.length;
            const span = totalDisplay.querySelector('.font-semibold');
            if (span) span.textContent = total;
        }
    })
    .catch(error => {
        console.error('Error refreshing table:', error);
        // Fallback: reload page
        location.reload();
    });
};

// Update filter options setelah CRUD
window.updateFilterOptionsPublikasi = function(tahunList) {
    const filterSelect = document.getElementById('filterTahunAkademik');
    if (!filterSelect) return;
    
    const currentValue = filterSelect.value;
    filterSelect.innerHTML = '<option value="">Semua Tahun</option>';
    
    if (tahunList && tahunList.length > 0) {
        tahunList.forEach(tahun => {
            const option = document.createElement('option');
            option.value = tahun;
            option.textContent = tahun;
            filterSelect.appendChild(option);
        });
    }
    
    // Restore selected value jika masih ada
    if (currentValue && [...filterSelect.options].some(opt => opt.value === currentValue)) {
        filterSelect.value = currentValue;
    } else {
        filterSelect.value = '';
    }
};

// ============================================================
//  HANDLE PRINT PUBLIKASI ILMIAH (dengan filter aktif)
// ============================================================
window.handlePrintPublikasi = function(event) {
    if (event) event.preventDefault();

    // Baca filter tahun yang aktif dari DOM
    const filterTahun = document.getElementById('filterTahunAkademik')?.value || '';

    // Base URL print
    const baseUrl = '<?php echo e(route("prodi.publikasi-ilmiah.print")); ?>';

    // Bangun query string
    const params = new URLSearchParams();
    if (filterTahun) params.append('tahun_akademik', filterTahun);

    const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;

    // Buka tab baru
    window.open(url, '_blank');
    return false;
};
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/prodi-publikasi-ilmiah/filter-section.blade.php ENDPATH**/ ?>