

<?php $__env->startSection('title', 'Profile SDM | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Profile SDM']); ?>
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
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">SDM</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data berdasarkan PD-DIKTI terbaru</p>
                </div>
            </div>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginal9b7d6055971ddc6fb4c7d014943931bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b7d6055971ddc6fb4c7d014943931bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile-sdm.table-data-dosen','data' => ['dosen' => $dosen]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile-sdm.table-data-dosen'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dosen' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dosen)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b7d6055971ddc6fb4c7d014943931bb)): ?>
<?php $attributes = $__attributesOriginal9b7d6055971ddc6fb4c7d014943931bb; ?>
<?php unset($__attributesOriginal9b7d6055971ddc6fb4c7d014943931bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b7d6055971ddc6fb4c7d014943931bb)): ?>
<?php $component = $__componentOriginal9b7d6055971ddc6fb4c7d014943931bb; ?>
<?php unset($__componentOriginal9b7d6055971ddc6fb4c7d014943931bb); ?>
<?php endif; ?>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginald480ee6f1a13502198498eecb06f52ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald480ee6f1a13502198498eecb06f52ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile-sdm.table-data-tendik','data' => ['tendik' => $tendik]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile-sdm.table-data-tendik'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tendik' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tendik)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald480ee6f1a13502198498eecb06f52ff)): ?>
<?php $attributes = $__attributesOriginald480ee6f1a13502198498eecb06f52ff; ?>
<?php unset($__attributesOriginald480ee6f1a13502198498eecb06f52ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald480ee6f1a13502198498eecb06f52ff)): ?>
<?php $component = $__componentOriginald480ee6f1a13502198498eecb06f52ff; ?>
<?php unset($__componentOriginald480ee6f1a13502198498eecb06f52ff); ?>
<?php endif; ?>
        </div>
    </div>

    
    <?php echo $__env->make('components.profile-sdm.modal.dosen-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.profile-sdm.modal.tendik-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/prodi/profile-sdm.blade.php ENDPATH**/ ?>