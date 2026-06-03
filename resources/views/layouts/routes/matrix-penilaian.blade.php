<script>
window.routes = window.routes || {};

window.routes.matrixPenilaian = {
    show: "{{ route('matrix.show', ':id') }}",
    store: "{{ route('matrix.store') }}",
    update: "{{ route('matrix.update', ':id') }}",
    delete: "{{ route('matrix.delete', ':id') }}"
};
</script>