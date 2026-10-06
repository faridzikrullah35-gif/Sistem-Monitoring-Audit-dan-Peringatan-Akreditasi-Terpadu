@props(['profil'])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">VMTS</h4>

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
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-center text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 w-[50px] align-top">No</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Visi</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Misi</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Tujuan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Sasaran</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[150px] align-top">File</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[150px] align-top">Tgl Penetapan</th>
                    </tr>
                </thead>

                <tbody>
                    @if($profil && $profil->visi)
                        <tr class="border-b border-gray-200 dark:border-gray-700">

                            {{-- NO --}}
                            <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 align-top">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                    1
                                </span>
                            </td>

                            {{-- VISI --}}
                            <td class="px-4 py-3 align-top">
                                <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                                    [&_p]:mb-1.5 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5
                                    [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 [&_li]:mb-0.5
                                    [&_strong]:font-semibold [&_em]:italic [&_u]:underline
                                    [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5
                                    [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5
                                    [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1
                                    [&_table]:w-full [&_table]:border-collapse
                                    [&_td]:border [&_td]:p-1.5 [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold
                                    [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                                    {!! $profil->visi !!}
                                </div>
                            </td>

                            {{-- MISI --}}
                            <td class="px-4 py-3 align-top">
                                <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                                    [&_p]:mb-1.5 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5
                                    [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 [&_li]:mb-0.5
                                    [&_strong]:font-semibold [&_em]:italic [&_u]:underline
                                    [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5
                                    [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5
                                    [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1
                                    [&_table]:w-full [&_table]:border-collapse
                                    [&_td]:border [&_td]:p-1.5 [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold
                                    [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                                    {!! $profil->misi !!}
                                </div>
                            </td>

                            {{-- TUJUAN --}}
                            <td class="px-4 py-3 align-top">
                                <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                                    [&_p]:mb-1.5 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5
                                    [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 [&_li]:mb-0.5
                                    [&_strong]:font-semibold [&_em]:italic [&_u]:underline
                                    [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5
                                    [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5
                                    [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1
                                    [&_table]:w-full [&_table]:border-collapse
                                    [&_td]:border [&_td]:p-1.5 [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold
                                    [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                                    {!! $profil->tujuan !!}
                                </div>
                            </td>

                            {{-- SASARAN --}}
                            <td class="px-4 py-3 align-top">
                                <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                                    [&_p]:mb-1.5 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5
                                    [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 [&_li]:mb-0.5
                                    [&_strong]:font-semibold [&_em]:italic [&_u]:underline
                                    [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5
                                    [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5
                                    [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1
                                    [&_table]:w-full [&_table]:border-collapse
                                    [&_td]:border [&_td]:p-1.5 [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold
                                    [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                                    {!! $profil->sasaran !!}
                                </div>
                            </td>

                            {{-- FILE --}}
                            <td class="px-4 py-3 align-top">
                                @if($profil->file)
                                    <a
                                        href="{{ asset('storage/' . ltrim($profil->file, '/')) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-2 text-xs font-medium text-blue-600 transition hover:bg-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:hover:bg-blue-500/20"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7z"/>
                                        </svg>
                                        Lihat File
                                    </a>

                                    <div class="mt-1 max-w-[180px] truncate text-xs text-gray-400">
                                        {{ basename($profil->file) }}
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">
                                        Tidak ada file
                                    </span>
                                @endif
                            </td>

                            {{-- TANGGAL PENETAPAN --}}
                            <td class="px-4 py-3 align-top">
                                @if($profil->tgl_penetapan)
                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $profil->tgl_penetapan->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">
                                        -
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-400 dark:text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>

                                    <span class="text-sm font-medium">
                                        Belum ada data VMTS
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>