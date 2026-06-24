@extends('layouts.app')

@section('title', 'Cetak Rekapitulasi AMI - Auditee | SIMANTAP')

@section('content')
    <div class="flex min-h-screen flex-col">
        <x-common.page-breadcrumb pageTitle="Cetak Rekapitulasi AMI (Auditee)" />

        <div class="flex-1">
            <div
                class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03] sm:p-5 lg:p-6"
                x-data="cetakRekapitulasiAuditee()"
                x-init="init()"
            >
                <div class="space-y-6">

                    {{-- =========================
                        FILTER
                    ========================== --}}
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                            {{-- LEFT --}}
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:flex-wrap">
                                <div class="flex items-center gap-2">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Akademik</span>
                                </div>

                                <select
                                    id="tahun_akademik_select"
                                    x-model="selectedTahunId"
                                    @change="handleChange()"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:w-72"
                                >
                                    <option value="">Pilih Tahun Akademik</option>
                                    @foreach($tahunAkademikList as $tahun)
                                        <option value="{{ $tahun->id }}">
                                            {{ $tahun->tahun_akademik }} {{ $tahun->semester }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- RESET --}}
                                <button
                                    x-show="selectedTahunId !== ''"
                                    x-transition
                                    @click="resetFilter()"
                                    type="button"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-300"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset
                                </button>
                            </div>

                            {{-- RIGHT --}}
                            <div
                                x-show="dataRekap.length > 0"
                                x-transition
                                class="w-full lg:w-auto"
                            >
                                <a
                                    :href="'{{ route('prodi.cetak-auditee.print') }}?tahun_akademik_id=' + selectedTahunId"
                                    target="_blank"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700 lg:w-auto"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Cetak Rekapitulasi
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- =========================
                        LOADING
                    ========================== --}}
                    <div x-show="loading" class="flex items-center justify-center py-12">
                        <div class="text-sm text-gray-500">Memuat data...</div>
                    </div>

                    {{-- =========================
                        EMPTY STATE
                    ========================== --}}
                    <div
                        x-show="!loading && dataRekap.length === 0 && selectedTahunId !== ''"
                        class="rounded-xl border border-yellow-200 bg-yellow-50 p-4 text-center text-sm text-yellow-800"
                    >
                        Belum ada data temuan atau observasi untuk tahun akademik yang dipilih pada unit/prodi Anda.
                    </div>

                    {{-- =========================
                        CONTENT
                    ========================== --}}
                    <template x-if="!loading && dataRekap.length > 0">
                        <div class="space-y-6">

                            {{-- HEADER --}}
                            <div class="overflow-hidden rounded-xl border border-gray-200">
                                <div class="border-b border-gray-200 bg-gray-50 p-4">
                                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">

                                        <div class="text-sm text-gray-700">
                                            <div class="font-semibold">FORMULIR</div>
                                            <div class="mt-1">No Dokumen : <span x-text="noDokumen"></span></div>
                                        </div>

                                        <div class="text-sm text-gray-700 lg:text-right">
                                            <div class="font-bold uppercase">Daftar Rekapitulasi Ketidaksesuaian dan Permintaan Tindakan Perbaikan</div>
                                            <div class="mt-1">Tanggal Terbit : <span x-text="tanggalTerbit"></span></div>
                                            <div>No. Revisi : <span x-text="noRevisi"></span></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <div class="mb-2 text-sm font-semibold text-gray-700">LOG STATUS</div>
                                    <div class="rounded-lg bg-gray-100 p-3 text-sm text-gray-700">
                                        <span class="font-medium">PERIODE :</span>
                                        <span x-text="selectedTahunName"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- TABLE --}}
                            <div class="overflow-hidden rounded-xl border border-gray-200">
                                <div class="overflow-x-auto">
                                    <table class="min-w-[1200px] divide-y divide-gray-200 text-sm">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">No</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">No. NCR</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Tgl. Audit</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Bagian</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Macam Temuan</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Uraian Temuan</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Tgl. Target</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Tgl. Verifikasi</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Auditor</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Status</th>
                                                <th class="whitespace-nowrap px-3 py-3 text-left font-semibold text-gray-700">Keterangan</th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-100 bg-white">
                                            <template x-for="(item, idx) in dataRekap" :key="idx">
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-3 py-3" x-text="idx + 1"></td>
                                                    <td class="px-3 py-3" x-text="item.no_ncr"></td>
                                                    <td class="px-3 py-3" x-text="item.tgl_audit"></td>
                                                    <td class="px-3 py-3" x-text="item.bagian"></td>
                                                    <td class="px-3 py-3" x-text="item.macam_temuan"></td>
                                                    <td class="px-3 py-3">
                                                        <div class="
                                                            max-w-none break-words

                                                            [&_p]:mb-2

                                                            [&_ul]:list-disc
                                                            [&_ul]:pl-6
                                                            [&_ul]:mb-2

                                                            [&_ol]:list-decimal
                                                            [&_ol]:pl-6
                                                            [&_ol]:mb-2

                                                            [&_li]:mb-1

                                                            [&_strong]:font-semibold
                                                            [&_em]:italic
                                                            [&_u]:underline

                                                            [&_h1]:text-lg
                                                            [&_h1]:font-bold
                                                            [&_h1]:mb-2

                                                            [&_h2]:text-base
                                                            [&_h2]:font-semibold
                                                            [&_h2]:mb-2

                                                            [&_table]:w-full
                                                            [&_table]:border-collapse

                                                            [&_td]:border
                                                            [&_td]:p-2

                                                            [&_th]:border
                                                            [&_th]:p-2
                                                            [&_th]:font-semibold
                                                        " x-html="item.uraian_temuan"></div>
                                                    </td>
                                                    <td class="px-3 py-3" x-text="item.tgl_target_perbaikan"></td>
                                                    <td class="px-3 py-3" x-text="item.tgl_verifikasi"></td>
                                                    <td class="px-3 py-3" x-text="item.auditor"></td>
                                                    <td class="px-3 py-3">
                                                        <span
                                                            class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium"
                                                            :class="{
                                                                'bg-green-100 text-green-700': item.status === 'Selesai',
                                                                'bg-yellow-100 text-yellow-700': item.status === 'Proses',
                                                                'bg-red-100 text-red-700': item.status === 'Belum'
                                                            }"
                                                            x-text="item.status"
                                                        ></span>
                                                    </td>
                                                    <td class="px-3 py-3" x-text="item.keterangan"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- REKAP CARD --}}
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                                <template x-for="cat in categories" :key="cat.label">
                                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                        <div class="text-sm font-medium text-gray-500" x-text="'Total ' + cat.label"></div>
                                        <div class="mt-2 text-3xl font-bold" :class="cat.color" x-text="cat.total"></div>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </template>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function cetakRekapitulasiAuditee() {
        return {
            selectedTahunId: '',
            selectedTahunName: '',
            dataRekap: [],
            categories: [],
            noDokumen: '',
            tanggalTerbit: '',
            noRevisi: '',
            loading: false,

            init() {
                this.selectedTahunId = '';
                this.selectedTahunName = '';
            },

            handleChange() {
                this.updateTahunName();
                if (this.selectedTahunId) {
                    this.fetchData();
                } else {
                    this.resetData();
                }
            },

            fetchData() {
                this.loading = true;
                fetch(`{{ route('prodi.cetak-auditee.data') }}?tahun_akademik_id=${this.selectedTahunId}`)
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP ${response.status}`);
                        return response.json();
                    })
                    .then(result => {
                        this.dataRekap = result.data || [];
                        this.categories = result.categories || [];
                        this.noDokumen = result.no_dokumen || '-';
                        this.tanggalTerbit = result.tanggal_terbit || '-';
                        this.noRevisi = result.no_revisi || '-';
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        alert('Gagal mengambil data. Silakan coba lagi.');
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },

            updateTahunName() {
                const select = document.getElementById('tahun_akademik_select');
                if (!select) return;
                const option = select.options[select.selectedIndex];
                this.selectedTahunName = option ? option.text : '';
            },

            resetData() {
                this.dataRekap = [];
                this.categories = [];
                this.noDokumen = '';
                this.tanggalTerbit = '';
                this.noRevisi = '';
            },

            resetFilter() {
                this.selectedTahunId = '';
                this.selectedTahunName = '';
                this.resetData();
                const select = document.getElementById('tahun_akademik_select');
                if (select) select.value = '';
            }
        }
    }
</script>
@endpush