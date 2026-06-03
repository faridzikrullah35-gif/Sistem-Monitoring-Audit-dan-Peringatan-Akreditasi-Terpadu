<div class="overflow-x-auto">
    <table id="settingScoreTableContainer" class="w-full text-sm text-left">
        <thead class="text-xs uppercase text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 text-center w-32 font-semibold">Skor</th>
                <th scope="col" class="px-6 py-3 font-semibold">Keterangan</th>
                <th scope="col" class="px-6 py-3 text-center w-32 font-semibold">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">

            @forelse ($settingScores as $item)

                @php
                    $colors = [
                        'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300',
                        'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300',
                        'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300',
                        'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300',
                    ];

                    $badgeColor = $colors[$loop->index % count($colors)];
                @endphp

                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">

                    <!-- Score -->
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center min-w-[48px] h-10 px-3 rounded-lg {{ $badgeColor }} text-base font-bold">
                            {{ $item->nilai_score }}
                        </span>
                    </td>

                    <!-- Keterangan -->
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                        {{ $item->keterangan }}
                    </td>

                    <!-- Aksi -->
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">

                             <!-- Edit -->
                            <button 
                                type="button"
                                onclick="openModal('edit', {{ $item->id }})"
                                class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>

                                <span>Edit</span>
                            </button>

                            <!-- Delete -->
                            <button 
                                type="button"
                                onclick="deleteSettingScore({{ $item->id }})"
                                class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>

                                <span>Hapus</span>
                            </button>

                        </div>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4" class="px-6 py-10">
                        
                        <div class="flex flex-col items-center justify-center text-center">

                            <!-- Icon -->
                            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 mb-4">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 6c0 1.657-3.134 3-7 3S5 7.657 5 6m14 0c0-1.657-3.134-3-7-3S5 4.343 5 6m14 0v6M5 6v6m0 0c0 1.657 3.134 3 7 3s7-1.343 7-3M5 12v6c0 1.657 3.134 3 7 3s7-1.343 7-3v-6"/>
                                </svg>
                                    <path 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        stroke-width="1.8" 
                                        d="M9 17v-2a4 4 0 014-4h6m0 0l-3-3m3 3l-3 3M5 3h8a2 2 0 012 2v4H7a2 2 0 00-2 2v10a2 2 0 01-2-2V5a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>

                            <!-- Text -->
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Belum Ada Data
                            </h3>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Data setting score masih kosong.
                            </p>

                        </div>

                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>
</div>