@props(['kriteria', 'tahunAkademik', 'roleData', 'indikators' => []])

<div id="questionDataWrapper" class="space-y-4">

    <div class="flex items-center gap-2 mb-2">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
        </svg>

        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
            Detail Pertanyaan AMI Prodi
        </h4>
    </div>

    {{-- ================= BARIS 1 ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- Kriteria --}}
        <div>
            <label for="kriteria_id"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Pilih Standar / Kriteria Audit
                <span class="text-red-500">*</span>
            </label>

            <select id="kriteria_id"
                name="kriteria_id"
                required
                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white">

                <option value="" disabled selected class="text-gray-400 dark:text-gray-500">
                    -- Pilih Standar / Kriteria Audit --
                </option>

                @foreach($kriteria as $item)
                    <option value="{{ $item->id }}" class="text-gray-900 dark:text-white bg-white dark:bg-gray-800">
                        {{ $item->nama }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- Tahun --}}
        <div>
            <label for="tahun"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Tahun Akademik
                <span class="text-red-500">*</span>
            </label>

            <select id="tahun"
                name="tahun"
                required
                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white">

                <option value="" disabled selected class="text-gray-400 dark:text-gray-500">
                    -- Pilih Tahun Akademik --
                </option>

                @foreach($tahunAkademik as $item)
                    <option value="{{ $item->id }}" class="text-gray-900 dark:text-white bg-white dark:bg-gray-800">
                        {{ $item->tahun_akademik }} - {{ $item->semester }}
                    </option>
                @endforeach

            </select>
        </div>

    </div>

    {{-- ================= BARIS 2 ================= --}}
    <div>

        <label for="indikator_list" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Pilih Pertanyaan (bisa lebih dari satu)
            <span class="text-red-500">*</span>
        </label>

        {{-- Tempat daftar checkbox --}}
        <div id="indikator_container"
            class="border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 p-3">

            {{-- Pesan saat belum pilih kriteria --}}
            <p id="indikator_placeholder" class="text-sm text-gray-500 dark:text-gray-400 text-center py-2">
                Silakan pilih kriteria terlebih dahulu
            </p>

            {{-- Area checkbox (akan diisi JavaScript) --}}
            <div id="indikator_list" class="hidden max-h-60 overflow-y-auto space-y-1.5"></div>

        </div>

        {{-- Ringkasan pertanyaan yang dipilih --}}
        <div id="selected_summary" class="hidden mt-3 rounded-lg border border-green-200 dark:border-green-700 bg-green-50 dark:bg-green-900/20 p-3">
            <p class="text-xs font-semibold text-green-600 dark:text-green-300 mb-1">
                Pertanyaan terpilih (<span id="selected_count">0</span>)
            </p>
            <ul id="selected_list" class="list-disc list-inside text-sm text-gray-700 dark:text-gray-200 space-y-0.5 max-h-32 overflow-y-auto">
            </ul>
        </div>

    </div>

    {{-- ================= BARIS 3 ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Role --}}
        <div>
            <label for="role"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Pengguna
                <span class="text-red-500">*</span>
            </label>

            <select id="role"
                name="role"
                required
                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white">

                <option value="auditor" selected class="text-gray-900 dark:text-white bg-white dark:bg-gray-800">
                    auditor
                </option>

            </select>
        </div>

        {{-- Unit --}}
        <div>
            <label for="unit"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Unit
                <span class="text-red-500">*</span>
            </label>

            <select id="unit"
                name="unit"
                required
                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white">

                <option value="" disabled selected class="text-gray-400 dark:text-gray-500">
                    -- Pilih Unit --
                </option>

            </select>
        </div>

        {{-- Sub Unit --}}
        <div>
            <label for="sub_unit"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Sub Unit
                <span class="text-red-500">*</span>
            </label>

            <select id="sub_unit"
                name="sub_unit"
                required
                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white">

                <option value="" disabled selected class="text-gray-400 dark:text-gray-500">
                    -- Pilih Sub Unit --
                </option>

            </select>
        </div>

    </div>

</div>

