<!-- resources/views/components/user/data-table.blade.php -->
<div id="userTableContainer">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Sub Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase hidden md:table-cell">Nama</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">

                        <!-- Pengguna -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-bold text-sm mr-3">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Unit -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                            {{ $user->unit ?? '-' }}
                        </td>

                        <!-- Sub Unit -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                            {{ $user->sub_unit ?? '-' }}
                        </td>

                        <!-- Role -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <!-- Nama -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden md:table-cell">
                            {{ $user->name }}
                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                
                                <!-- Tombol Edit (Kuning) -->
                                <button 
                                    onclick="openModal('edit', {{ $user->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg 
                                        bg-amber-100 hover:bg-amber-200 
                                        text-amber-700 hover:text-amber-900 
                                        dark:bg-amber-900/30 dark:hover:bg-amber-900/50 
                                        dark:text-amber-400 dark:hover:text-amber-300
                                        transition-all duration-200 
                                        focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2
                                        dark:focus:ring-offset-gray-800"
                                    title="Edit user"
                                >
                                    <!-- Icon Pencil (edit) -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="hidden sm:inline">Edit</span>
                                </button>

                                <!-- Tombol Hapus -->
                                <button
                                    type="button"
                                    onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20"
                                >
                                    <svg
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>

                                    <span>Hapus</span>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <!-- Icon Empty Box -->
                                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <div>
                                        <p class="text-base font-medium text-gray-500 dark:text-gray-400">
                                            Tidak ada data ditemukan
                                        </p>
                                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">
                                            Coba ubah filter atau tambahkan data baru
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    // =====================================================
    // DELETE USER (Pakai confirmDelete dari app.js)
    // =====================================================
    window.deleteUser = (id, name) => {
        if (typeof confirmDelete === 'function') {
            confirmDelete(
                'Konfirmasi Hapus',
                `Yakin ingin menghapus user "${name}"? Data yang terkait dengan user ini juga akan ikut terhapus.`,
                () => {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (!csrfToken) {
                        window.toast?.error('CSRF token tidak ditemukan.');
                        return;
                    }

                    fetch(`/admin/others/pengguna/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(async response => {
                        let data = {};
                        try {
                            data = await response.json();
                        } catch (e) {
                            throw new Error('Terjadi kesalahan pada server.');
                        }
                        if (!response.ok) {
                            throw new Error(data.message || 'Gagal menghapus user.');
                        }
                        return data;
                    })
                    .then(data => {
                        window.toast?.success(data.message || 'User berhasil dihapus.');
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    })
                    .catch(error => {
                        console.error('[Delete User Error]', error);
                        window.toast?.error(error.message || 'Terjadi kesalahan saat menghapus user.');
                    });
                }
            );
        } else {
            // Fallback ke confirm bawaan
            if (!confirm(`Yakin ingin menghapus user "${name}"?`)) {
                return;
            }
            // Lanjutkan proses hapus
            executeDeleteUser(id);
        }
    };
</script>