

<?php $__env->startSection('title', 'Kelola Sarana Prasarana Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Kelola Sarana Prasarana Fakultas']); ?>
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

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Kelola Sarana Prasarana Fakultas
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola data sarana dan prasarana fakultas, serta lihat data dari program studi
            </p>
        </div>

        
        <div class="flex items-center gap-3">
            <button
                type="button"
                onclick="openModalFormSarprasFakultas('create')"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-blue-600 hover:bg-blue-700
                    dark:bg-blue-500 dark:hover:bg-blue-600
                    text-white text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800"
            >
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Sarana Prasarana
            </button>
        </div>
    </div>

    
    <?php if (isset($component)) { $__componentOriginal138910b1c1259ff6b33cda4741f00a87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal138910b1c1259ff6b33cda4741f00a87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sarpras-fakultas.filter-section','data' => ['prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sarpras-fakultas.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal138910b1c1259ff6b33cda4741f00a87)): ?>
<?php $attributes = $__attributesOriginal138910b1c1259ff6b33cda4741f00a87; ?>
<?php unset($__attributesOriginal138910b1c1259ff6b33cda4741f00a87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal138910b1c1259ff6b33cda4741f00a87)): ?>
<?php $component = $__componentOriginal138910b1c1259ff6b33cda4741f00a87; ?>
<?php unset($__componentOriginal138910b1c1259ff6b33cda4741f00a87); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginald6afbba9cdff6af3df912e11d4eedc0e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald6afbba9cdff6af3df912e11d4eedc0e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sarpras-fakultas.data-sarpras-fakultas-table','data' => ['sarprasFakultas' => $sarprasFakultas,'sarprasProdi' => $sarprasProdi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sarpras-fakultas.data-sarpras-fakultas-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sarprasFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sarprasFakultas),'sarprasProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sarprasProdi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald6afbba9cdff6af3df912e11d4eedc0e)): ?>
<?php $attributes = $__attributesOriginald6afbba9cdff6af3df912e11d4eedc0e; ?>
<?php unset($__attributesOriginald6afbba9cdff6af3df912e11d4eedc0e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald6afbba9cdff6af3df912e11d4eedc0e)): ?>
<?php $component = $__componentOriginald6afbba9cdff6af3df912e11d4eedc0e; ?>
<?php unset($__componentOriginald6afbba9cdff6af3df912e11d4eedc0e); ?>
<?php endif; ?>

    
    <?php echo $__env->make('components.sarpras-fakultas.modal.modal-sarpras-fakultas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/sarpras-fakultas.blade.php ENDPATH**/ ?>