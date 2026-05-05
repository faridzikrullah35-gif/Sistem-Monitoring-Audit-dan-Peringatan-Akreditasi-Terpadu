import './bootstrap';
import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

import { Calendar } from '@fullcalendar/core';

import toastr from "toastr";
import "toastr/build/toastr.min.css";

import './confirm-dialog.js';
import TableRefresh from './modules/table-refresh';
import { initAjaxForms, refreshSelectBox, refreshSelectBoxes, refreshAllSelectBoxes, registerSelectBox } from './modules/ajax-form';
import './components/isi-akses-auditor';

/* =========================
   GLOBAL SETUP
========================= */
window.Alpine = Alpine;
window.ApexCharts = ApexCharts;
window.flatpickr = flatpickr;
window.FullCalendar = Calendar;
window.toastr = toastr;

/* =========================
   TOAST WRAPPER (FIX TOTAL)
========================= */
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: 3000,
};

const safeToastMessage = (msg, fallback = 'Terjadi kesalahan') => {
    if (typeof msg === 'string') return msg;
    if (msg instanceof Error) return msg.message;
    if (msg && typeof msg === 'object') return JSON.stringify(msg);
    return fallback;
};

window.toast = {
    success: (m) => toastr.success(safeToastMessage(m, 'Berhasil')),
    error: (m) => toastr.error(safeToastMessage(m, 'Terjadi kesalahan')),
    info: (m) => toastr.info(safeToastMessage(m, '')),
    warning: (m) => toastr.warning(safeToastMessage(m, '')),
};

/* =========================
   GLOBAL STATE EVENT (SINGLE SOURCE OF TRUTH)
========================= */
const EVENT_SUCCESS = 'app:success';



/* =========================
   SAFE FETCH CORE (JSON SAFE PARSE)
========================= */
async function request(url, method = 'POST', body = null) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) throw new Error('CSRF Token meta tag tidak ditemukan.');

    const res = await fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': csrfToken.content,
            'Accept': 'application/json'
        },
        body
    });

    let data = {};
    try {
        const text = await res.text();
        // Cegah crash kalau backend return HTML (misal error 500 Bypass Blade)
        if (text && text.trim().startsWith('{')) {
            data = JSON.parse(text);
        } else {
            console.error('[Request Error] Bukan JSON response:', text.substring(0, 200));
            throw new Error('Server error: Respons bukan format JSON');
        }
    } catch (err) {
        // Kalau errornya dari JSON.parse, lempar error yang lebih manusiawi
        if (err instanceof SyntaxError) {
            throw new Error('Gagal memproses respons dari server');
        }
        throw err; // Lemparkan error aslinya (bukan JSON)
    }

    if (!res.ok) {
        throw (data.message || `Request gagal (HTTP ${res.status})`);
    }

    return data;
}

/* =========================
   UI STATE HANDLER (AVATAR STABIL + NUKE MODE)
========================= */
function updateUI(data) {
    if (!data) return;

    // NAME UPDATE
    if (data.user?.name) {
        document.querySelectorAll('[data-user-name]')
            .forEach(el => el.textContent = data.user.name);
    }

    // PHOTO UPDATE (FULL NUKE MODE)
    // Cek apakah payload mengandung key 'photo' atau 'user.photo'
    const photoPayload = data.photo !== undefined ? data.photo : (data.user?.photo !== undefined ? data.user.photo : undefined);
    
    if (photoPayload !== undefined) {
        const fallback = `https://ui-avatars.com/api/?name=${encodeURIComponent(data.user?.name || 'User')}&background=6366f1&color=fff`;
        const isDeleted = photoPayload === null || photoPayload === '';

        document.querySelectorAll('[data-user-photo]').forEach(el => {
            if (isDeleted) {
                // 1. HAPUS dulu src / background biar gak nongol transitional image
                el.removeAttribute('src');
                el.style.backgroundImage = 'none';
                
                // 2. SET fallback pakai setTimeout biar browser gak natap cache lama
                setTimeout(() => {
                    // Cek apakah ini tag <img> atau div dengan background
                    if (typeof el.tagName === 'string' && el.tagName.toLowerCase() === 'img') {
                        el.src = fallback;
                    } else {
                        el.style.backgroundImage = `url('${fallback}')`;
                    }
                }, 50);
            } else {
                // Ada foto baru -> Set + Anti Cache
                const newSrc = `${photoPayload}?v=${Date.now()}`;
                
                if (typeof el.tagName === 'string' && el.tagName.toLowerCase() === 'img') {
                    el.src = newSrc;
                } else {
                    el.style.backgroundImage = `url('${newSrc}')`;
                }
            }
        });
    }
}

