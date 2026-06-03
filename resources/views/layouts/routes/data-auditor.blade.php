<script>
window.routes = window.routes || {};

window.routes.dataAuditor = {
    show: "{{ route('data-auditor.show', ':id') }}",
    store: "{{ route('data-auditor.store') }}",
    update: "{{ route('data-auditor.update', ':id') }}"
};
</script>