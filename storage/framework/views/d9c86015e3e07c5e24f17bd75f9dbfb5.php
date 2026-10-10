

<?php $__env->startSection('title', 'Prestasi Akademik Mahasiswa | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Prestasi Akademik Mahasiswa']); ?>
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
                Prestasi Akademik Mahasiswa
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola data prestasi akademik mahasiswa untuk program studi
            </p>
        </div>

        <div class="flex items-center gap-3">
            
            <a
                href="#"
                id="btnPrintPrestasi"
                onclick="return handlePrintPrestasi(event)"
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
                onclick="openModalFormPrestasi('create')"
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
                Tambah Prestasi
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <?php if (isset($component)) { $__componentOriginal7f9046e4e7013f2aad264e7c4096cee4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f9046e4e7013f2aad264e7c4096cee4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-prestasi-akademik-mahasiswa.filter-section','data' => ['prestasi' => $prestasi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-prestasi-akademik-mahasiswa.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['prestasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prestasi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f9046e4e7013f2aad264e7c4096cee4)): ?>
<?php $attributes = $__attributesOriginal7f9046e4e7013f2aad264e7c4096cee4; ?>
<?php unset($__attributesOriginal7f9046e4e7013f2aad264e7c4096cee4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f9046e4e7013f2aad264e7c4096cee4)): ?>
<?php $component = $__componentOriginal7f9046e4e7013f2aad264e7c4096cee4; ?>
<?php unset($__componentOriginal7f9046e4e7013f2aad264e7c4096cee4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal3e15d4c93075cce71e144eee6a934830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e15d4c93075cce71e144eee6a934830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-prestasi-akademik-mahasiswa.data-table','data' => ['prestasi' => $prestasi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-prestasi-akademik-mahasiswa.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['prestasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prestasi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e15d4c93075cce71e144eee6a934830)): ?>
<?php $attributes = $__attributesOriginal3e15d4c93075cce71e144eee6a934830; ?>
<?php unset($__attributesOriginal3e15d4c93075cce71e144eee6a934830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e15d4c93075cce71e144eee6a934830)): ?>
<?php $component = $__componentOriginal3e15d4c93075cce71e144eee6a934830; ?>
<?php unset($__componentOriginal3e15d4c93075cce71e144eee6a934830); ?>
<?php endif; ?>

    <?php echo $__env->make('components.prodi-prestasi-akademik-mahasiswa.modal-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/prodi/prestasi-akademik-mahasiswa-prodi.blade.php ENDPATH**/ ?>