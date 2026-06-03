{{-- resources/views/pages/auditee-daftar-periksa.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Periksa | SIMANTAP')

@section('content')
<div
    x-data="{
        selectedTahun: '',

        daftarPeriksas: {{ Js::from($daftarPeriksas ?? []) }},

        currentPage: 1,
        perPage: 10,

        get filteredPeriksas() {
            if (!this.selectedTahun) {
                return this.daftarPeriksas;
            }

            return this.daftarPeriksas.filter(
                item => item.pertanyaan_ami_prodi?.tahun_akademik_id == this.selectedTahun
            );
        },

        get totalPages() {
            return Math.ceil(this.filteredPeriksas.length / this.perPage);
        },

        get paginatedPeriksas() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;

            return this.filteredPeriksas.slice(start, end);
        },

        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        },

        resetPage() {
            this.currentPage = 1;
        }
    }"
    class="flex flex-col min-h-screen"
>
    <x-common.page-breadcrumb pageTitle="Daftar Periksa" />

    <div class="flex-1 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        {{-- HEADER dengan Filter --}}
        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Daftar Periksa
            </h3>
            <x-auditee-daftar-periksa.filter-tahun-akademik :tahunAkademiks="$tahunAkademiks ?? []" />
        </div>

        {{-- TABEL Daftar Periksa --}}
        <x-auditee-daftar-periksa.daftar-periksa-table
            :daftarPeriksas="$daftarPeriksas"
        />
    </div>
</div>
@endsection