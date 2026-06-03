<script>
window.routes = window.routes || {};

window.routes.settingKriteria = {
    show: "{{ route('setting-kriteria.show', ':id') }}",
    store: "{{ route('setting-kriteria.store') }}",
    update: "{{ route('setting-kriteria.update', ':id') }}",
    delete: "{{ route('setting-kriteria.delete', ':id') }}"
};
</script>