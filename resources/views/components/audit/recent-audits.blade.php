{{-- recent-audits.blade.php --}}
<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="flex items-center justify-between p-5 md:p-6 pb-0">
        <div>
            <h3 class="font-semibold text-gray-800 dark:text-white/90 text-title-sm">Audit Terbaru</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">5 aktivitas terakhir</p>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-t border-gray-100 dark:border-gray-800">
                    <th class="text-left px-5 md:px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        Elemen
                    </th>
                    <th class="text-left px-3 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        Indikator
                    </th>
                    <th class="text-left px-3 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        Unit
                    </th>
                    <th class="text-left px-3 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        Sub Unit
                    </th>
                    <th class="text-right px-5 md:px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        Tanggal
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($recentAudits as $audit)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors duration-150">
                        <td class="px-5 md:px-6 py-3.5 font-medium text-gray-800 dark:text-white/90 whitespace-nowrap">
                            {{ $audit->isiIndikator->matrix->elemen ?? '-' }}
                        </td>
                        <td class="px-3 py-3.5 text-gray-600 dark:text-gray-300 whitespace-nowrap">
                            {{ $audit->isiIndikator->indikator ?? '-' }}
                        </td>
                        <td class="px-3 py-3.5 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                            {{ optional($audit->akses->first())->unit ?? '-' }}
                        </td>
                        <td class="px-3 py-3.5 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                            {{ optional($audit->akses->first())->sub_unit ?? '-' }}
                        </td>
                        <td class="px-5 md:px-6 py-3.5 text-right text-gray-500 dark:text-gray-400 whitespace-nowrap">
                            {{ $audit->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700/50">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h4 class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Belum Ada Audit
                                </h4>
                                <p class="max-w-xs text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                    Belum ada data audit yang tersedia.
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>