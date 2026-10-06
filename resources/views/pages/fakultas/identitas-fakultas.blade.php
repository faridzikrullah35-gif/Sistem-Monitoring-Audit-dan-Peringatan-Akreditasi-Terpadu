@extends('layouts.app')

@section('title', 'Identitas Fakultas | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Identitas Fakultas" />

    <div class="space-y-6">

        {{-- VMTS --}}
        <x-identitas-fakultas.vmts :profil="$profil" />

        {{-- RIP --}}
        <x-identitas-fakultas.rip
            :dokumenRipFakultas="$dokumenRipFakultas"
            :dokumenRipProdi="$dokumenRipProdi"
            :prodi="$prodi"
        />

        {{-- RENSTRA --}}
        <x-identitas-fakultas.renstra
            :dokumenRenstraFakultas="$dokumenRenstraFakultas"
            :dokumenRenstraProdi="$dokumenRenstraProdi"
            :prodi="$prodi"
        />

        {{-- RENOP --}}
        <x-identitas-fakultas.renop
            :dokumenRenopFakultas="$dokumenRenopFakultas"
            :dokumenRenopProdi="$dokumenRenopProdi"
            :prodi="$prodi"
        />

        {{-- MOU --}}
        <x-identitas-fakultas.mou
            :dokumenMouFakultas="$dokumenMouFakultas"
            :dokumenMouProdi="$dokumenMouProdi"
            :prodi="$prodi"
        />

        {{-- DTPS --}}
        <x-identitas-fakultas.dtps
            :dtpsFakultas="$dtpsFakultas"
            :dtpsProdi="$dtpsProdi"
            :prodi="$prodi"
        />

        {{-- JABATAN FUNGSIONAL --}}
        <x-identitas-fakultas.Jabatan-Fungsional
            :jabatanProdi="$jabatanProdi"
            :prodi="$prodi"
        />

        {{-- JUMLAH MAHASISWA --}}
        <x-identitas-fakultas.mahasiswa
            :mahasiswaProdi="$mahasiswaProdi"
            :prodi="$prodi"
        />

        {{-- RASIO DOSEN : MAHASISWA --}}
        <x-identitas-fakultas.rasio
            :rasioProdi="$rasioProdi"
            :prodi="$prodi"
        />

    </div>
@endsection