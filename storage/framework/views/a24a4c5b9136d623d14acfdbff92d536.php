<script>
window.routes = window.routes || {};

window.routes.dataAuditor = {
    show: "<?php echo e(route('data-auditor.show', ':id')); ?>",
    store: "<?php echo e(route('data-auditor.store')); ?>",
    update: "<?php echo e(route('data-auditor.update', ':id')); ?>"
};
</script><?php /**PATH F:\Project-2\audit-app\resources\views/layouts/routes/data-auditor.blade.php ENDPATH**/ ?>