/* =========================
   GLOBAL EVENT BUS (CLEAN)
========================= */
function handleSuccess(data) {
    // Force render ulang dengan sedikit delay biar browser mekso cache
    setTimeout(() => {
        updateUI(data);
    }, 10);
}

// Pasang listener sekali saja, tertib, gak double chaos
window.addEventListener(EVENT_SUCCESS, (e) => {
    handleSuccess(e.detail);
});

// Expose buat kebutuhan global/misc (misal trigger manual dari luar)
window.triggerAppSuccess = (data) => {
    window.dispatchEvent(new CustomEvent(EVENT_SUCCESS, { detail: data }));
};

/* =========================
   AJAX BUTTON HANDLER (DENGAN CUSTOM MODAL)
========================= */
document.addEventListener('click', async (e) => {
    const el = e.target.closest('[data-action]');
    if (!el) return;

    e.preventDefault();
    e.stopPropagation();

    const confirmMessage = el.dataset.confirm;
    
    if (confirmMessage) {
        // Cek apakah custom modal tersedia
        if (typeof window.showConfirmDialog === 'function') {
            // Tampilkan custom modal
            window.showConfirmDialog(
                'Konfirmasi Hapus',
                confirmMessage,
                async () => {
                    // Ini akan dijalankan setelah user klik "Hapus" di modal
                    await executeDeleteAction(el);
                }
            );
        } else {
            // Fallback ke confirm bawaan
            if (!confirm(confirmMessage)) return;
            await executeDeleteAction(el);
        }
    } else {
        await executeDeleteAction(el);
    }
});

