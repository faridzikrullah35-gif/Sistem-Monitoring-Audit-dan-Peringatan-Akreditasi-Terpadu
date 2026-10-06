<script>
window.routes = window.routes || {};

window.routes.aksesAuditor = {
    show: "<?php echo e(route('akses-auditor.show', ':id')); ?>",
    store: "<?php echo e(route('akses-auditor.store')); ?>",
    update: "<?php echo e(route('akses-auditor.update', ':id')); ?>"
};
</script><?php /**PATH F:\Project-2\audit-app\resources\views/layouts/routes/setting-akses-auditor.blade.php ENDPATH**/ ?>