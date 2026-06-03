@extends('layouts.app')

@section('title', 'Pertanyaan AMI Unit | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Daftar Pertanyaan AMI Unit" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Pertanyaan AMI Unit</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola daftar pertanyaan AMI Unit audit mutu internal</p>
            </div>
            <button onclick="openModal('create')" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Data Baru
            </button>
        </div>

        <!-- Container Utama -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden shadow-sm">
            
            <!-- Filter Bar -->
            <x-pertanyaan-ami-unit.filter-bar 
                :kriteria="$kriteria"
                :tahunAkademik="$tahunAkademik"
            />

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700"></div>

            <!-- List Pertanyaan -->
            <div 
                id="pertanyaanTableContainer"
                class="p-5 lg:p-6"
            >
                <x-pertanyaan-ami-unit.question-list 
                    :dataPertanyaan="$dataPertanyaan" 
                />
            </div>
            
        </div>
    </div>

    <!-- Modal Form -->
    <x-pertanyaan-ami-unit.form-modal 
        :kriteria="$kriteria"
        :tahunAkademik="$tahunAkademik"
    />

@endsection

<script>
document.addEventListener('click', function(e) {

    const button = e.target.closest('[data-action="delete"]');

    if (!button) return;

    e.preventDefault();

    const url = button.dataset.url;
    const method = button.dataset.method || 'DELETE';
    const confirmText = button.dataset.confirm || 'Yakin ingin menghapus data ini?';
    const reload = button.dataset.reload === 'true';

    confirmDelete(
        'Konfirmasi Hapus',
        confirmText,
        async () => {

            button.disabled = true;

            const originalContent = button.innerHTML;

            button.innerHTML = `
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle 
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>

                    <path 
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v8H4z"
                    ></path>
                </svg>

                Menghapus...
            `;

            try {

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });

                const result = await response.json();

                if (result.success) {

                    window.toast.success(result.message);

                    if (reload) {
                        window.location.reload();
                    }

                } else {

                    window.toast.error(result.message);

                }

            } catch (error) {

                console.error(error);

                window.toast.error('Terjadi kesalahan saat menghapus data.');

            } finally {

                button.disabled = false;
                button.innerHTML = originalContent;

            }

        }
    );

});
</script>