// Fungsi eksekusi delete
async function executeDeleteAction(el) {
    const { url, method = 'POST', form } = el.dataset;
    let body = null;

    try {
        // Loading state
        if (el) {
            el.disabled = true;
            el.classList.add('opacity-50');
        }

        if (form) {
            const f = document.querySelector(form);
            if (f) body = new FormData(f);
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const res = await fetch(url, {
            method,
            headers: {
                'X-CSRF-TOKEN': csrfToken.content,
                'Accept': 'application/json'
            },
            body
        });

        const data = await res.json();

        if (window.toast) {
            window.toast.success(data.message);
        }

        window.dispatchEvent(new CustomEvent('app:success', { detail: data }));

        // Refresh table TANPA RELOAD
        const targetTableId = el.getAttribute('data-table-id') || '#auditorTableContainer';
        if (typeof window.refreshTable === 'function') {
            await window.refreshTable(targetTableId);
        } else {
            window.location.reload();
        }

    } catch (err) {
        console.error('[Delete Error]', err);
        if (window.toast) {
            window.toast.error(err.message || 'Terjadi kesalahan');
        }
    } finally {
        if (el) {
            el.disabled = false;
            el.classList.remove('opacity-50');
        }
    }
}

// Helper function untuk show validation errors
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

/* =========================
   COMPONENT LOADER (SCALABLE & AUTO DETECT)
========================= */
document.addEventListener('DOMContentLoaded', () => {

    // Format array: [selector, dynamicImport, ...args (optional)]
    // Auto detect: Default Export -> Named Export pertama
    const components = [
        ['#mapOne', () => import('./components/map')],
        ['#chartOne', () => import('./components/chart/chart-1')],
        ['#chartTwo', () => import('./components/chart/chart-2')],
        ['#chartThree', () => import('./components/chart/chart-3')],
        ['#chartSix', () => import('./components/chart/chart-6')],
        ['#chartEight', () => import('./components/chart/chart-8')],
        ['#chartThirteen', () => import('./components/chart/chart-13')],
        ['#calendar', () => import('./components/calendar-init')],
    ];

    components.forEach(([selector, loader, ...args]) => {
        if (document.querySelector(selector)) {
            loader().then(module => {
                // 1. Cari default export
                let fn = module.default;
                // 2. Kalau gak ada, ambil export pertama yang isinya function
                if (typeof fn !== 'function') {
                    fn = Object.values(module).find(val => typeof val === 'function');
                }
                
                if (typeof fn === 'function') {
                    fn(...args); // Jalankan function, kirim args kalau ada
                } else {
                    console.warn(`[Loader] Gak ketemu export function di module untuk selector: ${selector}`);
                }
            }).catch(err => {
                console.error(`[Loader] Gagal load module ${selector}:`, err);
            });
        }
    });

    /* =========================
        ALPINE STORE
        ========================= */
        document.addEventListener('alpine:init', () => {

            // Header Store
            Alpine.store('header', {
                isMenuOpen: window.innerWidth >= 1280,
                init() {
                    this.isMenuOpen = window.innerWidth >= 1280;
                },
                toggleMenu() {
                    this.isMenuOpen = !this.isMenuOpen;
                }
            });

            // Sidebar Store  
            Alpine.store('sidebar', {
                isExpanded: window.innerWidth >= 1280,
                isMobileOpen: false,
                isHovered: false,
                
                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    this.isMobileOpen = false;
                },
                
                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                },
                
                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },
                
                setHovered(val) {
                    if (window.innerWidth >= 1280 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });

        });

    Alpine.start();

    initAjaxForms();

    // Global function untuk refresh user table
    window.refreshUserTable = () => {
        // Trigger filter change dengan timestamp biar refresh
        if (window.globalFilter) {
            window.globalFilter.setFilter('_refresh', Date.now());
        } else {
            // Fallback: panggil fetch langsung
            const search = document.querySelector('input[name="search"]')?.value || '';
            const role = document.querySelector('select[name="role"]')?.value || '';
            const status = document.querySelector('select[name="status"]')?.value || '';
            
            const params = new URLSearchParams({ search, role, status });
            
            fetch(`/pengguna/filter?${params}`)
                .then(res => res.json())
                .then(data => {
                    const container = document.querySelector('#userTableContainer');
                    if (container && data.html) {
                        container.innerHTML = data.html;
                    }
                })
                .catch(err => console.error('Refresh error:', err));
        }
    };

    // Register all select boxes that need auto-refresh
    const selectBoxes = {
        'standar_id': '/standar/data',
    };
    
    for (const [selectId, url] of Object.entries(selectBoxes)) {
        if (typeof window.registerSelectBox === 'function') {
            window.registerSelectBox(selectId, url);
        }
    }
    
});

// Expose ke window untuk akses global
// window.refreshTable = refreshTable;

window.registerSelectBox('kategori_id', '/kategori/data');
window.registerSelectBox('unit_id', '/unit/data');

// ============================================================
// EXPOSE KE WINDOW
// ============================================================
window.TableRefresh = TableRefresh;
window.refreshTable = TableRefresh.refresh;
window.refreshAllTables = TableRefresh.refreshAll;
window.refreshUserTable = () => TableRefresh.refresh('#userTableContainer');
window.refreshAuditorTable = () => TableRefresh.refresh('#auditorTableContainer');
window.refreshTahunAkademikTable = () => TableRefresh.refresh('#tahunAkademikTableContainer');
window.refreshStandarTable = () => TableRefresh.refresh('#standarTableContainer');
window.refreshKriteriaTable = () => TableRefresh.refresh('#kriteria_audit');
window.refreshAksesAuditorTable = () => TableRefresh.refresh('#akses_auditor_table');
window.refreshIsiAksesAuditorTable = () => TableRefresh.refresh('#isi_akses_auditor_table');

// Refresh semua select dengan atribut data-auto-refresh
window.refreshAllSelectBoxes();