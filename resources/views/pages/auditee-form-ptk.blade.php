@extends('layouts.app')

@section('title', 'Form PTK | SIMANTAP')

@section('content')
<div
    x-data="{
        data: {{ Js::from($ptkList) }},
        selectedTahun: '',
        currentPage: 1,
        perPage: 10,

        get filtered() {
            if (this.selectedTahun === '') return this.data;
            return this.data.filter(item => 
                item.pertanyaan_ami_prodi?.tahun_akademik_id == this.selectedTahun
            );
        },

        get paginated() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filtered.slice(start, start + this.perPage);
        },

        get totalPages() {
            return Math.ceil(this.filtered.length / this.perPage) || 1;
        },

        get startIndex() {
            return this.filtered.length ? ((this.currentPage - 1) * this.perPage) + 1 : 0;
        },

        get endIndex() {
            return Math.min(this.currentPage * this.perPage, this.filtered.length);
        },

        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        },

        resetPage() {
            this.currentPage = 1;
        },

        updatePtkItem(updatedItem) {
            const index = this.data.findIndex(item => item.id === updatedItem.id);
            if (index !== -1) {
                this.data[index] = updatedItem;
                this.data = [...this.data];
                this.resetPage();
            }
        }
    }"
    @ptk-updated.window="updatePtkItem($event.detail)"
>
    <x-common.page-breadcrumb pageTitle="Form PTK (Permintaan Tindakan Koreksi)" />

    <div class="flex-1 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Daftar Permintaan Tindakan Koreksi
            </h3>
            <div class="flex items-center gap-3 lg:justify-end">
                <x-auditee-form-ptk.filter-ptk :tahunAkademiks="$tahunAkademiks" />
            </div>
        </div>

        <x-auditee-form-ptk.ptk-table />
    </div>

    <x-auditee-form-ptk.modal-edit-ptk :kategoriTemuan="$kategoriTemuan" x-on:update-ptk="updatePtkItem" />
</div>

@vite('resources/js/components/prodi/form-ptk/edit-ptk.js')

@endsection