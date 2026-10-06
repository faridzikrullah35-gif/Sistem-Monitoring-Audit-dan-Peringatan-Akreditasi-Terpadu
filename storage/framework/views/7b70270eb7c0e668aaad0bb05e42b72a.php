

<?php $__env->startSection('title', 'PKM Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'PKM Fakultas']); ?>
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
                PKM (Program Kreativitas Mahasiswa)
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data PKM dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    
    <?php if (isset($component)) { $__componentOriginal12a618d42538b8b56257346cf68578e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12a618d42538b8b56257346cf68578e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pkm.filter-section','data' => ['pkm' => $pkm,'tahunList' => $tahunList,'tingkatList' => $tingkatList,'prodi' => $prodi,'filterProdi' => $filterProdi,'filterTahun' => $filterTahun,'filterTingkat' => $filterTingkat,'filterMahasiswa' => $filterMahasiswa]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pkm.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pkm' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pkm),'tahunList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunList),'tingkatList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tingkatList),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi),'filterProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterProdi),'filterTahun' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterTahun),'filterTingkat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterTingkat),'filterMahasiswa' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterMahasiswa)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12a618d42538b8b56257346cf68578e4)): ?>
<?php $attributes = $__attributesOriginal12a618d42538b8b56257346cf68578e4; ?>
<?php unset($__attributesOriginal12a618d42538b8b56257346cf68578e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12a618d42538b8b56257346cf68578e4)): ?>
<?php $component = $__componentOriginal12a618d42538b8b56257346cf68578e4; ?>
<?php unset($__componentOriginal12a618d42538b8b56257346cf68578e4); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal12010650c267341e909efe2b36e20045 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12010650c267341e909efe2b36e20045 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-pkm.data-table','data' => ['pkm' => $pkm]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-pkm.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pkm' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pkm)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12010650c267341e909efe2b36e20045)): ?>
<?php $attributes = $__attributesOriginal12010650c267341e909efe2b36e20045; ?>
<?php unset($__attributesOriginal12010650c267341e909efe2b36e20045); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12010650c267341e909efe2b36e20045)): ?>
<?php $component = $__componentOriginal12010650c267341e909efe2b36e20045; ?>
<?php unset($__componentOriginal12010650c267341e909efe2b36e20045); ?>
<?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/fakultas-pkm.blade.php ENDPATH**/ ?>