<script>
    // Data dari server
    const roleData = @json($roleData);
    const allIndikators = @json($indikators);
    const auditorUnits = roleData.auditor || {};

    document.addEventListener('DOMContentLoaded', function() {
        const kriteriaSelect = document.getElementById('kriteria_id');
        const indikatorList = document.getElementById('indikator_list');
        const indikatorPlaceholder = document.getElementById('indikator_placeholder');
        const selectedSummary = document.getElementById('selected_summary');
        const selectedCount = document.getElementById('selected_count');
        const selectedList = document.getElementById('selected_list');

        const unitSelect = document.getElementById('unit');
        const subUnitSelect = document.getElementById('sub_unit');

        // --- Populate unit & sub unit ---
        function populateUnits() {
            unitSelect.innerHTML = '<option value="" disabled selected class="text-gray-400 dark:text-gray-500">-- Pilih Unit --</option>';
            subUnitSelect.innerHTML = '<option value="" disabled selected class="text-gray-400 dark:text-gray-500">-- Pilih Sub Unit --</option>';
            const units = Object.keys(auditorUnits);
            units.forEach(unit => {
                const option = document.createElement('option');
                option.value = unit;
                option.textContent = unit;
                option.className = 'text-gray-900 dark:text-white bg-white dark:bg-gray-800';
                unitSelect.appendChild(option);
            });
        }

        function populateSubUnits(unit) {
            subUnitSelect.innerHTML = '<option value="" disabled selected class="text-gray-400 dark:text-gray-500">-- Pilih Sub Unit --</option>';
            if (!auditorUnits[unit]) return;
            auditorUnits[unit].forEach(sub => {
                const option = document.createElement('option');
                option.value = sub;
                option.textContent = sub;
                option.className = 'text-gray-900 dark:text-white bg-white dark:bg-gray-800';
                subUnitSelect.appendChild(option);
            });
        }

        unitSelect.addEventListener('change', function() {
            populateSubUnits(this.value);
        });

        // --- Fungsi untuk memperbarui ringkasan pilihan ---
        function updateSelectedSummary() {
            const checkboxes = indikatorList.querySelectorAll('input[type="checkbox"]:checked');
            const count = checkboxes.length;
            selectedCount.textContent = count;

            if (count > 0) {
                selectedSummary.classList.remove('hidden');
                selectedList.innerHTML = '';
                checkboxes.forEach(cb => {
                    const li = document.createElement('li');
                    li.textContent = cb.dataset.full || cb.nextSibling.textContent.trim();
                    li.className = 'text-sm text-gray-700 dark:text-gray-200';
                    selectedList.appendChild(li);
                });
            } else {
                selectedSummary.classList.add('hidden');
            }
        }

        // --- Render checkbox berdasarkan kriteria yang dipilih ---
        function renderIndikators(standarId) {
            // Bersihkan
            indikatorList.innerHTML = '';
            indikatorList.classList.add('hidden');
            indikatorPlaceholder.classList.remove('hidden');

            if (!standarId) {
                indikatorPlaceholder.textContent = 'Silakan pilih kriteria terlebih dahulu';
                selectedSummary.classList.add('hidden');
                return;
            }

            // Filter indikator
            const filtered = allIndikators.filter(item => {
                return item.matrix &&
                    item.matrix.kriteria_audit &&
                    item.matrix.kriteria_audit.standar &&
                    item.matrix.kriteria_audit.standar.id === standarId;
            });

            if (filtered.length === 0) {
                indikatorPlaceholder.textContent = 'Tidak ada pertanyaan untuk kriteria ini';
                selectedSummary.classList.add('hidden');
                return;
            }

            // Sembunyikan placeholder, tampilkan list
            indikatorPlaceholder.classList.add('hidden');
            indikatorList.classList.remove('hidden');

            // Buat checkbox
            filtered.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-start gap-2 p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer';

                // Label sebagai pembungkus agar seluruh area teks bisa diklik
                const label = document.createElement('label');
                label.className = 'flex items-start gap-2 w-full cursor-pointer';

                const cb = document.createElement('input');
                cb.type = 'checkbox';
                cb.name = 'indikator_ids[]';
                cb.value = item.id;
                cb.dataset.full = item.indikator;
                cb.className = 'mt-1 rounded border-gray-300 dark:border-gray-500 text-blue-600 dark:text-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400';

                const span = document.createElement('span');
                span.className = 'text-sm text-gray-800 dark:text-gray-200';
                span.textContent = `${index+1}. ${item.indikator}`;

                label.appendChild(cb);
                label.appendChild(span);
                div.appendChild(label);
                indikatorList.appendChild(div);

                // Event perubahan untuk update ringkasan
                cb.addEventListener('change', updateSelectedSummary);
            });

            // Reset ringkasan
            selectedSummary.classList.add('hidden');
        }

        // --- Event: ketika kriteria berubah ---
        kriteriaSelect.addEventListener('change', function() {
            const standarId = parseInt(this.value);
            renderIndikators(standarId);
        });

        // --- Fungsi reset (dipanggil dari modal) ---
        window.resetQuestionData = function() {
            kriteriaSelect.selectedIndex = 0;
            indikatorList.innerHTML = '';
            indikatorList.classList.add('hidden');
            indikatorPlaceholder.classList.remove('hidden');
            indikatorPlaceholder.textContent = 'Silakan pilih standar / kriteria audit terlebih dahulu.';
            selectedSummary.classList.add('hidden');

            unitSelect.value = '';
            unitSelect.innerHTML = '<option value="" disabled selected class="text-gray-400 dark:text-gray-500">-- Pilih Unit --</option>';
            subUnitSelect.innerHTML = '<option value="" disabled selected class="text-gray-400 dark:text-gray-500">-- Pilih Sub Unit --</option>';
            populateUnits();
        };

        populateUnits();
    });
</script>