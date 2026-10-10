

<?php $__env->startSection('title', 'Profile PD-DIKTI | SIMANTAP'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginald07245451647f5715f9bac44fc38d4f4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald07245451647f5715f9bac44fc38d4f4 = $attributes; } ?>
<?php $component = App\View\Components\Common\PageBreadcrumb::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.page-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Common\PageBreadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageTitle' => 'Profile PD-DIKTI']); ?>
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

    <div class="space-y-6">
        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">DTPS</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data berdasarkan PD-DIKTI terbaru</p>
                </div>
            </div>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginal7d31d6598f49b68f9625dab8c881cb6f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d31d6598f49b68f9625dab8c881cb6f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile-pd-dikti.table-data-pd-dikti','data' => ['mahasiswa' => $mahasiswa]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile-pd-dikti.table-data-pd-dikti'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['mahasiswa' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mahasiswa)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d31d6598f49b68f9625dab8c881cb6f)): ?>
<?php $attributes = $__attributesOriginal7d31d6598f49b68f9625dab8c881cb6f; ?>
<?php unset($__attributesOriginal7d31d6598f49b68f9625dab8c881cb6f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d31d6598f49b68f9625dab8c881cb6f)): ?>
<?php $component = $__componentOriginal7d31d6598f49b68f9625dab8c881cb6f; ?>
<?php unset($__componentOriginal7d31d6598f49b68f9625dab8c881cb6f); ?>
<?php endif; ?>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginal90d71a3f39db67006dba80216f034ce9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal90d71a3f39db67006dba80216f034ce9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile-pd-dikti.table-data-rasio','data' => ['rasio' => $rasio]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile-pd-dikti.table-data-rasio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rasio' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rasio)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal90d71a3f39db67006dba80216f034ce9)): ?>
<?php $attributes = $__attributesOriginal90d71a3f39db67006dba80216f034ce9; ?>
<?php unset($__attributesOriginal90d71a3f39db67006dba80216f034ce9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal90d71a3f39db67006dba80216f034ce9)): ?>
<?php $component = $__componentOriginal90d71a3f39db67006dba80216f034ce9; ?>
<?php unset($__componentOriginal90d71a3f39db67006dba80216f034ce9); ?>
<?php endif; ?>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginalda138754fb38075b5257d8d5492d1dd9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda138754fb38075b5257d8d5492d1dd9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile-pd-dikti.table-data-lulusan','data' => ['lulusan' => $lulusan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile-pd-dikti.table-data-lulusan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['lulusan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lulusan)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda138754fb38075b5257d8d5492d1dd9)): ?>
<?php $attributes = $__attributesOriginalda138754fb38075b5257d8d5492d1dd9; ?>
<?php unset($__attributesOriginalda138754fb38075b5257d8d5492d1dd9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda138754fb38075b5257d8d5492d1dd9)): ?>
<?php $component = $__componentOriginalda138754fb38075b5257d8d5492d1dd9; ?>
<?php unset($__componentOriginalda138754fb38075b5257d8d5492d1dd9); ?>
<?php endif; ?>
        </div>
    </div>

    
    <?php echo $__env->make('components.profile-pd-dikti.modal.mahasiswa-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.profile-pd-dikti.modal.rasio-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.profile-pd-dikti.modal.lulusan-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/prodi/profile-pd-dikti.blade.php ENDPATH**/ ?>