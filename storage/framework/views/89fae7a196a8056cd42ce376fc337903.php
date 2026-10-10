

<?php $__env->startSection('title', 'Dashboard Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Dashboard Fakultas']); ?>
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

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 lg:p-6">

        
        <?php if (isset($component)) { $__componentOriginal880876f944f51793ba26796f04876ee1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal880876f944f51793ba26796f04876ee1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-fakultas.status-cards','data' => ['tahun' => $tahunAkademikText,'status' => $statusAudit,'deadline' => $deadline,'progress' => $progressPersen]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-fakultas.status-cards'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tahun' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunAkademikText),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statusAudit),'deadline' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($deadline),'progress' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($progressPersen)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal880876f944f51793ba26796f04876ee1)): ?>
<?php $attributes = $__attributesOriginal880876f944f51793ba26796f04876ee1; ?>
<?php unset($__attributesOriginal880876f944f51793ba26796f04876ee1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal880876f944f51793ba26796f04876ee1)): ?>
<?php $component = $__componentOriginal880876f944f51793ba26796f04876ee1; ?>
<?php unset($__componentOriginal880876f944f51793ba26796f04876ee1); ?>
<?php endif; ?>

        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

            
            <div class="space-y-6 lg:col-span-2">

                
                <?php if (isset($component)) { $__componentOriginal62e7cb6e92f63a0b2e1fc8055baf2151 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62e7cb6e92f63a0b2e1fc8055baf2151 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-fakultas.progress-ami','data' => ['total' => $totalPertanyaan,'sudah' => $sudahDiisi,'belum' => $belumDiisi,'persen' => $progressPersen]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-fakultas.progress-ami'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalPertanyaan),'sudah' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sudahDiisi),'belum' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($belumDiisi),'persen' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($progressPersen)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62e7cb6e92f63a0b2e1fc8055baf2151)): ?>
<?php $attributes = $__attributesOriginal62e7cb6e92f63a0b2e1fc8055baf2151; ?>
<?php unset($__attributesOriginal62e7cb6e92f63a0b2e1fc8055baf2151); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62e7cb6e92f63a0b2e1fc8055baf2151)): ?>
<?php $component = $__componentOriginal62e7cb6e92f63a0b2e1fc8055baf2151; ?>
<?php unset($__componentOriginal62e7cb6e92f63a0b2e1fc8055baf2151); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal75ba40ad3e5c562238b4f72ac83b73db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal75ba40ad3e5c562238b4f72ac83b73db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-fakultas.ringkasan-temuan','data' => ['ncrMayor' => $ncrMayor,'ncrMinor' => $ncrMinor,'observasi' => $observasi,'terpenuhi' => $terpenuhi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-fakultas.ringkasan-temuan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['ncrMayor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ncrMayor),'ncrMinor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ncrMinor),'observasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($observasi),'terpenuhi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($terpenuhi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal75ba40ad3e5c562238b4f72ac83b73db)): ?>
<?php $attributes = $__attributesOriginal75ba40ad3e5c562238b4f72ac83b73db; ?>
<?php unset($__attributesOriginal75ba40ad3e5c562238b4f72ac83b73db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal75ba40ad3e5c562238b4f72ac83b73db)): ?>
<?php $component = $__componentOriginal75ba40ad3e5c562238b4f72ac83b73db; ?>
<?php unset($__componentOriginal75ba40ad3e5c562238b4f72ac83b73db); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal0493744812b8225fb30dd07ff461545d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0493744812b8225fb30dd07ff461545d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-fakultas.vmts','data' => ['labels' => $chartLabels,'chartSeries' => $chartSeries]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-fakultas.vmts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['labels' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chartLabels),'chartSeries' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chartSeries)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0493744812b8225fb30dd07ff461545d)): ?>
<?php $attributes = $__attributesOriginal0493744812b8225fb30dd07ff461545d; ?>
<?php unset($__attributesOriginal0493744812b8225fb30dd07ff461545d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0493744812b8225fb30dd07ff461545d)): ?>
<?php $component = $__componentOriginal0493744812b8225fb30dd07ff461545d; ?>
<?php unset($__componentOriginal0493744812b8225fb30dd07ff461545d); ?>
<?php endif; ?>

            </div>

            
            <div class="flex h-full">
                <?php if (isset($component)) { $__componentOriginalfe3ba1757dd7c678ccde43aaa7de8596 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe3ba1757dd7c678ccde43aaa7de8596 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-fakultas.notifikasi','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-fakultas.notifikasi'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfe3ba1757dd7c678ccde43aaa7de8596)): ?>
<?php $attributes = $__attributesOriginalfe3ba1757dd7c678ccde43aaa7de8596; ?>
<?php unset($__attributesOriginalfe3ba1757dd7c678ccde43aaa7de8596); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfe3ba1757dd7c678ccde43aaa7de8596)): ?>
<?php $component = $__componentOriginalfe3ba1757dd7c678ccde43aaa7de8596; ?>
<?php unset($__componentOriginalfe3ba1757dd7c678ccde43aaa7de8596); ?>
<?php endif; ?>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/dashboard-fakultas/dashboard-fakultas.blade.php ENDPATH**/ ?>