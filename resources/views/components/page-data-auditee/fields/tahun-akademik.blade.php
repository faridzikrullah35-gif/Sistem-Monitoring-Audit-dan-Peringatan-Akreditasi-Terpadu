{{-- resources/views/components/page-data-auditee/fields/tahun-akademik.blade.php --}}
@props(['auditee'])

<span>
    {{ $auditee->tahunAkademik->tahun_akademik ?? '-' }}
    - 
    {{ $auditee->tahunAkademik->semester ?? '-' }}
</span>