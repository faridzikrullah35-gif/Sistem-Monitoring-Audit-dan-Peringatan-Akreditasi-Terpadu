// resources/js/components/prodi/form-ptk/edit-ptk.js

/* =========================================================
PTK RICH TEXT EDITOR
========================================================= */
window.PtkEditor = {
    editors: {
        rencana:  { editor: 'ptkRencanaEditor',  hidden: 'ptkRencanaHidden'  },
        tindakan: { editor: 'ptkTindakanEditor', hidden: 'ptkTindakanHidden' },
    },

    exec(key, command) {
        const el = document.getElementById(this.editors[key].editor);

        if (!el) return;

        el.focus();

        const sel = window.getSelection();

        if (!sel.rangeCount) {
            const range = document.createRange();

            range.selectNodeContents(el);
            range.collapse(false);

            sel.removeAllRanges();
            sel.addRange(range);
        }

        try {
            document.execCommand(command, false, null);
        } catch (e) {

            if (command === 'insertUnorderedList') {
                document.execCommand('insertHTML', false, '<ul><li></li></ul>');
            }

            if (command === 'insertOrderedList') {
                document.execCommand('insertHTML', false, '<ol><li></li></ol>');
            }
        }

        this.sync(key);
    },

    sync(key) {
        const { editor, hidden } = this.editors[key];

        const el  = document.getElementById(editor);
        const hid = document.getElementById(hidden);

        if (el && hid) {
            hid.value = el.innerHTML;
        }
    },

    syncAll() {
        Object.keys(this.editors).forEach(key => this.sync(key));
    },

    set(key, html) {
        const { editor, hidden } = this.editors[key];

        const el  = document.getElementById(editor);
        const hid = document.getElementById(hidden);

        if (el) {
            el.innerHTML = html || '';
        }

        if (hid) {
            hid.value = html || '';
        }
    },

    reset() {
        Object.keys(this.editors).forEach(key => this.set(key, ''));
    }
};

/* =========================================================
PTK FLATPICKR
========================================================= */
window.PtkDatepicker = {
    instances: [],

    init() {
        this.destroy();

        const config = {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd F Y',
            allowInput: true,
            disableMobile: true
        };

        ['ptkTanggalSelesai', 'ptkTargetPerbaikan'].forEach(id => {

            const el = document.getElementById(id);

            if (el && typeof flatpickr !== 'undefined') {
                this.instances.push(flatpickr(el, config));
            }
        });
    },

    setDate(index, value) {
        if (value && this.instances[index]) {
            this.instances[index].setDate(value);
        }
    },

    clear() {
        this.instances.forEach(fp => fp.clear());
    },

    destroy() {
        this.instances.forEach(fp => fp.destroy());
        this.instances = [];
    }
};

/* =========================================================
PTK FILE UPLOAD
========================================================= */
window.PtkFileUpload = {
    init() {

        const fileInput   = document.getElementById('ptkFileInput');
        const browseBtn   = document.getElementById('ptkBrowseFileBtn');
        const nameDisplay = document.getElementById('ptkFileNameDisplay');
        const clearBtn    = document.getElementById('ptkClearFileBtn');
        const errorEl     = document.getElementById('ptkFileError');

        if (!fileInput || !browseBtn) return;

        browseBtn.onclick = () => fileInput.click();

        fileInput.onchange = (e) => {

            const file = e.target.files[0];

            errorEl.classList.add('hidden');

            if (!file) {
                this.resetDisplay();
                return;
            }

            if (file.type !== 'application/pdf') {

                errorEl.textContent = 'File harus berformat PDF';
                errorEl.classList.remove('hidden');

                fileInput.value = '';

                this.resetDisplay();

                return;
            }

            if (file.size > 2 * 1024 * 1024) {

                errorEl.textContent = 'Ukuran file maksimal 2 MB';
                errorEl.classList.remove('hidden');

                fileInput.value = '';

                this.resetDisplay();

                return;
            }

            nameDisplay.textContent = `${file.name} (${(file.size / 1024).toFixed(1)} KB)`;

            nameDisplay.classList.remove('text-gray-400');

            clearBtn.classList.remove('hidden');
        };

        clearBtn.onclick = () => {
            fileInput.value = '';
            this.resetDisplay();
        };
    },

    resetDisplay() {

        const nameDisplay = document.getElementById('ptkFileNameDisplay');
        const clearBtn    = document.getElementById('ptkClearFileBtn');

        if (nameDisplay) {
            nameDisplay.textContent = 'Belum ada file dipilih';
            nameDisplay.classList.add('text-gray-400');
        }

        if (clearBtn) {
            clearBtn.classList.add('hidden');
        }
    },

    setExistingFile(filename) {

        const nameDisplay = document.getElementById('ptkFileNameDisplay');
        const clearBtn    = document.getElementById('ptkClearFileBtn');

        if (!filename) {
            this.resetDisplay();
            return;
        }

        if (nameDisplay) {
            nameDisplay.textContent = filename;
            nameDisplay.classList.remove('text-gray-400');
        }

        if (clearBtn) {
            clearBtn.classList.remove('hidden');
        }
    }
};

