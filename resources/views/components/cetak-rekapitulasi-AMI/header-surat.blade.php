@props(['noDokumen' => '', 'tanggalTerbit' => '', 'noRevisi' => ''])

<div class="border-b border-gray-200 pb-4">
    <div class="flex justify-between text-sm">
        <div>
            <div>FORMULIR</div>
            <div>No Dokumen : {{ $noDokumen }}</div>
        </div>
        <div class="text-right">
            <div class="font-bold">DAFTAR REKAPITULASI KETIDAKSESUAIAN DAN PERMINTAAN TINDAKAN PERBAIKAN</div>
            <div>Tanggal Terbit : {{ $tanggalTerbit }}</div>
            <div>No. Revisi : {{ $noRevisi }}</div>
        </div>
    </div>
</div>