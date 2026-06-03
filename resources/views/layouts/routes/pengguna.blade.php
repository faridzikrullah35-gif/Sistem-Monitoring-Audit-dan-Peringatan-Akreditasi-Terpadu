<script>
window.routes = window.routes || {};

window.routes.pengguna = {
    show: "{{ route('pengguna.show', ':id') }}",
    store: "{{ route('pengguna.store') }}",
    update: "{{ route('pengguna.update', ':id') }}"
};
</script>