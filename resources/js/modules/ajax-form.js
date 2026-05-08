// resources/js/modules/ajax-form.js

// === CONFIGURATION ===
const SELECT_REFRESH_CONFIG = {
    // Mapping select ID => endpoint URL
    'standar_id': '/standar/data',
    // Tambahkan select box lain di sini
    // 'kategori_id': '/kategori/data',
    // 'unit_id': '/unit/data',
    // 'user_id': '/user/data',
};

/**
 * Universal function untuk refresh select box
 * @param {string} selectId - ID dari select element
 * @param {string|null} url - Optional URL (override config)
 */
export async function refreshSelectBox(selectId, url = null) {
    const select = document.getElementById(selectId);
    if (!select) return false;
    
    // Get endpoint URL
    const endpoint = url || SELECT_REFRESH_CONFIG[selectId];
    if (!endpoint) {
        console.warn(`[RefreshSelect] No endpoint configured for select: ${selectId}`);
        return false;
    }
    
    try {
        const response = await fetch(endpoint, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        // Support multiple response formats
        let items = [];
        if (data.standars) items = data.standars;
        else if (data.kategoris) items = data.kategoris;
        else if (data.units) items = data.units;
        else if (data.users) items = data.users;
        else if (data.data) items = data.data;
        else if (Array.isArray(data)) items = data;
        
        if (!items.length) {
            console.warn(`[RefreshSelect] No items found in response for ${selectId}`);
            return false;
        }
        
        // Save current selected value
        const oldValue = select.value;
        
        // Clear options (keep first option if it's placeholder)
        while (select.options.length > 1) {
            select.remove(1);
        }
        
        // Add new options
        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nama || item.name || item.label || item.nama_kategori || 'No name';
            select.appendChild(option);
        });
        
        // Restore previous selection if still exists
        if (oldValue && [...select.options].some(opt => opt.value == oldValue)) {
            select.value = oldValue;
        }
        
        return true;
        
    } catch (error) {
        console.error(`[RefreshSelect] Error refreshing ${selectId}:`, error);
        return false;
    }
}

/**
 * Refresh multiple select boxes at once
 * @param {string[]} selectIds - Array of select IDs to refresh
 */
export async function refreshSelectBoxes(selectIds) {
    const promises = selectIds.map(id => refreshSelectBox(id));
    await Promise.all(promises);
}

/**
 * Auto-detect and refresh all select boxes in a container
 * @param {HTMLElement} container - Container element (optional)
 */
export async function refreshAllSelectBoxes(container = document) {
    const selects = container.querySelectorAll('select[data-auto-refresh]');
    const promises = Array.from(selects).map(select => {
        const selectId = select.id;
        const endpoint = select.dataset.refreshUrl;
        if (selectId && (endpoint || SELECT_REFRESH_CONFIG[selectId])) {
            return refreshSelectBox(selectId, endpoint);
        }
        return Promise.resolve();
    });
    await Promise.all(promises);
}

/**
 * Register a new select box for auto-refresh
 * @param {string} selectId - ID select element
 * @param {string} url - Endpoint URL
 */
export function registerSelectBox(selectId, url) {
    SELECT_REFRESH_CONFIG[selectId] = url;
}

// === MAIN AJAX FORM HANDLER ===
export function initAjaxForms() {
    document.addEventListener('submit', async (e) => {
        const form = e.target;
        if (!form.matches('[data-ajax]')) return;
        
        e.preventDefault();
        
        const targetTableId = form.dataset.tableId || '#auditorTableContainer';
        
        // Get select boxes to refresh (from form attribute)
        let selectIdsToRefresh = [];
        if (form.dataset.refreshSelects) {
            selectIdsToRefresh = form.dataset.refreshSelects.split(',');
        } else if (form.dataset.refreshSelect) {
            selectIdsToRefresh = [form.dataset.refreshSelect];
        }
        
        // Loading state
        const submitBtn = form.querySelector('[type="submit"]');
        const originalText = submitBtn?.innerHTML;
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...
            </span>`;
        }
        
        try {
            const formData = new FormData(form);
            let method = 'POST';
            let url = form.action;
            
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) method = methodInput.value;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.content,
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok && data.message) {

                if (window.toast) {
                    window.toast.success(data.message);
                }
                
                // === REFRESH SELECT BOXES ===
                // Method 1: From form attribute
                if (selectIdsToRefresh.length > 0) {
                    await refreshSelectBoxes(selectIdsToRefresh);
                }
                
                // Method 2: Auto-detect from config
                for (const [selectId, endpoint] of Object.entries(SELECT_REFRESH_CONFIG)) {
                    if (document.getElementById(selectId)) {
                        await refreshSelectBox(selectId, endpoint);
                    }
                }
                
                // Method 3: Refresh all selects with data-auto-refresh attribute
                await refreshAllSelectBoxes(form);
                
                // Refresh tabel
                if (typeof window.refreshTable === 'function') {
                    await window.refreshTable(targetTableId);
                }
                
                // KHUSUS UNTUK AUDITOR MODAL
                if (form.id === 'auditorForm') {
                    if (window.currentAksesId) {
                        await window.loadAuditorTable(window.currentAksesId);
                    }

                    return; // STOP di sini, jangan lanjut ke closeModal dll
                }

                // Tutup modal
                if (typeof window.closeModal === 'function') {
                    window.closeModal();
                } else {
                    const modal = form.closest('#userModal');
                    if (modal) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                }
                
                form.reset();
            } else if (data.errors) {
                showValidationErrors(form, data.errors);
                if (window.toast) {
                    window.toast.error(data.message || 'Validasi gagal');
                }
            } else if (!response.ok) {
                if (window.toast) {
                    window.toast.error(data.message || 'Terjadi kesalahan pada server');
                }
            }
            
        } catch (error) {
            console.error('[AjaxForm] Error:', error);
            if (window.toast) {
                window.toast.error('Terjadi kesalahan pada server');
            } else {
                toastr.error('Terjadi kesalahan pada server');
            }
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        }
    });
}

function showValidationErrors(form, errors) {
    // Hapus error lama
    form.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid', 'border-red-500');
    });
    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    
    // Tampilkan error baru
    for (const [field, messages] of Object.entries(errors)) {
        const input = form.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.add('is-invalid', 'border-red-500');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback text-red-500 text-xs mt-1';
            errorDiv.innerText = messages[0];
            input.parentNode.appendChild(errorDiv);
        }
    }
}

// === EXPOSE GLOBALLY ===
if (typeof window !== 'undefined') {
    window.refreshSelectBox = refreshSelectBox;
    window.refreshSelectBoxes = refreshSelectBoxes;
    window.refreshAllSelectBoxes = refreshAllSelectBoxes;
    window.registerSelectBox = registerSelectBox;
}