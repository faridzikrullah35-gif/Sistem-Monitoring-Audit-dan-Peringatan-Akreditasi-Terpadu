

<?php $__env->startSection('title', 'Dosen Terdata Sinta Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Dosen Terdata Sinta Fakultas']); ?>
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
                Dosen Terdata Sinta
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data dosen terdata Sinta dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    
    <?php if (isset($component)) { $__componentOriginalab6f05527fe8f9b76e8568a4850a75f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab6f05527fe8f9b76e8568a4850a75f3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-sinta.filter-section','data' => ['sintas' => $sintas,'tahunList' => $tahunList,'prodi' => $prodi,'filterProdi' => $filterProdi,'filterTahun' => $filterTahun]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-sinta.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sintas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sintas),'tahunList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunList),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi),'filterProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterProdi),'filterTahun' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterTahun)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab6f05527fe8f9b76e8568a4850a75f3)): ?>
<?php $attributes = $__attributesOriginalab6f05527fe8f9b76e8568a4850a75f3; ?>
<?php unset($__attributesOriginalab6f05527fe8f9b76e8568a4850a75f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab6f05527fe8f9b76e8568a4850a75f3)): ?>
<?php $component = $__componentOriginalab6f05527fe8f9b76e8568a4850a75f3; ?>
<?php unset($__componentOriginalab6f05527fe8f9b76e8568a4850a75f3); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalac49b4db3e9bbb105c1cfbf160aa65f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac49b4db3e9bbb105c1cfbf160aa65f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-sinta.data-table','data' => ['sintas' => $sintas]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-sinta.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sintas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sintas)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalac49b4db3e9bbb105c1cfbf160aa65f9)): ?>
<?php $attributes = $__attributesOriginalac49b4db3e9bbb105c1cfbf160aa65f9; ?>
<?php unset($__attributesOriginalac49b4db3e9bbb105c1cfbf160aa65f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalac49b4db3e9bbb105c1cfbf160aa65f9)): ?>
<?php $component = $__componentOriginalac49b4db3e9bbb105c1cfbf160aa65f9; ?>
<?php unset($__componentOriginalac49b4db3e9bbb105c1cfbf160aa65f9); ?>
<?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/fakultas-sinta.blade.php ENDPATH**/ ?>