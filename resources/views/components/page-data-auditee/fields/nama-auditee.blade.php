{{-- resources/views/components/page-data-auditee/fields/nama-auditee.blade.php --}}
@props(['auditee'])

<span>{{ $auditee->nama_auditiee ?? '-' }}</span>