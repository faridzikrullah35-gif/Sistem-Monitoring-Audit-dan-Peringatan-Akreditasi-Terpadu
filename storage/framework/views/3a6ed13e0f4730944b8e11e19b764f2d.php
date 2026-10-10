

<?php $__env->startSection('title', 'Publikasi Ilmiah Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Publikasi Ilmiah Fakultas']); ?>
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
                Publikasi Ilmiah
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data publikasi ilmiah dari program studi di bawah fakultas (read-only)
            </p>
        </div>

        
        <div class="flex items-center gap-3">
            <a href="#"
               id="btnPrintPublikasiFakultas"
               onclick="return handlePrintPublikasiFakultas(event)"
               class="inline-flex items-center justify-center px-4 py-2.5
                   bg-white hover:bg-gray-50
                   dark:bg-gray-800 dark:hover:bg-gray-700
                   border border-gray-300 dark:border-gray-600
                   text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg
                   transition-colors
                   focus:outline-none focus:ring-2 focus:ring-gray-400
                   focus:ring-offset-2 dark:focus:ring-offset-gray-800"
            >
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print
            </a>
        </div>
    </div>

    
    <?php if (isset($component)) { $__componentOriginal07c3c909d7843c81ca148f494d45ef22 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07c3c909d7843c81ca148f494d45ef22 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-publikasi-ilmiah.filter-section','data' => ['publikasi' => $publikasi,'tahunList' => $tahunList,'jenisList' => $jenisList,'prodi' => $prodi,'filterProdi' => $filterProdi,'filterTahun' => $filterTahun,'filterJenis' => $filterJenis]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-publikasi-ilmiah.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['publikasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($publikasi),'tahunList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunList),'jenisList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($jenisList),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi),'filterProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterProdi),'filterTahun' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterTahun),'filterJenis' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterJenis)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07c3c909d7843c81ca148f494d45ef22)): ?>
<?php $attributes = $__attributesOriginal07c3c909d7843c81ca148f494d45ef22; ?>
<?php unset($__attributesOriginal07c3c909d7843c81ca148f494d45ef22); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07c3c909d7843c81ca148f494d45ef22)): ?>
<?php $component = $__componentOriginal07c3c909d7843c81ca148f494d45ef22; ?>
<?php unset($__componentOriginal07c3c909d7843c81ca148f494d45ef22); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal404fa1a99a91a8a17d5246ac18a2622c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal404fa1a99a91a8a17d5246ac18a2622c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-publikasi-ilmiah.data-table','data' => ['publikasi' => $publikasi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-publikasi-ilmiah.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['publikasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($publikasi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal404fa1a99a91a8a17d5246ac18a2622c)): ?>
<?php $attributes = $__attributesOriginal404fa1a99a91a8a17d5246ac18a2622c; ?>
<?php unset($__attributesOriginal404fa1a99a91a8a17d5246ac18a2622c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal404fa1a99a91a8a17d5246ac18a2622c)): ?>
<?php $component = $__componentOriginal404fa1a99a91a8a17d5246ac18a2622c; ?>
<?php unset($__componentOriginal404fa1a99a91a8a17d5246ac18a2622c); ?>
<?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/fakultas-publikasi-ilmiah.blade.php ENDPATH**/ ?>