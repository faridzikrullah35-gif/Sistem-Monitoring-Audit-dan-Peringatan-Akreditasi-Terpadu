{{-- Modal Detail — dipanggil via onclick dari icon file di tabel --}}
<div
    id="modalDetailNCR"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm"
>
    <div class="mx-4 w-full max-w-md animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white p-6 shadow-xl dark:border-gray-800 dark:bg-gray-900">

        <div class="mb-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-500/10">
                    <svg class="h-4.5 w-4.5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">File Lampiran</h3>
            </div>
            <button
                type="button"
                onclick="closeModalDetailNCR()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-3">
            <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4 dark:border-gray-800">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10">
                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p id="detailFileName" class="truncate text-sm font-medium text-gray-800 dark:text-white/85">dokumen-ncr-001.pdf</p>
                    <p id="detailFileSize" class="text-xs text-gray-400 dark:text-gray-500">2.4 MB</p>
                </div>
            </div>
        </div>

        <div class="mt-5 flex items-center justify-end gap-3">
            <a
                href="#"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Unduh File
            </a>
        </div>
    </div>
</div>

<script>
    function openModalDetailNCR(fileName, fileSize, fileUrl) {
        document.getElementById('detailFileName').textContent = fileName || 'dokumen-ncr.pdf';
        document.getElementById('detailFileSize').textContent = fileSize || '2.4 MB';
        const modal = document.getElementById('modalDetailNCR');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModalDetailNCR() {
        const modal = document.getElementById('modalDetailNCR');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

</script>