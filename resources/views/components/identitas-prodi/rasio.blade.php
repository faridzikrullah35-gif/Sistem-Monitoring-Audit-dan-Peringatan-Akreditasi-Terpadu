<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white/90">Rasio</h4>
    <div class="text-2xl font-bold text-gray-800 dark:text-white">
        @php
            $dosen = ($profil->jumlah_dtps_magister ?? 0) + ($profil->jumlah_dtps_doktor ?? 0);
            $mhs = $profil->jumlah_mahasiswa ?? 0;
            $rasio = $dosen > 0 ? round($mhs / $dosen, 2) : 0;
        @endphp
        1 : {{ $rasio }}
    </div>
    <p class="text-sm text-gray-500 dark:text-gray-400">Rasio Dosen : Mahasiswa (otomatis)</p>
</div>