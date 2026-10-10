

<?php $__env->startSection('title', 'Identitas Fakultas | SIMANTAP'); ?>

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
<?php $component->withAttributes(['pageTitle' => 'Identitas Fakultas']); ?>
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

        
        <?php if (isset($component)) { $__componentOriginale70c3d265dba76c8f8da83d3b5ea0da4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale70c3d265dba76c8f8da83d3b5ea0da4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.vmts','data' => ['profil' => $profil]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.vmts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['profil' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profil)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale70c3d265dba76c8f8da83d3b5ea0da4)): ?>
<?php $attributes = $__attributesOriginale70c3d265dba76c8f8da83d3b5ea0da4; ?>
<?php unset($__attributesOriginale70c3d265dba76c8f8da83d3b5ea0da4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale70c3d265dba76c8f8da83d3b5ea0da4)): ?>
<?php $component = $__componentOriginale70c3d265dba76c8f8da83d3b5ea0da4; ?>
<?php unset($__componentOriginale70c3d265dba76c8f8da83d3b5ea0da4); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginald8c066309fb49f771dcc9a77447c2c99 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8c066309fb49f771dcc9a77447c2c99 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.rip','data' => ['dokumenRipFakultas' => $dokumenRipFakultas,'dokumenRipProdi' => $dokumenRipProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.rip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenRipFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRipFakultas),'dokumenRipProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRipProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8c066309fb49f771dcc9a77447c2c99)): ?>
<?php $attributes = $__attributesOriginald8c066309fb49f771dcc9a77447c2c99; ?>
<?php unset($__attributesOriginald8c066309fb49f771dcc9a77447c2c99); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8c066309fb49f771dcc9a77447c2c99)): ?>
<?php $component = $__componentOriginald8c066309fb49f771dcc9a77447c2c99; ?>
<?php unset($__componentOriginald8c066309fb49f771dcc9a77447c2c99); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginal73b77f1a10cdf644730b7ae0bb5d9ea2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73b77f1a10cdf644730b7ae0bb5d9ea2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.renstra','data' => ['dokumenRenstraFakultas' => $dokumenRenstraFakultas,'dokumenRenstraProdi' => $dokumenRenstraProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.renstra'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenRenstraFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRenstraFakultas),'dokumenRenstraProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRenstraProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73b77f1a10cdf644730b7ae0bb5d9ea2)): ?>
<?php $attributes = $__attributesOriginal73b77f1a10cdf644730b7ae0bb5d9ea2; ?>
<?php unset($__attributesOriginal73b77f1a10cdf644730b7ae0bb5d9ea2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73b77f1a10cdf644730b7ae0bb5d9ea2)): ?>
<?php $component = $__componentOriginal73b77f1a10cdf644730b7ae0bb5d9ea2; ?>
<?php unset($__componentOriginal73b77f1a10cdf644730b7ae0bb5d9ea2); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginal9db0d41fece0d36092a2346831557f6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9db0d41fece0d36092a2346831557f6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.renop','data' => ['dokumenRenopFakultas' => $dokumenRenopFakultas,'dokumenRenopProdi' => $dokumenRenopProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.renop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenRenopFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRenopFakultas),'dokumenRenopProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRenopProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9db0d41fece0d36092a2346831557f6a)): ?>
<?php $attributes = $__attributesOriginal9db0d41fece0d36092a2346831557f6a; ?>
<?php unset($__attributesOriginal9db0d41fece0d36092a2346831557f6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9db0d41fece0d36092a2346831557f6a)): ?>
<?php $component = $__componentOriginal9db0d41fece0d36092a2346831557f6a; ?>
<?php unset($__componentOriginal9db0d41fece0d36092a2346831557f6a); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginal3bece66725789298f4e803edd32faba9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3bece66725789298f4e803edd32faba9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.mou','data' => ['dokumenMouFakultas' => $dokumenMouFakultas,'dokumenMouProdi' => $dokumenMouProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.mou'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenMouFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenMouFakultas),'dokumenMouProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenMouProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3bece66725789298f4e803edd32faba9)): ?>
<?php $attributes = $__attributesOriginal3bece66725789298f4e803edd32faba9; ?>
<?php unset($__attributesOriginal3bece66725789298f4e803edd32faba9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3bece66725789298f4e803edd32faba9)): ?>
<?php $component = $__componentOriginal3bece66725789298f4e803edd32faba9; ?>
<?php unset($__componentOriginal3bece66725789298f4e803edd32faba9); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginal185465b455fa8b5a08cf4aee59c8def2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal185465b455fa8b5a08cf4aee59c8def2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.dtps','data' => ['dtpsFakultas' => $dtpsFakultas,'dtpsProdi' => $dtpsProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.dtps'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dtpsFakultas' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dtpsFakultas),'dtpsProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dtpsProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal185465b455fa8b5a08cf4aee59c8def2)): ?>
<?php $attributes = $__attributesOriginal185465b455fa8b5a08cf4aee59c8def2; ?>
<?php unset($__attributesOriginal185465b455fa8b5a08cf4aee59c8def2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal185465b455fa8b5a08cf4aee59c8def2)): ?>
<?php $component = $__componentOriginal185465b455fa8b5a08cf4aee59c8def2; ?>
<?php unset($__componentOriginal185465b455fa8b5a08cf4aee59c8def2); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginala467be7e8c23a6f2b410f536738bfc9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala467be7e8c23a6f2b410f536738bfc9d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.Jabatan-Fungsional','data' => ['jabatanProdi' => $jabatanProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.Jabatan-Fungsional'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['jabatanProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($jabatanProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala467be7e8c23a6f2b410f536738bfc9d)): ?>
<?php $attributes = $__attributesOriginala467be7e8c23a6f2b410f536738bfc9d; ?>
<?php unset($__attributesOriginala467be7e8c23a6f2b410f536738bfc9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala467be7e8c23a6f2b410f536738bfc9d)): ?>
<?php $component = $__componentOriginala467be7e8c23a6f2b410f536738bfc9d; ?>
<?php unset($__componentOriginala467be7e8c23a6f2b410f536738bfc9d); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginalfc302a0ca796455d3772807aa1c98184 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc302a0ca796455d3772807aa1c98184 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.mahasiswa','data' => ['mahasiswaProdi' => $mahasiswaProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.mahasiswa'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['mahasiswaProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mahasiswaProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc302a0ca796455d3772807aa1c98184)): ?>
<?php $attributes = $__attributesOriginalfc302a0ca796455d3772807aa1c98184; ?>
<?php unset($__attributesOriginalfc302a0ca796455d3772807aa1c98184); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc302a0ca796455d3772807aa1c98184)): ?>
<?php $component = $__componentOriginalfc302a0ca796455d3772807aa1c98184; ?>
<?php unset($__componentOriginalfc302a0ca796455d3772807aa1c98184); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginal4814182e73bf63b6e10cec806f2a11c6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4814182e73bf63b6e10cec806f2a11c6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-fakultas.rasio','data' => ['rasioProdi' => $rasioProdi,'prodi' => $prodi]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-fakultas.rasio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rasioProdi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rasioProdi),'prodi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodi)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4814182e73bf63b6e10cec806f2a11c6)): ?>
<?php $attributes = $__attributesOriginal4814182e73bf63b6e10cec806f2a11c6; ?>
<?php unset($__attributesOriginal4814182e73bf63b6e10cec806f2a11c6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4814182e73bf63b6e10cec806f2a11c6)): ?>
<?php $component = $__componentOriginal4814182e73bf63b6e10cec806f2a11c6; ?>
<?php unset($__componentOriginal4814182e73bf63b6e10cec806f2a11c6); ?>
<?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/fakultas/identitas-fakultas.blade.php ENDPATH**/ ?>