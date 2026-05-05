<div class="space-y-6">

    <!-- STANDAR INDUK 1 -->
    <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
        
        <!-- Header Induk -->
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800/80 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div id="standarTableContainer" class="space-y-6"></div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table id="kriteria_audit" class="min-w-full text-sm text-left">
                
                <!-- HEAD -->
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3">Standar</th>
                        <th class="px-6 py-3">Sub-Kriteria</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">

                    @if ($standars->isEmpty())
                    <!-- KONDISI JIKA DATA STANDAR MASIH KOSONG -->
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada data standar</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Silahkan tambahkan standar terlebih dahulu.</p>
                            </div>
                        </td>
                    </tr>
                    @else
                    <!-- LOOPING DATA - HANYA TAMPILKAN STANDAR YANG PUNYA SUB KRITERIA -->
                    @foreach ($standars as $standar)

                        @php
                            $kriterias = $standar->kriteria ?? collect();
                        @endphp

                        {{-- HANYA TAMPILKAN JIKA PUNYA SUB KRITERIA --}}
                        @if(!$kriterias->isEmpty())

                            @foreach ($kriterias as $loopIndex => $kriteria)

                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition">

                                    {{-- STANDAR hanya muncul di baris pertama --}}
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300 align-top">
                                        @if($loopIndex === 0)
                                            <span class="font-medium">{{ $standar->nama }}</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                        {{ $kriteria->sub_kriteria }}
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">

                                            <!-- EDIT -->
                                            <button 
                                                onclick="openModal('edit', {{ $kriteria->id }})"
                                                class="inline-flex items-center gap-1.5 px-2 py-1 text-xs text-indigo-500 hover:text-indigo-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-md transition"
                                            >
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </button>

                                            <!-- DELETE -->
                                            <button 
                                                onclick="confirmDeleteKriteria({{ $kriteria->id }})"
                                                class="inline-flex items-center gap-1.5 px-2 py-1 text-xs text-red-500 hover:text-red-700 hover:bg-red-50 rounded-md"
                                            >
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>

                                        </div>
                                    </td>

                                </tr>

                            @endforeach

                        @endif

                    @endforeach
                    
                    {{-- TAMBAHKAN PESAN JIKA SEMUA STANDAR TIDAK PUNYA SUB KRITERIA --}}
                    @php
                        $hasAnyKriteria = $standars->contains(function($standar) {
                            return !$standar->kriteria->isEmpty();
                        });
                    @endphp
                    
                    @if(!$hasAnyKriteria)
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada sub kriteria</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Silahkan tambahkan sub kriteria menggunakan tombol di atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                    
                    @endif

                </tbody>
            </table>
        </div>

        <!-- Pagination Dinamis -->
        <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                @php
                    // Hitung total sub kriteria yang sebenarnya ditampilkan
                    $totalDisplayed = $standars->sum(function($standar) {
                        return $standar->kriteria->count();
                    });
                    
                    // Hitung item yang ditampilkan di halaman ini
                    $displayedItems = 0;
                    $itemsBefore = 0;
                    $currentPage = $standars->currentPage();
                    $perPage = $standars->perPage();
                    $allStandars = $standars->getCollection();
                    
                    foreach($allStandars as $standar) {
                        $displayedItems += $standar->kriteria->count();
                    }
                    
                    // Perkiraan first item (kurang akurat untuk kasus ini)
                    $firstItem = ($currentPage - 1) * $perPage + 1;
                    $lastItem = $firstItem + $displayedItems - 1;
                @endphp
                
                @if($displayedItems > 0)
                    Menampilkan {{ $firstItem }} - {{ $lastItem }} dari {{ $totalDisplayed }} data
                @else
                    Menampilkan 0 dari 0 data
                @endif
            </div>
            
            <div class="flex items-center gap-1">
                {{ $standars->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>

<script>
async function loadStandar() {
    const res = await fetch('/standar', {
        headers: { 'Accept': 'application/json' }
    });

    const json = await res.json();

    if (!json.success) return;

    renderStandar(json.data);
}

function renderStandar(data) {
    const container = document.getElementById('standarTableContainer');
    if (!container) return;

    if (!data || data.length === 0) {
        container.innerHTML = `
            <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                    Belum ada data standar. Silakan tambahkan standar baru.
                </div>
            </div>
        `;
        return;
    }

    container.innerHTML = `
        <div id="standarTableContainer" class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3">Standar Kriteria</th>
                            <th class="px-6 py-3 text-right w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                        ${data.map((item, index) => `
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-800 dark:text-white">
                                        ${escapeHtml(item.nama)}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <button 
                                            onclick="openModalStandar('edit', ${item.id}, '${escapeHtml(item.nama)}')"
                                            class="inline-flex items-center gap-1.5 px-2 py-1 text-xs text-indigo-500 hover:text-indigo-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-md transition"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </button>
                                        <button onclick="deleteStandarWithRefresh(${item.id})" 
                                            class="inline-flex items-center gap-1.5 px-2 py-1 text-xs text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-md transition"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        </div>
    `;
}

// Helper function untuk escape HTML (biar aman dari XSS)
function escapeHtml(str) {
    if (!str) return '';
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

document.addEventListener('DOMContentLoaded', () => {
    loadStandar();
});

// ============================================================
// OVERRIDE / TAMBAH FUNCTION REFRESH STANDAR
// ============================================================

// Pastikan loadStandar bisa dipanggil dari sini
window.refreshStandarList = async () => {
    // Cari component criteria-list
    const criteriaList = document.querySelector('[data-criteria-list]');
    
    if (criteriaList && criteriaList.__x) {
        // Kalau pake Alpine
        await criteriaList.__x.$data.loadStandar();
    } else {
        // Kalo gak ada, panggil langsung
        try {
            const res = await fetch('/standar', {
                headers: { 'Accept': 'application/json' }
            });
            const json = await res.json();
            if (json.success && typeof renderStandar !== 'undefined') {
                renderStandar(json.data);
            }
        } catch (err) {
            console.error('Refresh error:', err);
            window.location.reload();
        }
    }
};

// Update function closeModalStandar biar refresh
const originalCloseModalStandar = closeModalStandar;
window.closeModalStandar = function() {
    originalCloseModalStandar();
    setTimeout(() => {
        window.refreshStandarList();
    }, 100);
};

// Update submit handler untuk refresh setelah sukses
const originalSubmitHandler = document.getElementById('formStandar')?.submit;
if (document.getElementById('formStandar')) {
    const form = document.getElementById('formStandar');
    const oldHandler = form.onsubmit;
    form.addEventListener('submit', async function(e) {
        // Biar handler existing jalan dulu
        // Tunggu sebentar setelah submit sukses
        setTimeout(() => {
            window.refreshStandarList();
        }, 500);
    });
}

// ============================================================
// LISTENER UNTUK REFRESH DARI DELETE/UPDATE
// ============================================================

// Listen untuk event refresh
window.addEventListener('standar:refresh', () => {
    console.log('Refresh standar triggered');
    loadStandar();
});

// Expose loadStandar ke global
window.loadStandar = loadStandar;
window.renderStandar = renderStandar;

// Untuk delete, kita trigger event
if (typeof window.confirmDeleteStandar === 'function') {
    const originalDelete = window.confirmDeleteStandar;
    window.confirmDeleteStandar = (id) => {
        showConfirmDialog(
            'Konfirmasi Hapus',
            'Yakin ingin menghapus standar ini?',
            async () => {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    const response = await fetch(`/standar/delete/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken.content,
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        if (window.toast) window.toast.success(data.message || 'Standar berhasil dihapus');
                        loadStandar(); // Refresh langsung
                    } else {
                        if (window.toast) window.toast.error(data.message || 'Gagal menghapus');
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    if (window.toast) window.toast.error('Terjadi kesalahan');
                }
            }
        );
    };
}

