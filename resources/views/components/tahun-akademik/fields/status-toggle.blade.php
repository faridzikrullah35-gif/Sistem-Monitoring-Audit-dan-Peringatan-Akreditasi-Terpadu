<div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
    <div class="flex items-center gap-2">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div>
            <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Status Periode</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Aktifkan periode ini sebagai tahun akademik berjalan. <span class="font-semibold text-yellow-600 dark:text-yellow-400">*(Hanya 1 yang boleh aktif)</span></p>
        </div>
    </div>
    <div class="flex items-center">
        <button type="button" id="statusToggle" onclick="toggleStatus()" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 bg-gray-300 dark:bg-gray-600" role="switch" aria-checked="false">
            <span id="toggleDot" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
        </button>
        <input type="hidden" name="status" id="statusValue" value="Non Aktif">
        <span id="statusText" class="ml-3 text-sm font-medium text-gray-600 dark:text-gray-400">Nonaktif</span>
    </div>
</div>

<script>
    // Untuk tahun akademik, defaultnya kita set FALSE (Nonaktif) saat Create, 
    // karena biasanya tahun akademik baru belum langsung aktif.
    let isActive = false; 

    function toggleStatus() {
        const toggle = document.getElementById('statusToggle');
        const dot = document.getElementById('toggleDot');
        const text = document.getElementById('statusText');
        const value = document.getElementById('statusValue');

        isActive = !isActive;

        if (isActive) {
            toggle.classList.remove('bg-gray-300', 'dark:bg-gray-600');
            toggle.classList.add('bg-blue-600');

            dot.classList.remove('translate-x-0');
            dot.classList.add('translate-x-5');

            text.classList.remove('text-gray-600', 'dark:text-gray-400');
            text.classList.add('text-blue-600', 'dark:text-blue-400');

            text.innerText = 'Aktif';
            value.value = 'Aktif'; 
        } else {
            toggle.classList.remove('bg-blue-600');
            toggle.classList.add('bg-gray-300', 'dark:bg-gray-600');

            dot.classList.remove('translate-x-5');
            dot.classList.add('translate-x-0');

            text.classList.remove('text-blue-600', 'dark:text-blue-400');
            text.classList.add('text-gray-600', 'dark:text-gray-400');

            text.innerText = 'Nonaktif';
            value.value = 'Non Aktif'; 
        }
    }
</script>