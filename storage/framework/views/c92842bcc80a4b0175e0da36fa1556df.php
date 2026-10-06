

<?php $__env->startSection('title', 'Dosen Terdata Sinta | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Dosen Terdata Sinta']); ?>
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

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Dosen Terdata Sinta
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola data dosen yang terdaftar di Sinta untuk program studi
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            
            <button
                type="button"
                onclick="openModalFormSinta('create')"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-blue-600 hover:bg-blue-700
                    dark:bg-blue-500 dark:hover:bg-blue-600
                    text-white text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800"
            >
                <svg
                    class="w-5 h-5 mr-2 -ml-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                </svg>

                Tambah Data SINTA
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <?php if (isset($component)) { $__componentOriginale518dd5ecaa96f4cb23321cada22ee5b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale518dd5ecaa96f4cb23321cada22ee5b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-sinta.filter-section','data' => ['sintas' => $sintas]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-sinta.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sintas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sintas)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale518dd5ecaa96f4cb23321cada22ee5b)): ?>
<?php $attributes = $__attributesOriginale518dd5ecaa96f4cb23321cada22ee5b; ?>
<?php unset($__attributesOriginale518dd5ecaa96f4cb23321cada22ee5b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale518dd5ecaa96f4cb23321cada22ee5b)): ?>
<?php $component = $__componentOriginale518dd5ecaa96f4cb23321cada22ee5b; ?>
<?php unset($__componentOriginale518dd5ecaa96f4cb23321cada22ee5b); ?>
<?php endif; ?>

    <!-- Komponen Tabel Data SINTA -->
    <?php if (isset($component)) { $__componentOriginal271738848c9ab2266f380ce438b93588 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal271738848c9ab2266f380ce438b93588 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-sinta.data-table','data' => ['sintas' => $sintas]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-sinta.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sintas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sintas)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal271738848c9ab2266f380ce438b93588)): ?>
<?php $attributes = $__attributesOriginal271738848c9ab2266f380ce438b93588; ?>
<?php unset($__attributesOriginal271738848c9ab2266f380ce438b93588); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal271738848c9ab2266f380ce438b93588)): ?>
<?php $component = $__componentOriginal271738848c9ab2266f380ce438b93588; ?>
<?php unset($__componentOriginal271738848c9ab2266f380ce438b93588); ?>
<?php endif; ?>

    
    <?php echo $__env->make('components.prodi-sinta.modal-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/prodi/sinta-prodi.blade.php ENDPATH**/ ?>