// ============================================================
// FUNGSI DELETE KHUSUS DENGAN REFRESH SELECT BOX
// ============================================================

window.deleteStandarWithRefresh = async (id) => {
    if (typeof window.showConfirmDialog === 'function') {
        window.showConfirmDialog(
            'Konfirmasi Hapus',
            'Yakin ingin menghapus standar ini? Semua sub kriteria yang terkait juga akan terhapus.',
            async () => {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    
                    const response = await fetch(`/standar/delete/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken.content,
                            'Accept': 'application/json'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        toastr.success(data.message || 'Standar berhasil dihapus');
                        setTimeout(() => window.location.reload(), 500);
                    } else {
                        toastr.error(data.message || 'Gagal menghapus');
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    toastr.error('Terjadi kesalahan saat menghapus');
                }
            }
        );
    }
};

// Manual refresh select box (fallback jika refreshSelectBox tidak tersedia)
async function manualRefreshSelectBox() {
    try {
        const response = await fetch('/standar/data', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        const select = document.getElementById('standar_id');
        
        if (!select) {
            console.log('Select box standar_id tidak ditemukan');
            return;
        }
        
        // Simpan value yang dipilih sebelumnya
        const oldValue = select.value;
        
        // Clear options (keep first option)
        while (select.options.length > 1) {
            select.remove(1);
        }
        
        // Tambahkan options baru
        const standars = data.standars || data.data || [];
        standars.forEach(standar => {
            const option = document.createElement('option');
            option.value = standar.id;
            option.textContent = standar.nama || standar.name;
            select.appendChild(option);
        });
        
        // Restore previous selection jika masih ada
        if (oldValue && [...select.options].some(opt => opt.value == oldValue)) {
            select.value = oldValue;
        }
        
        console.log(`Manual refresh: select box sekarang memiliki ${select.options.length - 1} options`);
        
    } catch (error) {
        console.error('Manual refresh select error:', error);
    }
}

async function updateSubKriteria(id, formData) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    
    const response = await fetch(`/kriteria/update/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken.content,
            'Accept': 'application/json'
        },
        body: formData
    });
    
    const data = await response.json();
    
    if (response.ok && data.success) {
        toastr.success('Sub kriteria berhasil diupdate');
        
        // ✅ Update langsung di tabel
        const updatedSubKriteria = data.data.sub_kriteria;
        const standarId = data.data.standar_id;
        const standarNama = data.data.standar.nama;
        
        // Cari baris yang diupdate berdasarkan ID kriteria
        const row = document.querySelector(`tr button[onclick*="openModal('edit', ${id})"]`)?.closest('tr');
        
        if (row) {
            // 1. Update teks sub kriteria (kolom ke-2)
            const subKriteriaCell = row.querySelector('td:nth-child(2)');
            if (subKriteriaCell) {
                subKriteriaCell.textContent = updatedSubKriteria;
            }
            
            // 2. Update nama standar (kolom ke-1) - hanya di baris pertama grup
            const standarCell = row.querySelector('td:first-child span');
            if (standarCell && standarCell.textContent !== '') {
                standarCell.textContent = standarNama;
            }
            
            // 3. Jika standar berubah (pindah ke standar lain), perlu pindah baris
            const oldStandarId = row.getAttribute('data-standar-id');
            if (oldStandarId && oldStandarId != standarId) {
                // Standar berubah, perlu memindahkan baris ke grup yang benar
                await moveRowToCorrectStandar(row, standarId, standarNama, id);
            }
        }
        
        // Tutup modal
        closeModal();
        
    } else if (data.errors) {
        // Tampilkan validation errors
        showValidationErrors(data.errors);
    } else {
        toastr.error(data.message || 'Gagal mengupdate sub kriteria');
    }
}

// Fungsi untuk menampilkan validation errors
function showValidationErrors(errors) {
    // Hapus error lama
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid', 'border-red-500');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    
    // Tampilkan error baru
    for (const [field, messages] of Object.entries(errors)) {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.add('is-invalid', 'border-red-500');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback text-red-500 text-xs mt-1';
            errorDiv.innerText = messages[0];
            input.parentNode.appendChild(errorDiv);
        }
    }
}

// Fungsi untuk menambahkan pemisah antar grup
function addSeparatorIfNeeded(tbody) {
    // Optional: tambahkan border atau pemisah visual
    const rows = tbody.querySelectorAll('tr');
    let currentStandar = null;
    
    rows.forEach(row => {
        const standarId = row.getAttribute('data-standar-id');
        if (standarId !== currentStandar) {
            currentStandar = standarId;
            // Tandai baris pertama grup
            row.classList.add('first-in-group');
        } else {
            row.classList.remove('first-in-group');
        }
    });
}

// Override confirmDeleteStandar dengan yang baru
window.confirmDeleteStandar = window.deleteStandarWithRefresh;

// Test fungsi di console
console.log('deleteStandarWithRefresh siap dipakai');
</script>