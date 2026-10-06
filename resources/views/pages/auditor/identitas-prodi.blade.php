@extends('layouts.app')

@section('title', 'Identitas Prodi | SIMANTAP (View Only)')

@section('content')
    <x-common.page-breadcrumb pageTitle="Identitas Prodi" />

    <div class="space-y-6">
        @if(!$profil)
            {{-- TAMPILKAN PESAN KOSONG PROFIL --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-8 text-center dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                    <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-sm font-medium">Belum ada data Identitas Prodi</span>
                    <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                        Belum ada Auditee yang terdaftar untuk unit/sub_unit Anda.
                    </span>
                </div>
            </div>
        @else
            {{-- SECTION YANG BUTUH $profil --}}
            @include('pages.auditor.partials.vmts-display', ['profil' => $profil])
            @include('pages.auditor.partials.sosial-media-display', [
                'sosialMedia' => $sosialMedia
            ])
            @include('pages.auditor.partials.dokumen-display', [
                'title' => 'Rencana Induk Pengembangan',
                'dokumen' => $dokumenRip
            ])
            @include('pages.auditor.partials.dokumen-display', [
                'title' => 'Rencana Strategis',
                'dokumen' => $dokumenRenstra
            ])
            @include('pages.auditor.partials.dokumen-display', [
                'title' => 'Rencana Operasional',
                'dokumen' => $dokumenRenop
            ])
            @include('pages.auditor.partials.kegiatan-benchmarking-display', [
                'kegiatanBenchmarking' => $kegiatanBenchmarking
            ])
            @include('pages.auditor.partials.dokumen-mou-display', [
                'title' => 'Kerjasama MoU / MoA',
                'dokumen' => $dokumenMou
            ])
            @include('pages.auditor.partials.dtps-display', ['profil' => $profil])
            @include('pages.auditor.partials.jabatan-display', ['profil' => $profil])
            @include('pages.auditor.partials.mahasiswa-display', ['profil' => $profil])
            @include('pages.auditor.partials.rasio-display', ['profil' => $profil])
        @endif
    </div>
@endsection