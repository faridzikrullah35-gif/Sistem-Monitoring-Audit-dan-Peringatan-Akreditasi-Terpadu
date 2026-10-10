
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'total'  => 0,
    'sudah'  => 0,
    'belum'  => 0,
    'persen' => 0,
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
    'total'  => 0,
    'sudah'  => 0,
    'belum'  => 0,
    'persen' => 0,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800">
    <div class="mb-3 flex items-center gap-2">
        <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Progress Pengisian AMI</h2>
    </div>
    <div class="grid grid-cols-3 gap-4 text-center">
        <div class="rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
            <p class="text-xs text-gray-500 dark:text-gray-400">Total Pertanyaan</p>
            <p class="text-2xl font-bold dark:text-white"><?php echo e($total); ?></p>
        </div>
        <div class="rounded-lg bg-green-50 p-3 dark:bg-green-900/30">
            <p class="text-xs text-gray-500 dark:text-gray-400">Sudah Dijawab</p>
            <p class="text-2xl font-bold text-green-600 dark:text-green-400"><?php echo e($sudah); ?></p>
        </div>
        <div class="rounded-lg bg-red-50 p-3 dark:bg-red-900/30">
            <p class="text-xs text-gray-500 dark:text-gray-400">Belum Dijawab</p>
            <p class="text-2xl font-bold text-red-500 dark:text-red-400"><?php echo e($belum); ?></p>
        </div>
    </div>
    <div class="mt-3">
        <div class="mb-1 flex justify-between text-sm">
            <span class="dark:text-gray-300">Pengisian</span>
            <span class="dark:text-gray-300"><?php echo e($persen); ?>%</span>
        </div>
        <div class="h-3 w-full rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-3 rounded-full bg-blue-500" style="width: <?php echo e($persen); ?>%;"></div>
        </div>
    </div>
</div><?php /**PATH F:\Project-2\audit-app\resources\views/components/dashboard-auditee/progress-ami.blade.php ENDPATH**/ ?>