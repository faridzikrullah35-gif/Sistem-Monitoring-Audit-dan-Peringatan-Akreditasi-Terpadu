<script>
window.routes = window.routes || {};

window.routes.tahunAkademik = {
    show: "{{ route('tahun-akademik.show', ':id') }}",
    store: "{{ route('tahun-akademik.store') }}",
    update: "{{ route('tahun-akademik.update', ':id') }}"
};
</script>