/* =========================================================
PTK MODAL CONTROLLER
========================================================= */
window.PtkModal = {

    open(ptk) {

        const modal = document.getElementById('ptkModal');
        const form  = document.getElementById('ptkForm');

        form.action = `/prodi/form-ptk/${ptk.id}`;

        this.resetForm();

        [
            'no_ncr',
            'klausul_dokumen',
            'deskripsi_uraian_temuan',
            'kategori_temuan',
            'status_ncr'
        ].forEach(field => {

            const el = form.querySelector(`[name="${field}"]`);

            if (el && ptk[field] !== undefined) {
                el.value = ptk[field] || '';
            }
        });

        PtkDatepicker.init();

        PtkDatepicker.setDate(0, ptk.tanggal_selesai);
        PtkDatepicker.setDate(1, ptk.tanggal_target_perbaikan_auditee);

        PtkEditor.set(
            'rencana',
            ptk.rencana_tindakan_perbaikan_auditee || ''
        );

        PtkEditor.set(
            'tindakan',
            ptk.tindakan_pencegahan_auditee || ''
        );

        PtkFileUpload.setExistingFile(ptk.file_auditee);

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    },

    close() {

        const modal = document.getElementById('ptkModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');

        this.resetForm();

        PtkDatepicker.destroy();
    },

    resetForm() {

        const form = document.getElementById('ptkForm');

        if (form) {
            form.reset();
        }

        PtkEditor.reset();

        PtkFileUpload.resetDisplay();
    }
};

/* =========================================================
GLOBAL FUNCTIONS
========================================================= */
window.openPtkModal = (ptk) => {
    PtkModal.open(ptk);
};

window.closePtkModal = () => {
    PtkModal.close();
};

/* =========================================================
INIT
========================================================= */
document.addEventListener('DOMContentLoaded', () => {

    PtkFileUpload.init();

    const ptkForm = document.getElementById('ptkForm');

    if (!ptkForm) return;

    ptkForm.addEventListener('submit', async (e) => {

        e.preventDefault();

        PtkEditor.syncAll();

        const submitBtn  = document.getElementById('ptkSubmitBtn');
        const originalHtml = submitBtn?.innerHTML;

        if (submitBtn) {

            submitBtn.disabled = true;

            submitBtn.innerHTML = `
                <svg class="animate-spin h-4 w-4 mr-1"
                    fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"/>
                    <path class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Menyimpan...
            `;
        }

        try {

            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            const formData = new FormData(ptkForm);

            const response = await fetch(ptkForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.content,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {

                if (window.toast) {
                    window.toast.success(data.message);
                }

                window.dispatchEvent(
                    new CustomEvent('ptk-updated', {
                        detail: data.data
                    })
                );

                PtkModal.close();

            } else if (data.errors) {

                if (window.toast) {
                    window.toast.error(data.message || 'Validasi gagal');
                }

            } else {

                if (window.toast) {
                    window.toast.error(data.message || 'Terjadi kesalahan');
                }
            }

        } catch (err) {

            console.error('[PTK Submit Error]', err);

            if (window.toast) {
                window.toast.error('Terjadi kesalahan pada server');
            }

        } finally {

            if (submitBtn) {

                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHtml;
            }
        }
    });
});

/* =========================================================
LISTENER
========================================================= */
window.addEventListener('open-ptk-modal', (e) => {

    if (e.detail) {
        PtkModal.open(e.detail);
    }
});