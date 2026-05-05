<div id="auditordataModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    
    <!-- Modal Wrapper -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">

            <!-- Modal Content -->
            <div class="relative w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-2xl flex flex-col">

                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Akses Auditor
                    </h3>

                    <button type="button" onclick="closeAuditorModal()" 
                        class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="auditorForm"
                    action="{{ route('isi-akses-auditor.store') }}"
                    method="POST"
                    data-ajax
                    data-table-id="#isi_akses_auditor_table"
                >
                    @csrf

                    <input type="hidden" name="setting_akses_auditor_id" id="setting_akses_auditor_id">

                    <!-- Body -->
                    <div class="px-6 py-5 overflow-y-auto max-h-[70vh]">
                        @include('components.akses-auditor.fields.access-checklist', ['auditors' => $auditors])
                        @include('components.akses-auditor.fields.table-access-checklist')
                    </div>
                    
                    <!-- Footer -->
                    <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">

                        <button type="button" onclick="closeAuditorModal()" 
                            class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg">
                            Batal
                        </button>

                        <!-- SIMPAN FORM -->
                        <button type="submit"
                            class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
window.auditorList = @json($auditors);
</script>

@vite(['resources/js/app.js'])