

<?php $__env->startSection('title', 'Profile PD-DIKTI Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Profile PD-DIKTI Fakultas']); ?>
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
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">DTPS</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data berdasarkan PD-DIKTI terbaru</p>
                </div>
            </div>
        </div>

        
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white/90">
            Profile PD Dikti Fakultas
        </h1>
    </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="mb-4 flex items-center justify-end">
                <a href="#"
                id="btnPrintPdDiktiMahasiswa"
                onclick="return handlePrintPdDiktiMahasiswa(event)"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-white hover:bg-gray-50
                    dark:bg-gray-800 dark:hover:bg-gray-700
                    border border-gray-300 dark:border-gray-600
                    text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-gray-400
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Mahasiswa
                </a>
            </div>

            <?php if (isset($component)) { $__componentOriginal0e1d7e5b677a032cd45a189d2d636240 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0e1d7e5b677a032cd45a189d2d636240 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-profile-pd-dikti.table-data-pd-dikti','data' => ['mahasiswaFakultas' => $mahasiswaFakultas,'mahasiswaProdi' => $mahasiswaProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-profile-pd-dikti.table-data-pd-dikti'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['mahasiswaFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mahasiswaFakultas),'mahasiswaProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mahasiswaProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0e1d7e5b677a032cd45a189d2d636240)): ?>
<?php $attributes = $__attributesOriginal0e1d7e5b677a032cd45a189d2d636240; ?>
<?php unset($__attributesOriginal0e1d7e5b677a032cd45a189d2d636240); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0e1d7e5b677a032cd45a189d2d636240)): ?>
<?php $component = $__componentOriginal0e1d7e5b677a032cd45a189d2d636240; ?>
<?php unset($__componentOriginal0e1d7e5b677a032cd45a189d2d636240); ?>
<?php endif; ?>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <?php if (isset($component)) { $__componentOriginal6125f34833f89d27ff89dd585c2793a4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6125f34833f89d27ff89dd585c2793a4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-profile-pd-dikti.table-data-rasio','data' => ['rasioFakultas' => $rasioFakultas,'rasioProdi' => $rasioProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-profile-pd-dikti.table-data-rasio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rasioFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rasioFakultas),'rasioProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rasioProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6125f34833f89d27ff89dd585c2793a4)): ?>
<?php $attributes = $__attributesOriginal6125f34833f89d27ff89dd585c2793a4; ?>
<?php unset($__attributesOriginal6125f34833f89d27ff89dd585c2793a4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6125f34833f89d27ff89dd585c2793a4)): ?>
<?php $component = $__componentOriginal6125f34833f89d27ff89dd585c2793a4; ?>
<?php unset($__componentOriginal6125f34833f89d27ff89dd585c2793a4); ?>
<?php endif; ?>
        </div>

        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="mb-4 flex items-center justify-end">
                <a href="#"
                id="btnPrintPdDiktiLulusan"
                onclick="return handlePrintPdDiktiLulusan(event)"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-white hover:bg-gray-50
                    dark:bg-gray-800 dark:hover:bg-gray-700
                    border border-gray-300 dark:border-gray-600
                    text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-gray-400
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Lulusan
                </a>
            </div>

            <?php if (isset($component)) { $__componentOriginald78409573e016af2b7a5081cb894b060 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald78409573e016af2b7a5081cb894b060 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fakultas-profile-pd-dikti.table-data-lulusan','data' => ['lulusanFakultas' => $lulusanFakultas,'lulusanProdi' => $lulusanProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fakultas-profile-pd-dikti.table-data-lulusan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['lulusanFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lulusanFakultas),'lulusanProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lulusanProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald78409573e016af2b7a5081cb894b060)): ?>
<?php $attributes = $__attributesOriginald78409573e016af2b7a5081cb894b060; ?>
<?php unset($__attributesOriginald78409573e016af2b7a5081cb894b060); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald78409573e016af2b7a5081cb894b060)): ?>
<?php $component = $__componentOriginald78409573e016af2b7a5081cb894b060; ?>
<?php unset($__componentOriginald78409573e016af2b7a5081cb894b060); ?>
<?php endif; ?>
        </div>
    </div>

    
    <?php echo $__env->make('components.fakultas-profile-pd-dikti.modal.mahasiswa-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.fakultas-profile-pd-dikti.modal.rasio-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('components.fakultas-profile-pd-dikti.modal.lulusan-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/fakultas-profile-pd-dikti.blade.php ENDPATH**/ ?>