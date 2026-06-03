{{-- resources/views/components/page-data-auditee/auditee-table.blade.php --}}
@props(['auditees'])

<div class="w-full overflow-x-auto">
    <table class="w-full min-w-[500px] border-collapse text-left">
        <thead>
            <tr class="border-b border-gray-200 bg-gray-50 dark:border-gray-800 dark:bg-gray-900">
                <th class="px-4 py-3 text-sm font-semibold text-gray-600 dark:text-gray-300">#</th>
                <th class="px-4 py-3 text-sm font-semibold text-gray-600 dark:text-gray-300">
                    <div class="flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="currentColor"/>
                        </svg>
                        <span>Nama Auditee</span>
                    </div>
                </th>
                <th class="px-4 py-3 text-sm font-semibold text-gray-600 dark:text-gray-300">
                    <div class="flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 4H18V2H16V4H8V2H6V4H5C3.89 4 3.01 4.9 3.01 6L3 20C3 21.1 3.89 22 5 22H19C20.1 22 21 21.1 21 20V6C21 4.9 20.1 4 19 4ZM19 20H5V10H19V20ZM19 8H5V6H19V8Z" fill="currentColor"/>
                        </svg>
                        <span>Tahun Akademik</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($auditees as $auditee)
                <tr
                    x-show="
                        selectedTahun === '' ||
                        selectedTahun == '{{ $auditee->tahun_akademik_id }}'
                    "
                    class="border-b border-gray-100 hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-900/50"
                >
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        <x-page-data-auditee.fields.nama-auditee :auditee="$auditee" />
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        <x-page-data-auditee.fields.tahun-akademik :auditee="$auditee" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V5H19V19ZM7 7H17V9H7V7ZM7 11H17V13H7V11ZM7 15H14V17H7V15Z" fill="currentColor"/>
                            </svg>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data auditee.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            <tr
                x-show="
                    selectedTahun !== '' &&
                    !@js($auditees->pluck('tahun_akademik_id')->unique()->values()).includes(Number(selectedTahun))
                "
            >
                <td colspan="3" class="px-4 py-8 text-center">
                    <div class="flex flex-col items-center justify-center gap-3">

                        <svg
                            width="48"
                            height="48"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="text-gray-400"
                        >
                            <path
                                d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V5H19V19ZM7 7H17V9H7V7ZM7 11H17V13H7V11ZM7 15H14V17H7V15Z"
                                fill="currentColor"
                            />
                        </svg>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Data auditee tidak ditemukan.
                        </p>

                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>