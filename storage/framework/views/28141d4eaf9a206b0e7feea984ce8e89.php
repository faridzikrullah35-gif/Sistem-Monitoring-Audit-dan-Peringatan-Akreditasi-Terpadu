
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'tahun'    => '2025 - Genap',
    'status'   => 'Sedang Berjalan',
    'deadline' => '30 Mei 2026',
    'progress' => 75,
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
    'tahun'    => '2025 - Genap',
    'status'   => 'Sedang Berjalan',
    'deadline' => '30 Mei 2026',
    'progress' => 75,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="grid grid-cols-1 gap-4 md:grid-cols-4">
    <!-- Kartu 1 -->
    <div class="rounded-xl border-l-4 border-blue-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Tahun Akademik Aktif</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($tahun); ?></div>
    </div>

    <!-- Kartu 2 -->
    <div class="rounded-xl border-l-4 border-green-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Status Audit</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-green-600 dark:text-green-400"><?php echo e($status); ?></div>
    </div>

    <!-- Kartu 3 -->
    <div class="rounded-xl border-l-4 border-orange-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Deadline Pengisian</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-orange-600 dark:text-orange-400"><?php echo e($deadline); ?></div>
    </div>

    <!-- Kartu 4 -->
    <div class="rounded-xl border-l-4 border-purple-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Progress Pengisian</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-purple-600 dark:text-purple-400"><?php echo e($progress); ?>%</div>
        <div class="mt-2 h-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-2 rounded-full bg-purple-500" style="width: <?php echo e($progress); ?>%;"></div>
        </div>
    </div>
</div><?php /**PATH F:\Project-2\audit-app\resources\views/components/dashboard-fakultas/status-cards.blade.php ENDPATH**/ ?>