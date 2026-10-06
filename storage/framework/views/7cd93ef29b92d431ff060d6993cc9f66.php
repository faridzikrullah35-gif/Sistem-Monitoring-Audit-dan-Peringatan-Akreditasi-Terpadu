<script>
window.routes = window.routes || {};

window.routes.matrixPenilaian = {
    show: "<?php echo e(route('matrix.show', ':id')); ?>",
    store: "<?php echo e(route('matrix.store')); ?>",
    update: "<?php echo e(route('matrix.update', ':id')); ?>",
    delete: "<?php echo e(route('matrix.delete', ':id')); ?>"
};
</script><?php /**PATH F:\Project-2\audit-app\resources\views/layouts/routes/matrix-penilaian.blade.php ENDPATH**/ ?>