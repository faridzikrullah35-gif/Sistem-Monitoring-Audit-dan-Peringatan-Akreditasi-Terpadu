@extends('layouts.app')

@section('title', 'Setting Akses Auditor | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Setting Akses Auditor" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Akses Auditor</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Atur hak akses auditor terhadap unit dan sub-unit kerja tertentu</p>
            </div>
        </div>

        <!-- Main Container Panel -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Setting Akses -->
            <div class="col-span-12 lg:col-span-12">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] h-full">
                    <div class="p-5 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Setting Akses Auditor</h3>
                        </div>
                        <button 
                            onclick="openModal()" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors"
                        >
                            <!-- Icon Plus -->
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>

                            Tambah Akses
                        </button>
                    </div>
                   <x-akses-auditor.panel-access :akses="$akses" />
                </div>
            </div>

        </div>
    </div>

    @include('components.akses-auditor.modal-access-auditor', ['auditors' => $auditors])

    @include('components.akses-auditor.modal.modal-auditor-checklist', [
        'isiAkses' => $isiAkses
    ])

@section('scripts')
<script>
    function selectAuditor(button, name) {
        // 1. Handle UI List Kiri (Active State)
        const buttons = button.closest('ul').querySelectorAll('button');
        buttons.forEach(btn => {
            btn.classList.remove('bg-blue-50', 'dark:bg-blue-900/20', 'ring-1', 'ring-blue-500');
            btn.classList.add('hover:bg-gray-50', 'dark:hover:bg-gray-800');
        });
        button.classList.add('bg-blue-50', 'dark:bg-blue-900/20', 'ring-1', 'ring-blue-500');
        button.classList.remove('hover:bg-gray-50', 'dark:hover:bg-gray-800');

        // 2. Handle Panel Kanan
        document.getElementById('selectedAuditorName').innerText = "Akses untuk: " + name;
        document.getElementById('emptyState').classList.add('hidden');
        document.getElementById('accessContent').classList.remove('hidden');
        
        // 3. Aktifkan tombol save
        document.getElementById('btnSaveAccess').disabled = false;

        // 4. Logic Mobile: Buka modal jika layar kecil (XL ke bawah)
        if (window.innerWidth < 1280) {
            document.getElementById('modalAuditorName').innerText = name;
            document.getElementById('mobileAssignModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeMobileModal() {
        document.getElementById('mobileAssignModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function toggleAll(checked) {
        const checkboxes = document.querySelectorAll('input[name="units[]"]');
        checkboxes.forEach(cb => {
            cb.checked = checked;
        });
    }
</script>
@endsection
    
@endsection