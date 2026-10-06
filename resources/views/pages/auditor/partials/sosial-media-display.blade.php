@props(['sosialMedia' => null])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Sosial Media Prodi</h4>
        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            View Only
        </span>
    </div>

    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div class="overflow-auto" style="max-height: 600px;">
            <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Platform</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Link</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $platforms = [
                            'instagram' => 'Instagram',
                            'facebook'  => 'Facebook',
                            'youtube'   => 'YouTube',
                            'tiktok'    => 'TikTok',
                            'linkedin'  => 'LinkedIn',
                            'website'   => 'Website',
                        ];
                        $hasAny = false;
                        if ($sosialMedia) {
                            foreach ($platforms as $key => $label) {
                                if (!empty($sosialMedia->{$key})) { $hasAny = true; break; }
                            }
                        }
                    @endphp

                    @if($hasAny)
                        @foreach ($platforms as $key => $label)
                            @php $value = $sosialMedia->{$key} ?? null; @endphp
                            @if(!empty($value))
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300 font-medium">{{ $label }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ $value }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-1.5 text-blue-600 hover:underline dark:text-blue-400 break-all">
                                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                            {{ $value }}
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="text-center py-8 text-gray-400 dark:text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                    <span class="text-sm font-medium">Belum ada data Sosial Media</span>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>