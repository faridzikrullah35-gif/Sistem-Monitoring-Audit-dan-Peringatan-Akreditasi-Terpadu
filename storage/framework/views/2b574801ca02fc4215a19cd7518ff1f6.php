

<?php $__env->startSection('title', 'Pendidikan | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Pendidikan']); ?>
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

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Pendidikan
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kelola data dan informasi pendidikan pada program studi
            </p>
        </div>
    </div>

    
    <div class="rounded-2xl border border-gray-200 bg-white p-6
                dark:border-gray-700 dark:bg-gray-800">

        <div class="flex items-start gap-4">

            
            <div class="flex h-12 w-12 shrink-0 items-center justify-center
                        rounded-xl bg-blue-50 text-blue-600
                        dark:bg-blue-500/10 dark:text-blue-400">
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 14l6.16-3.422A12.083 12.083 0 0118 15.5c0 1.933-2.686 3.5-6 3.5s-6-1.567-6-3.5c0-.815.3-1.572.84-2.222L12 14z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 9v6"
                    />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data Pendidikan Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini digunakan untuk mengelola informasi yang berkaitan
                    dengan penyelenggaraan pendidikan pada program studi.
                </p>
            </div>
        </div>
    </div>

    
    <div class="space-y-4">

        
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Kurikulum
            </h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data kurikulum program studi beserta dokumen penetapannya
            </p>
        </div>

        
        <?php if (isset($component)) { $__componentOriginale6b5df495e35e3a630bd205579b370da = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6b5df495e35e3a630bd205579b370da = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-pendidikan.prodi-kurikulum.filter-section','data' => ['kurikulums' => $kurikulums,'tahunKurikulumList' => $tahunKurikulumList]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-pendidikan.prodi-kurikulum.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kurikulums' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kurikulums),'tahunKurikulumList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunKurikulumList)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale6b5df495e35e3a630bd205579b370da)): ?>
<?php $attributes = $__attributesOriginale6b5df495e35e3a630bd205579b370da; ?>
<?php unset($__attributesOriginale6b5df495e35e3a630bd205579b370da); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale6b5df495e35e3a630bd205579b370da)): ?>
<?php $component = $__componentOriginale6b5df495e35e3a630bd205579b370da; ?>
<?php unset($__componentOriginale6b5df495e35e3a630bd205579b370da); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginaled51a8af2f486b82a80268c3a74fd810 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled51a8af2f486b82a80268c3a74fd810 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-pendidikan.prodi-kurikulum.data-table','data' => ['kurikulums' => $kurikulums]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-pendidikan.prodi-kurikulum.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kurikulums' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kurikulums)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled51a8af2f486b82a80268c3a74fd810)): ?>
<?php $attributes = $__attributesOriginaled51a8af2f486b82a80268c3a74fd810; ?>
<?php unset($__attributesOriginaled51a8af2f486b82a80268c3a74fd810); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled51a8af2f486b82a80268c3a74fd810)): ?>
<?php $component = $__componentOriginaled51a8af2f486b82a80268c3a74fd810; ?>
<?php unset($__componentOriginaled51a8af2f486b82a80268c3a74fd810); ?>
<?php endif; ?>

    </div>

    
    <div class="space-y-4">

        
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Pengajaran
            </h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data SK pengajaran program studi beserta penetapannya
            </p>
        </div>

        
        <?php if (isset($component)) { $__componentOriginald792a982df7e39732bfcc16f73a25d41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald792a982df7e39732bfcc16f73a25d41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-pendidikan.prodi-pengajaran.filter-section','data' => ['pengajarans' => $pengajarans,'tahunPengajaranList' => $tahunPengajaranList,'semesterPengajaranList' => $semesterPengajaranList]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-pendidikan.prodi-pengajaran.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pengajarans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengajarans),'tahunPengajaranList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunPengajaranList),'semesterPengajaranList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($semesterPengajaranList)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald792a982df7e39732bfcc16f73a25d41)): ?>
