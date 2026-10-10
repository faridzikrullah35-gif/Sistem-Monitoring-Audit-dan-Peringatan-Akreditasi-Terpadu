

<?php
    $user = auth()->user();
    $namaUser = $user->name ?? 'User';
    $roleLabel = match ($user->role) {
        'prodi' => 'Prodi',
        'unit_kerja' => 'Unit Kerja',
        default => ucfirst(str_replace('_', ' ', $user->role ?? 'Auditee')),
    };
    $unitName = $user->sub_unit ?: $user->unit;
    $dashboardTitle = 'Dashboard ' . $roleLabel;
    $dashboardSubtitle = $unitName ? $unitName : null;
?>

<?php $__env->startSection('title', $dashboardTitle . ' | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dashboardTitle)]); ?>
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
        
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white"><?php echo e($dashboardTitle); ?></h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Selamat datang,
                <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($namaUser); ?></span>
                <?php if($dashboardSubtitle): ?>
                    <span class="mx-1">•</span>
                    <?php echo e($dashboardSubtitle); ?>

                <?php endif; ?>
            </p>
        </div>

        <?php if (isset($component)) { $__componentOriginalc6adebfccc64f8781de37a509c8214b5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6adebfccc64f8781de37a509c8214b5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-auditee.status-cards','data' => ['tahun' => $tahunAkademikText,'status' => $statusAudit,'deadline' => $deadline,'progress' => $progressPersen]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-auditee.status-cards'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tahun' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tahunAkademikText),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statusAudit),'deadline' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($deadline),'progress' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($progressPersen)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc6adebfccc64f8781de37a509c8214b5)): ?>
<?php $attributes = $__attributesOriginalc6adebfccc64f8781de37a509c8214b5; ?>
<?php unset($__attributesOriginalc6adebfccc64f8781de37a509c8214b5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6adebfccc64f8781de37a509c8214b5)): ?>
<?php $component = $__componentOriginalc6adebfccc64f8781de37a509c8214b5; ?>
<?php unset($__componentOriginalc6adebfccc64f8781de37a509c8214b5); ?>
<?php endif; ?>

        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <?php if (isset($component)) { $__componentOriginal9c9fa55872e2f9a535d99b77a59e9444 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9fa55872e2f9a535d99b77a59e9444 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-auditee.progress-ami','data' => ['total' => $totalPertanyaan,'sudah' => $sudahDiisi,'belum' => $belumDiisi,'persen' => $progressPersen]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-auditee.progress-ami'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalPertanyaan),'sudah' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sudahDiisi),'belum' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($belumDiisi),'persen' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($progressPersen)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c9fa55872e2f9a535d99b77a59e9444)): ?>
<?php $attributes = $__attributesOriginal9c9fa55872e2f9a535d99b77a59e9444; ?>
<?php unset($__attributesOriginal9c9fa55872e2f9a535d99b77a59e9444); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c9fa55872e2f9a535d99b77a59e9444)): ?>
<?php $component = $__componentOriginal9c9fa55872e2f9a535d99b77a59e9444; ?>
<?php unset($__componentOriginal9c9fa55872e2f9a535d99b77a59e9444); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalca1abea4d800f8cdf802abe9ffa3da59 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalca1abea4d800f8cdf802abe9ffa3da59 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-auditee.ringkasan-temuan','data' => ['ncrMayor' => $ncrMayor,'ncrMinor' => $ncrMinor,'observasi' => $observasi,'terpenuhi' => $terpenuhi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-auditee.ringkasan-temuan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['ncrMayor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ncrMayor),'ncrMinor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ncrMinor),'observasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($observasi),'terpenuhi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($terpenuhi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalca1abea4d800f8cdf802abe9ffa3da59)): ?>
<?php $attributes = $__attributesOriginalca1abea4d800f8cdf802abe9ffa3da59; ?>
<?php unset($__attributesOriginalca1abea4d800f8cdf802abe9ffa3da59); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalca1abea4d800f8cdf802abe9ffa3da59)): ?>
<?php $component = $__componentOriginalca1abea4d800f8cdf802abe9ffa3da59; ?>
<?php unset($__componentOriginalca1abea4d800f8cdf802abe9ffa3da59); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal06453804599a3a89becd75052c637952 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal06453804599a3a89becd75052c637952 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-auditee.grafik-ami','data' => ['labels' => $chartLabels,'chartSeries' => $chartSeries]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-auditee.grafik-ami'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['labels' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chartLabels),'chartSeries' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chartSeries)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal06453804599a3a89becd75052c637952)): ?>
<?php $attributes = $__attributesOriginal06453804599a3a89becd75052c637952; ?>
<?php unset($__attributesOriginal06453804599a3a89becd75052c637952); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal06453804599a3a89becd75052c637952)): ?>
<?php $component = $__componentOriginal06453804599a3a89becd75052c637952; ?>
<?php unset($__componentOriginal06453804599a3a89becd75052c637952); ?>
<?php endif; ?>
            </div>

            <div class="flex h-full">
                <?php if (isset($component)) { $__componentOriginalfe3ba1757dd7c678ccde43aaa7de8596 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe3ba1757dd7c678ccde43aaa7de8596 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-fakultas.notifikasi','data' => ['notifications' => $notifications,'notificationRoute' => route('prodi.notifications')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-fakultas.notifikasi'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['notifications' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($notifications),'notification-route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('prodi.notifications'))]); ?>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/dashboard-auditee/dashboard-auditee.blade.php ENDPATH**/ ?>