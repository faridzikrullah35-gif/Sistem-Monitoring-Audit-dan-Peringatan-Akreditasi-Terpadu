<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['pageTitle' => 'Page']));

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

foreach (array_filter((['pageTitle' => 'Page']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $segments = request()->segments();
    $url = url('/');
    
    // Mapping untuk mengubah segment URL menjadi label yang lebih baik
    $segmentLabels = [
        'sarpras' => 'Sarana Prasarana',
        // Tambahkan mapping lain jika diperlukan
        // 'ptk' => 'PTK',
        // 'akreditasi' => 'Akreditasi',
    ];
?>

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
        <?php echo e($pageTitle); ?>

    </h2>

    <nav>
        <ol class="flex items-center gap-1.5">

            
            <?php
                $dashboardRoute = match(auth()->user()->role) {
                    'admin'      => 'admin.dashboard',
                    'auditor'    => 'auditor.dashboard',
                    'prodi'      => 'prodi.dashboard',
                    'unit_kerja' => 'auditor.dashboard',
                    default      => 'auditor.dashboard',
                };
            ?>

            <li>
                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                href="<?php echo e(route($dashboardRoute)); ?>">

                    Home

                    <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none">
                        <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                            stroke="currentColor"
                            stroke-width="1.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </svg>

                </a>
            </li>

            
            <?php
                $hiddenSegments = [
                    'others',
                    auth()->user()->role,
                ];

                $filteredSegments = array_values(array_filter(
                    $segments,
                    fn($s) => !in_array($s, $hiddenSegments)
                ));
            ?>

            <?php $__currentLoopData = $filteredSegments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $segment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $url .= '/' . $segment;
                    
                    // Cek apakah ada mapping khusus untuk segment ini
                    $name = $segmentLabels[$segment] ?? ucfirst(str_ireplace('ptk', 'PTK', str_replace('-', ' ', $segment)));
                    
                    // Jika segment adalah 'sarpras' dan ini adalah segment terakhir, 
                    // dan pageTitle mengandung "Kelola", tampilkan "Kelola Sarana Prasarana"
                    if ($segment === 'sarpras' && $loop->last && str_contains($pageTitle, 'Kelola')) {
                        $name = 'Kelola Sarana Prasarana';
                    }
                ?>

                <?php if($loop->last): ?>
                    <li class="text-sm text-gray-800 dark:text-white/90">
                        <?php echo e($name); ?>

                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e($url); ?>"
                        class="text-sm text-gray-500 dark:text-gray-400">
                            <?php echo e($name); ?>

                        </a>
                    </li>

                    <li class="text-gray-400">/</li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ol>
    </nav>
</div><?php /**PATH F:\Project-2\audit-app\resources\views/components/common/page-breadcrumb.blade.php ENDPATH**/ ?>