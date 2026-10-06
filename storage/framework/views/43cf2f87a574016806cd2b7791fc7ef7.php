

<?php $__env->startSection('title', 'Profile SDM Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Profile SDM Fakultas']); ?>
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
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">SDM Fakultas</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data berdasarkan PD-DIKTI terbaru</p>
                </div>
            </div>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginaldefe2445042cdba83bec13e7bd0da32b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldefe2445042cdba83bec13e7bd0da32b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-sdm.table-data-dosen','data' => ['dosenFakultas' => $dosenFakultas,'dosenProdi' => $dosenProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-sdm.table-data-dosen'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dosenFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dosenFakultas),'dosenProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dosenProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldefe2445042cdba83bec13e7bd0da32b)): ?>
<?php $attributes = $__attributesOriginaldefe2445042cdba83bec13e7bd0da32b; ?>
<?php unset($__attributesOriginaldefe2445042cdba83bec13e7bd0da32b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldefe2445042cdba83bec13e7bd0da32b)): ?>
<?php $component = $__componentOriginaldefe2445042cdba83bec13e7bd0da32b; ?>
<?php unset($__componentOriginaldefe2445042cdba83bec13e7bd0da32b); ?>
<?php endif; ?>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginal89c2f5ecd7b63aeda98358088b15888e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89c2f5ecd7b63aeda98358088b15888e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-sdm.table-data-tendik','data' => ['tendikFakultas' => $tendikFakultas,'tendikProdi' => $tendikProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-sdm.table-data-tendik'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tendikFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tendikFakultas),'tendikProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tendikProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal89c2f5ecd7b63aeda98358088b15888e)): ?>
<?php $attributes = $__attributesOriginal89c2f5ecd7b63aeda98358088b15888e; ?>
<?php unset($__attributesOriginal89c2f5ecd7b63aeda98358088b15888e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal89c2f5ecd7b63aeda98358088b15888e)): ?>
<?php $component = $__componentOriginal89c2f5ecd7b63aeda98358088b15888e; ?>
<?php unset($__componentOriginal89c2f5ecd7b63aeda98358088b15888e); ?>
<?php endif; ?>
        </div>
    </div>

    
    <?php echo $__env->make('components.fakultas-sdm.modal.dosen-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.fakultas-sdm.modal.tendik-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/fakultas-profile-sdm.blade.php ENDPATH**/ ?>