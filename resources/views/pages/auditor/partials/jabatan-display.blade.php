@props(['profil'])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Jabatan Fungsional</h4>
        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            View Only
        </span>
    </div>

    {{-- TABLE SCROLL CONTAINER --}}
    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div class="overflow-auto" style="max-height: 600px;">
            <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">No</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Asisten Ahli</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Lektor</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Lektor Kepala</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Guru Besar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $asistenAhli = $profil && $profil->exists ? ($profil->jumlah_asisten_ahli ?? 0) : 0;
                        $lektor = $profil && $profil->exists ? ($profil->jumlah_lektor ?? 0) : 0;
                        $lektorKepala = $profil && $profil->exists ? ($profil->jumlah_lektor_kepala ?? 0) : 0;
                        $guruBesar = $profil && $profil->exists ? ($profil->jumlah_guru_besar ?? 0) : 0;
                        $total = $asistenAhli + $lektor + $lektorKepala + $guruBesar;
                    @endphp

                    @if($profil && $profil->exists && $total > 0)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">{{ $asistenAhli }}</td>
                        <td class="px-4 py-2">{{ $lektor }}</td>
                        <td class="px-4 py-2">{{ $lektorKepala }}</td>
                        <td class="px-4 py-2">{{ $guruBesar }}</td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400 dark:text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="text-sm font-medium">Belum ada data Jabatan Fungsional</span>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>