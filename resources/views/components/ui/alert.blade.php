{{-- resources/views/components/ui/alert.blade.php --}}
<div id="globalConfirmModal" class="fixed inset-0 z-[100] hidden" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div id="confirmBackdrop" class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
    
    <!-- Container -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <!-- Modal Panel -->
            <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all">
                
                <!-- Body Modal -->
                <div class="p-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 dark:bg-red-900/30 mb-4">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    
                    <h3 id="confirmTitle" class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                        Konfirmasi Hapus
                    </h3>
                    <p id="confirmMessage" class="text-sm text-gray-500 dark:text-gray-400">
                        Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 rounded-b-2xl flex justify-end gap-3">
                    <button type="button" id="confirmCancelBtn" class="px-4 py-2 text-sm font-medium rounded-lg text-gray-700 bg-white dark:text-gray-300 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 hover:bg-gray-50 dark:hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="button" id="confirmOkBtn" class="px-4 py-2 text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
