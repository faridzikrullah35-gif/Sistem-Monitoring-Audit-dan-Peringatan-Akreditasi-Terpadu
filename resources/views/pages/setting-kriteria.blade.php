@extends('layouts.app')

@section('title', 'Setting Kriteria | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Setting Kriteria Audit" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kriteria & Standar Audit</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola indikator penilaian untuk lembar checklist auditor</p>
            </div>
            <button onclick="openModal('create')" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Kriteria Baru
            </button>
        </div>

        <!-- Komponen List Utama (Master Detail) -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <x-setting-kriteria.criteria-list :standars="$standars" />
        </div>
    </div>

    <!-- Modal Form -->
    <x-setting-kriteria.form-modal :standars="$standars" />

    <x-setting-kriteria.standar-modal />

@endsection

<script>
let standarMode = 'create';
let standarId = null;

function openModalStandar(mode = 'create', id = null, nama = '') {
    const modal = document.getElementById('modalStandar');
    const input = document.getElementById('standar');
    const title = document.getElementById('standarModalTitle');

    standarMode = mode;
    standarId = id;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    title.innerText = mode === 'edit'
        ? 'Edit Standar Kriteria'
        : 'Input Standar Kriteria';

    input.value = nama || '';

    const form = document.getElementById('formStandar');
    
    if (mode === 'edit') {
        form.action = `/admin/standar/update/${id}`;
        const methodInput = document.getElementById('methodStandar');
        if (methodInput) methodInput.remove();
    } else {
        form.action = '/admin/standar/store';
        const methodInput = document.getElementById('methodStandar');
        if (methodInput) methodInput.remove();
    }

    setTimeout(() => input.focus(), 100);
}

function closeModalStandar() {
    const modal = document.getElementById('modalStandar');
    modal.classList.add('hidden');
    modal.classList.remove('flex');

    // reset state
    standarMode = 'create';
    standarId = null;
    document.getElementById('standar').value = '';
}
</script>