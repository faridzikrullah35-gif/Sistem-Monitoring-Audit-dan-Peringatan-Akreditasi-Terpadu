{{-- resources/views/components/penilaian-kinerja/drawer.blade.php --}}
<div id="drawerPenilaian" class="fixed inset-0 z-50 hidden overflow-hidden" aria-labelledby="drawerPenilaianTitle" role="dialog" aria-modal="true">
    <div id="drawerOverlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity duration-300" onclick="closeDrawerPenilaian()"></div>
    <div id="drawerPanel" class="absolute right-0 top-0 h-full w-full max-w-3xl transform translate-x-full transition-transform duration-300 ease-out bg-white dark:bg-gray-900 shadow-2xl">
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h3 id="drawerPenilaianTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">Isi Penilaian Kinerja</h3>
            </div>
            <button type="button" onclick="closeDrawerPenilaian()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Body Form -->
        <form id="formPenilaian" action="{{ route('prodi.penilaian-kinerja.store') }}" method="POST" data-ajax="1">
            @csrf
            @method('POST')
            <input type="hidden" id="penilaianId" name="id" value="" />

            <div class="overflow-y-auto px-6 py-5" style="max-height: calc(100vh - 180px);">
                <!-- Informasi Audit (readonly) -->
                <div class="mb-6 rounded-xl border border-gray-200 bg-gray-50/50 p-4 dark:border-gray-700 dark:bg-white/[0.02]">
                    <h4 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center gap-2">
                        <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        Informasi Audit
                    </h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Nama Indikator</label>
                            <p id="detailIndikator" class="mt-1 text-sm text-gray-800 dark:text-white/85">-</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Skor Audit</label>
                            <p id="detailSkor" class="mt-1 text-sm text-gray-800 dark:text-white/85">-</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Temuan Auditor</label>
                        <textarea id="detailTemuan" rows="2" readonly class="mt-1 w-full rounded-lg border border-gray-200 bg-white/50 px-3.5 py-2 text-sm text-gray-600 dark:border-gray-700 dark:bg-white/[0.02] dark:text-gray-400 cursor-not-allowed">-</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Panduan Auditor</label>
                        <textarea id="detailPanduan" rows="2" readonly class="mt-1 w-full rounded-lg border border-gray-200 bg-white/50 px-3.5 py-2 text-sm text-gray-600 dark:border-gray-700 dark:bg-white/[0.02] dark:text-gray-400 cursor-not-allowed">-</textarea>
                    </div>
                </div>

                <!-- Penilaian Kinerja Prodi -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center gap-2">
                        <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.16a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                        Penilaian Kinerja Program Studi
                    </h4>

                    <div>
                        <label for="analisis_penyebab" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Analisis Penyebab <span class="text-red-500">*</span></label>
                        <textarea id="analisis_penyebab" name="analisis_penyebab" rows="4" placeholder="Tuliskan penyebab utama berdasarkan hasil evaluasi Program Studi..." required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <div>
                        <label for="rencana_perbaikan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Rencana Perbaikan <span class="text-red-500">*</span></label>
                        <textarea id="rencana_perbaikan" name="rencana_perbaikan" rows="4" placeholder="Tuliskan rencana tindak lanjut yang akan dilakukan..." required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="target_penyelesaian" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Target Penyelesaian <span class="text-red-500">*</span></label>
                            <input type="date" id="target_penyelesaian" name="target_penyelesaian" required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500" />
                        </div>
                        <div>
                            <label for="penanggung_jawab" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Penanggung Jawab <span class="text-red-500">*</span></label>
                            <select id="penanggung_jawab" name="penanggung_jawab" required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih Penanggung Jawab</option>
                                <option value="Ketua Prodi">Ketua Prodi</option>
                                <option value="Sekretaris Prodi">Sekretaris Prodi</option>
                                <option value="Gugus Mutu">Gugus Mutu</option>
                                <option value="Dosen">Dosen</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="catatan_tambahan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan Tambahan <span class="text-xs font-normal text-gray-400 dark:text-gray-500">(Opsional)</span></label>
                        <textarea id="catatan_tambahan" name="catatan_tambahan" rows="2" placeholder="Tambahkan catatan jika diperlukan..." class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"></textarea>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800 bg-white dark:bg-gray-900">
                <button type="button" onclick="closeDrawerPenilaian()" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Simpan Penilaian
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // ============================================
    // DRAWER CONTROLS
    // ============================================
    function openDrawerPenilaian(id = null) {
        const drawer = document.getElementById('drawerPenilaian');
        const panel = document.getElementById('drawerPanel');
        const overlay = document.getElementById('drawerOverlay');
        const form = document.getElementById('formPenilaian');
        form.reset();
        document.getElementById('detailIndikator').textContent = '-';
        document.getElementById('detailSkor').textContent = '-';
        document.getElementById('detailTemuan').value = '-';
        document.getElementById('detailPanduan').value = '-';
        drawer.classList.remove('hidden');
        drawer.classList.add('block');
        requestAnimationFrame(() => {
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');
        });
        if (id) {
            fetch(`/prodi/penilaian-kinerja/${id}/edit`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;
                const item = data.data;
                document.getElementById('detailIndikator').textContent = item.indikator || '-';
                document.getElementById('detailSkor').textContent = item.skor_audit || '-';
                document.getElementById('detailTemuan').value = item.temuan_auditor || '-';
                document.getElementById('detailPanduan').value = item.panduan_auditor || '-';
                if (item.penilaian) {
                    document.getElementById('analisis_penyebab').value = item.penilaian.analisis_penyebab || '';
                    document.getElementById('rencana_perbaikan').value = item.penilaian.rencana_perbaikan || '';
                    document.getElementById('target_penyelesaian').value = item.penilaian.target_penyelesaian || '';
                    document.getElementById('penanggung_jawab').value = item.penilaian.penanggung_jawab || '';
                    document.getElementById('catatan_tambahan').value = item.penilaian.catatan_tambahan || '';
                    document.getElementById('penilaianId').value = item.penilaian.id || '';
                }
                const formAction = document.getElementById('formPenilaian');
                if (item.penilaian?.id) {
                    formAction.action = `/prodi/penilaian-kinerja/${item.penilaian.id}`;
                    const methodField = formAction.querySelector('input[name="_method"]');
                    if (methodField) methodField.value = 'PUT';
                } else {
                    formAction.action = '{{ route('prodi.penilaian-kinerja.store') }}';
                    const methodField = formAction.querySelector('input[name="_method"]');
                    if (methodField) methodField.value = 'POST';
                }
            })
            .catch(err => console.error('Error fetching data:', err));
        }
        document.getElementById('penilaianId').value = id || '';
    }

    function closeDrawerPenilaian() {
        const drawer = document.getElementById('drawerPenilaian');
        const panel = document.getElementById('drawerPanel');
        const overlay = document.getElementById('drawerOverlay');
        panel.classList.remove('translate-x-0');
        panel.classList.add('translate-x-full');
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');
        setTimeout(() => {
            drawer.classList.add('hidden');
            drawer.classList.remove('block');
        }, 300);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDrawerPenilaian();
    });
</script>

<style>
    #drawerPanel { transition: transform 300ms cubic-bezier(0.4, 0, 0.2, 1); }
    #drawerOverlay { transition: opacity 300ms ease; }
    #drawerPenilaian .overflow-y-auto::-webkit-scrollbar { width: 6px; }
    #drawerPenilaian .overflow-y-auto::-webkit-scrollbar-track { background: transparent; }
    #drawerPenilaian .overflow-y-auto::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 9999px; }
    #drawerPenilaian .overflow-y-auto::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    .dark #drawerPenilaian .overflow-y-auto::-webkit-scrollbar-thumb { background: #374151; }
    .dark #drawerPenilaian .overflow-y-auto::-webkit-scrollbar-thumb:hover { background: #4b5563; }
</style>