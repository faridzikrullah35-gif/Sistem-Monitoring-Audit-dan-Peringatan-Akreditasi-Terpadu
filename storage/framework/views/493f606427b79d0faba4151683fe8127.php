

<?php $__env->startSection('title', 'Inovasi Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Inovasi Fakultas']); ?>
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
                Inovasi
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data inovasi dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    
    <?php if (isset($component)) { $__componentOriginal040b95a1f1803a7175d76d46b5c62ca2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal040b95a1f1803a7175d76d46b5c62ca2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-inovasi.filter-section','data' => ['inovasi' => $inovasi,'tahunList' => $tahunList,'jenisList' => $jenisList,'prodi' => $prodi,'filterProdi' => $filterProdi,'filterTahun' => $filterTahun,'filterJenis' => $filterJenis]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-inovasi.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inovasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inovasi),'tahunList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunList),'jenisList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($jenisList),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi),'filterProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterProdi),'filterTahun' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterTahun),'filterJenis' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterJenis)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal040b95a1f1803a7175d76d46b5c62ca2)): ?>
<?php $attributes = $__attributesOriginal040b95a1f1803a7175d76d46b5c62ca2; ?>
<?php unset($__attributesOriginal040b95a1f1803a7175d76d46b5c62ca2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal040b95a1f1803a7175d76d46b5c62ca2)): ?>
<?php $component = $__componentOriginal040b95a1f1803a7175d76d46b5c62ca2; ?>
<?php unset($__componentOriginal040b95a1f1803a7175d76d46b5c62ca2); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalf67d958ae29d58e3c5298be6a514b64c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf67d958ae29d58e3c5298be6a514b64c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-inovasi.data-table','data' => ['inovasi' => $inovasi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-inovasi.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inovasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inovasi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf67d958ae29d58e3c5298be6a514b64c)): ?>
<?php $attributes = $__attributesOriginalf67d958ae29d58e3c5298be6a514b64c; ?>
<?php unset($__attributesOriginalf67d958ae29d58e3c5298be6a514b64c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf67d958ae29d58e3c5298be6a514b64c)): ?>
<?php $component = $__componentOriginalf67d958ae29d58e3c5298be6a514b64c; ?>
<?php unset($__componentOriginalf67d958ae29d58e3c5298be6a514b64c); ?>
<?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/fakultas-inovasi.blade.php ENDPATH**/ ?>