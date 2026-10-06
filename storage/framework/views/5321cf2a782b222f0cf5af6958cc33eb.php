

<?php $__env->startSection('title', 'Pendidikan Fakultas | SIMANTAP'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <?php if (isset($component)) { $__componentOriginald07245451647f5715f9bac44fc38d4f4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald07245451647f5715f9bac44fc38d4f4 = $attributes; } ?>
<?php $component = App\View\Components\Common\PageBreadcrumb::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.page-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Common\PageBreadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageTitle' => 'Pendidikan Fakultas']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald07245451647f5715f9bac44fc38d4f4)): ?>
<?php $attributes = $__attributesOriginald07245451647f5715f9bac44fc38d4f4; ?>
<?php unset($__attributesOriginald07245451647f5715f9bac44fc38d4f4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald07245451647f5715f9bac44fc38d4f4)): ?>
<?php $component = $__componentOriginald07245451647f5715f9bac44fc38d4f4; ?>
<?php unset($__componentOriginald07245451647f5715f9bac44fc38d4f4); ?>
<?php endif; ?>

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Pendidikan
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Data pendidikan dari program studi di bawah fakultas
            </p>
        </div>
    </div>

    
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0118 15.5c0 1.933-2.686 3.5-6 3.5s-6-1.567-6-3.5c0-.815.3-1.572.84-2.222L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 9v6" />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data Pendidikan Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini menampilkan data kurikulum, pengajaran, dan bimbingan
                    dari program studi di bawah fakultas ini (read-only).
                </p>
            </div>
        </div>
    </div>

    
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Kurikulum</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data kurikulum program studi beserta dokumen penetapannya
            </p>
        </div>

        <?php if (isset($component)) { $__componentOriginal2bc4c95eeeec9114a13be09168f593d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2bc4c95eeeec9114a13be09168f593d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pendidikan.prodi-kurikulum.filter-section','data' => ['kurikulums' => $kurikulums,'tahunKurikulumList' => $tahunKurikulumList,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pendidikan.prodi-kurikulum.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kurikulums' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kurikulums),'tahunKurikulumList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunKurikulumList),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2bc4c95eeeec9114a13be09168f593d7)): ?>
<?php $attributes = $__attributesOriginal2bc4c95eeeec9114a13be09168f593d7; ?>
<?php unset($__attributesOriginal2bc4c95eeeec9114a13be09168f593d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2bc4c95eeeec9114a13be09168f593d7)): ?>
<?php $component = $__componentOriginal2bc4c95eeeec9114a13be09168f593d7; ?>
<?php unset($__componentOriginal2bc4c95eeeec9114a13be09168f593d7); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal0cf3dcdcd39e7673a72eebbab7ddd562 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0cf3dcdcd39e7673a72eebbab7ddd562 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pendidikan.prodi-kurikulum.data-table','data' => ['kurikulums' => $kurikulums]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pendidikan.prodi-kurikulum.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kurikulums' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kurikulums)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0cf3dcdcd39e7673a72eebbab7ddd562)): ?>
<?php $attributes = $__attributesOriginal0cf3dcdcd39e7673a72eebbab7ddd562; ?>
<?php unset($__attributesOriginal0cf3dcdcd39e7673a72eebbab7ddd562); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0cf3dcdcd39e7673a72eebbab7ddd562)): ?>
<?php $component = $__componentOriginal0cf3dcdcd39e7673a72eebbab7ddd562; ?>
<?php unset($__componentOriginal0cf3dcdcd39e7673a72eebbab7ddd562); ?>
<?php endif; ?>
    </div>

    
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Pengajaran</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data SK pengajaran program studi beserta penetapannya
            </p>
        </div>

        <?php if (isset($component)) { $__componentOriginal9f1a1759d533ac8f445ab1a44451a40b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f1a1759d533ac8f445ab1a44451a40b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pendidikan.prodi-pengajaran.filter-section','data' => ['pengajarans' => $pengajarans,'tahunPengajaranList' => $tahunPengajaranList,'semesterPengajaranList' => $semesterPengajaranList,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pendidikan.prodi-pengajaran.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pengajarans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengajarans),'tahunPengajaranList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunPengajaranList),'semesterPengajaranList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($semesterPengajaranList),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f1a1759d533ac8f445ab1a44451a40b)): ?>
<?php $attributes = $__attributesOriginal9f1a1759d533ac8f445ab1a44451a40b; ?>
<?php unset($__attributesOriginal9f1a1759d533ac8f445ab1a44451a40b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f1a1759d533ac8f445ab1a44451a40b)): ?>
<?php $component = $__componentOriginal9f1a1759d533ac8f445ab1a44451a40b; ?>
<?php unset($__componentOriginal9f1a1759d533ac8f445ab1a44451a40b); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal8bef7d26f32bd50d0dd8227882591f1e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8bef7d26f32bd50d0dd8227882591f1e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pendidikan.prodi-pengajaran.data-table','data' => ['pengajarans' => $pengajarans]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pendidikan.prodi-pengajaran.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pengajarans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengajarans)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8bef7d26f32bd50d0dd8227882591f1e)): ?>
<?php $attributes = $__attributesOriginal8bef7d26f32bd50d0dd8227882591f1e; ?>
<?php unset($__attributesOriginal8bef7d26f32bd50d0dd8227882591f1e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8bef7d26f32bd50d0dd8227882591f1e)): ?>
<?php $component = $__componentOriginal8bef7d26f32bd50d0dd8227882591f1e; ?>
<?php unset($__componentOriginal8bef7d26f32bd50d0dd8227882591f1e); ?>
<?php endif; ?>
    </div>

    
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Bimbingan</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data bimbingan program studi beserta dokumen penetapannya
            </p>
        </div>

        <?php if (isset($component)) { $__componentOriginaldb972da710d3bf64642ebf8eb8efa793 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb972da710d3bf64642ebf8eb8efa793 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pendidikan.prodi-bimbingan.filter-section','data' => ['bimbingans' => $bimbingans,'tahunBimbinganList' => $tahunBimbinganList,'semesterBimbinganList' => $semesterBimbinganList,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pendidikan.prodi-bimbingan.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bimbingans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bimbingans),'tahunBimbinganList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunBimbinganList),'semesterBimbinganList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($semesterBimbinganList),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb972da710d3bf64642ebf8eb8efa793)): ?>
<?php $attributes = $__attributesOriginaldb972da710d3bf64642ebf8eb8efa793; ?>
<?php unset($__attributesOriginaldb972da710d3bf64642ebf8eb8efa793); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb972da710d3bf64642ebf8eb8efa793)): ?>
<?php $component = $__componentOriginaldb972da710d3bf64642ebf8eb8efa793; ?>
<?php unset($__componentOriginaldb972da710d3bf64642ebf8eb8efa793); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginaldf419535029d1a7d89eebcadb151354a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf419535029d1a7d89eebcadb151354a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pendidikan.prodi-bimbingan.data-table','data' => ['bimbingans' => $bimbingans]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pendidikan.prodi-bimbingan.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bimbingans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bimbingans)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf419535029d1a7d89eebcadb151354a)): ?>
<?php $attributes = $__attributesOriginaldf419535029d1a7d89eebcadb151354a; ?>
<?php unset($__attributesOriginaldf419535029d1a7d89eebcadb151354a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf419535029d1a7d89eebcadb151354a)): ?>
<?php $component = $__componentOriginaldf419535029d1a7d89eebcadb151354a; ?>
<?php unset($__componentOriginaldf419535029d1a7d89eebcadb151354a); ?>
<?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/fakultas-pendidikan.blade.php ENDPATH**/ ?>