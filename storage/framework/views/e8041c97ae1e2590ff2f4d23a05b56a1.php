<script>
window.routes = window.routes || {};

window.routes.pengguna = {
    show: "<?php echo e(route('pengguna.show', ':id')); ?>",
    store: "<?php echo e(route('pengguna.store')); ?>",
    update: "<?php echo e(route('pengguna.update', ':id')); ?>"
};
</script><?php /**PATH F:\Project-2\audit-app\resources\views/layouts/routes/pengguna.blade.php ENDPATH**/ ?>