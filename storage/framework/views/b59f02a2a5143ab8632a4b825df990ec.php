

<?php $__env->startSection('title', 'Inovasi Prodi | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Inovasi Program Studi']); ?>
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
                Inovasi Program Studi
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola data inovasi untuk program studi
            </p>
        </div>

        <div class="flex items-center gap-3">
            
            <a
                href="#"
                id="btnPrintInovasi"
                onclick="return handlePrintInovasi(event)"
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
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print
            </a>

            
            <button
                type="button"
                onclick="openModalFormInovasi('create')"
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
                Tambah Inovasi
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <?php if (isset($component)) { $__componentOriginal4792e1630c7277657e3a094c31cda0de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4792e1630c7277657e3a094c31cda0de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-inovasi.filter-section','data' => ['inovasi' => $inovasi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-inovasi.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inovasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inovasi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4792e1630c7277657e3a094c31cda0de)): ?>
<?php $attributes = $__attributesOriginal4792e1630c7277657e3a094c31cda0de; ?>
<?php unset($__attributesOriginal4792e1630c7277657e3a094c31cda0de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4792e1630c7277657e3a094c31cda0de)): ?>
<?php $component = $__componentOriginal4792e1630c7277657e3a094c31cda0de; ?>
<?php unset($__componentOriginal4792e1630c7277657e3a094c31cda0de); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal2122a0da3c3a7f75f2402d87ee867046 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2122a0da3c3a7f75f2402d87ee867046 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-inovasi.data-table','data' => ['inovasi' => $inovasi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-inovasi.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inovasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inovasi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2122a0da3c3a7f75f2402d87ee867046)): ?>
<?php $attributes = $__attributesOriginal2122a0da3c3a7f75f2402d87ee867046; ?>
<?php unset($__attributesOriginal2122a0da3c3a7f75f2402d87ee867046); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2122a0da3c3a7f75f2402d87ee867046)): ?>
<?php $component = $__componentOriginal2122a0da3c3a7f75f2402d87ee867046; ?>
<?php unset($__componentOriginal2122a0da3c3a7f75f2402d87ee867046); ?>
<?php endif; ?>

    <?php echo $__env->make('components.prodi-inovasi.modal-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/prodi/inovasi-prodi.blade.php ENDPATH**/ ?>