// resources/js/modules/table-refresh.js

/**
 * UNIVERSAL TABLE REFRESH SYSTEM
 * Bisa dipake semua halaman, tinggal panggil
 */

const TableRefresh = {
    /**
     * Refresh tabel berdasarkan ID container
     * @param {string} tableId - ID container tabel (contoh: '#auditorTableContainer')
     * @param {string|null} url - URL untuk fetch (opsional, default: URL sekarang)
     * @returns {Promise<boolean>}
     */
    refresh: async (tableId, url = null) => {
        try {
            const container = document.querySelector(tableId);
            if (!container) return false;

            const fetchUrl = url || window.location.href;

            const response = await fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            });

            const html = await response.text();

            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newContainer = doc.querySelector(tableId);

            if (!newContainer) {
                console.warn(`[TableRefresh] ${tableId} not found in response`);
                return false;
            }

            container.innerHTML = newContainer.innerHTML;
            return true;

        } catch (error) {
            console.error('[TableRefresh]', error);
            return false;
        }
    },
    
    /**
     * Refresh semua tabel yang terdaftar
     */
    refreshAll: async () => {
        const tables = [
            '#auditorTableContainer',
            '#userTableContainer',
            '#dokumenTableContainer',
            '#tahunAkademikTableContainer',
            '#standarTableContainer',
            '#kriteria_audit',
            '#kriteria_page',
            '#akses_auditor_table',
            '#isi_akses_auditor_table'
        ];

        for (const tableId of tables) {
            if (document.querySelector(tableId)) {
                await TableRefresh.refresh(tableId);
            }
        }
    }
};

export default TableRefresh;