<script>
window.routes = window.routes || {};

window.routes.aksesAuditor = {
    show: "{{ route('akses-auditor.show', ':id') }}",
    store: "{{ route('akses-auditor.store') }}",
    update: "{{ route('akses-auditor.update', ':id') }}"
};
</script>