<?php $attributes = $__attributesOriginald792a982df7e39732bfcc16f73a25d41; ?>
<?php unset($__attributesOriginald792a982df7e39732bfcc16f73a25d41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald792a982df7e39732bfcc16f73a25d41)): ?>
<?php $component = $__componentOriginald792a982df7e39732bfcc16f73a25d41; ?>
<?php unset($__componentOriginald792a982df7e39732bfcc16f73a25d41); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginalf78bb772a4f590d1bbcaef6ad923a49a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf78bb772a4f590d1bbcaef6ad923a49a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-pendidikan.prodi-pengajaran.data-table','data' => ['pengajarans' => $pengajarans]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-pendidikan.prodi-pengajaran.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pengajarans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pengajarans)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf78bb772a4f590d1bbcaef6ad923a49a)): ?>
<?php $attributes = $__attributesOriginalf78bb772a4f590d1bbcaef6ad923a49a; ?>
<?php unset($__attributesOriginalf78bb772a4f590d1bbcaef6ad923a49a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf78bb772a4f590d1bbcaef6ad923a49a)): ?>
<?php $component = $__componentOriginalf78bb772a4f590d1bbcaef6ad923a49a; ?>
<?php unset($__componentOriginalf78bb772a4f590d1bbcaef6ad923a49a); ?>
<?php endif; ?>

    </div>

    
    <div class="space-y-4">

        
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Bimbingan
            </h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data bimbingan program studi beserta dokumen penetapannya
            </p>
        </div>

        
        <?php if (isset($component)) { $__componentOriginal16fe7136d58ab1b2e158ab67c6ddad14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16fe7136d58ab1b2e158ab67c6ddad14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-pendidikan.prodi-bimbingan.filter-section','data' => ['bimbingans' => $bimbingans,'tahunBimbinganList' => $tahunBimbinganList,'semesterBimbinganList' => $semesterBimbinganList]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-pendidikan.prodi-bimbingan.filter-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bimbingans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bimbingans),'tahunBimbinganList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunBimbinganList),'semesterBimbinganList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($semesterBimbinganList)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16fe7136d58ab1b2e158ab67c6ddad14)): ?>
<?php $attributes = $__attributesOriginal16fe7136d58ab1b2e158ab67c6ddad14; ?>
<?php unset($__attributesOriginal16fe7136d58ab1b2e158ab67c6ddad14); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16fe7136d58ab1b2e158ab67c6ddad14)): ?>
<?php $component = $__componentOriginal16fe7136d58ab1b2e158ab67c6ddad14; ?>
<?php unset($__componentOriginal16fe7136d58ab1b2e158ab67c6ddad14); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginalb5fbb262abd83c9c3b783e1dfafda654 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5fbb262abd83c9c3b783e1dfafda654 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.prodi-pendidikan.prodi-bimbingan.data-table','data' => ['bimbingans' => $bimbingans]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prodi-pendidikan.prodi-bimbingan.data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bimbingans' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bimbingans)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5fbb262abd83c9c3b783e1dfafda654)): ?>
<?php $attributes = $__attributesOriginalb5fbb262abd83c9c3b783e1dfafda654; ?>
<?php unset($__attributesOriginalb5fbb262abd83c9c3b783e1dfafda654); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5fbb262abd83c9c3b783e1dfafda654)): ?>
<?php $component = $__componentOriginalb5fbb262abd83c9c3b783e1dfafda654; ?>
<?php unset($__componentOriginalb5fbb262abd83c9c3b783e1dfafda654); ?>
<?php endif; ?>

    </div>

</div>

<!-- MODAL -->
<?php echo $__env->make('components.prodi-pendidikan.prodi-kurikulum.modal-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('components.prodi-pendidikan.prodi-pengajaran.modal-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('components.prodi-pendidikan.prodi-bimbingan.modal-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/prodi/prodi-pendidikan.blade.php ENDPATH**/ ?>