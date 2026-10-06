@props(['sosialMedia' => null])

<div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">

    {{-- HEADER --}}
    <div class="mb-5 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Sosial Media Prodi</h3>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="overflow-x-auto">
        <table id="sosialmedia" class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900/40">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Platform</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Link</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-700 dark:bg-gray-800">
                @php
                    $platforms = [
                        'instagram' => 'Instagram',
                        'facebook'  => 'Facebook',
                        'youtube'   => 'YouTube',
                        'tiktok'    => 'TikTok',
                        'linkedin'  => 'LinkedIn',
                        'website'   => 'Website',
                    ];
                @endphp

                @foreach ($platforms as $key => $label)
                    @php
                        $value = $sosialMedia->{$key} ?? null;
                    @endphp
                    <tr>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $label }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                            @if (!empty($value))
                                <a href="{{ $value }}" target="_blank"
                                   class="text-blue-600 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
                                    {{ $value }}
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex items-center justify-center gap-2">

                                {{-- EDIT --}}
                                <button
                                    type="button"
                                    onclick="openEditSosialMedia(
                                        {{ $sosialMedia->id ?? 'null' }},
                                        @js($key),
                                        @js($label),
                                        @js($value)
                                    )"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-yellow-100 px-3 py-1.5 text-xs font-semibold text-yellow-700 transition-all duration-200 hover:bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:hover:bg-yellow-900/50"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>

                                {{-- HAPUS (hanya muncul kalau ada value) --}}
                                @if (!empty($value) && $sosialMedia && $sosialMedia->id)
                                    <button
                                        type="button"
                                        onclick="deleteSosialMedia(
                                            {{ $sosialMedia->id }},
                                            @js($key),
                                            @js($label)
                                        )"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition-all duration-200 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL EDIT SOSIAL MEDIA (per platform) --}}
<div id="modalSosialMedia"
     class="modal-overlay fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm dark:bg-black/70"
     data-table-id="#sosialmedia">
    <div class="w-full max-w-lg rounded-2xl bg-white shadow-xl dark:bg-gray-800 dark:shadow-black/40">

        {{-- HEADER MODAL --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <h3 id="smModalTitle" class="text-lg font-semibold text-gray-800 dark:text-gray-100">Edit Sosial Media</h3>
            <button type="button" onclick="closeModal('modalSosialMedia')"
                class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- FORM --}}
        <form id="formSosialMedia"
              method="POST"
              action="">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" id="smId">
            <input type="hidden" name="platform" id="smPlatform">

            <div class="space-y-4 px-6 py-5">
                <div>
                    <label id="smFieldLabel"
                        class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Link
                    </label>
                    <input
                        type="url"
                        name="value"
                        id="smValue"
                        placeholder="https://..."
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-900/40"
                    >
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Kosongkan lalu simpan untuk menghapus link platform ini.
                    </p>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="flex items-center justify-end gap-2 border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                <button type="button" onclick="closeModal('modalSosialMedia')"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT SOSIAL MEDIA --}}
<script>
    const updateSosialMediaRoute = "{{ route('prodi.sosial-media.update', ['id' => '__ID__']) }}";
    const SM_TABLE_SELECTOR = '#sosialmedia';

    // ======================================================
    // OPEN MODAL EDIT (per platform)
    // ======================================================
    function openEditSosialMedia(id, platformKey, platformLabel, value) {
        const modal = document.getElementById('modalSosialMedia');
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('formSosialMedia');
        if (!form) return;

        // Set action kalau id ada
        if (id) {
            form.action = updateSosialMediaRoute.replace('__ID__', id);
        } else {
            // Set action (id selalu ada karena record dibuat via firstOrCreate di index)
            form.action = updateSosialMediaRoute.replace('__ID__', id);
        }

        document.getElementById('smId').value = id ?? '';
        document.getElementById('smPlatform').value = platformKey ?? '';
        document.getElementById('smValue').value = value ?? '';

        // Update label & placeholder sesuai platform
        const label = document.getElementById('smFieldLabel');
        if (label) label.textContent = platformLabel + ' URL';

        const input = document.getElementById('smValue');
        if (input) {
            const placeholders = {
                instagram: 'https://instagram.com/username',
                facebook:  'https://facebook.com/username',
                youtube:   'https://youtube.com/@channel',
                tiktok:    'https://tiktok.com/@username',
                linkedin:  'https://linkedin.com/company/...',
                website:   'https://example.ac.id',
            };
            input.placeholder = placeholders[platformKey] ?? 'https://...';
        }

        // Update title modal
        const title = document.getElementById('smModalTitle');
        if (title) title.innerText = 'Edit ' + (platformLabel ?? 'Sosial Media');

        if (typeof clearValidationErrors === 'function') clearValidationErrors(form);
    }

    // ======================================================
    // DELETE (per platform — hanya kosongkan value)
    // ======================================================
    function deleteSosialMedia(id, platformKey, platformLabel) {
        const modal = document.getElementById('globalConfirmModal');
        const title = document.getElementById('confirmTitle');
        const message = document.getElementById('confirmMessage');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        const backdrop = document.getElementById('confirmBackdrop');

        if (!modal || !okBtn || !cancelBtn) {
            console.error('[SosialMedia] Global confirm modal tidak ditemukan.');
            return;
        }

        if (title) title.textContent = 'Konfirmasi Hapus';
        if (message) {
            message.textContent =
                `Yakin ingin menghapus link ${platformLabel}? Tindakan ini tidak dapat dibatalkan.`;
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const cleanup = () => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            okBtn.onclick = null;
            cancelBtn.onclick = null;
            if (backdrop) backdrop.onclick = null;
        };

        cancelBtn.onclick = () => cleanup();
        if (backdrop) backdrop.onclick = () => cleanup();

        okBtn.onclick = async () => {
            const originalText = okBtn.innerHTML;
            okBtn.disabled = true;
            cancelBtn.disabled = true;

            okBtn.innerHTML = `
                <span class="inline-flex items-center gap-2">
                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Menghapus...
                </span>
            `;

            const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

            // Kirim PUT ke route update dengan value = null (kosong)
            const form = document.getElementById('formSosialMedia');
            const formData = new FormData(form);
            formData.set('platform', platformKey);
            formData.set('value', '');

            try {
                const response = await fetch(updateSosialMediaRoute.replace('__ID__', id), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                let data = {};
                try { data = await response.json(); } catch (e) { data = {}; }

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal menghapus sosial media.');
                }

                cleanup();

                window.toast?.success(data.message || `${platformLabel} berhasil dihapus.`);

                if (window.TableRefresh && typeof window.TableRefresh.refresh === 'function') {
                    await window.TableRefresh.refresh(SM_TABLE_SELECTOR);
                } else {
                    location.reload();
                }

            } catch (error) {
                console.error('[SosialMedia Delete]', error);
                okBtn.disabled = false;
                cancelBtn.disabled = false;
                okBtn.innerHTML = originalText;
                window.toast?.error(error.message || 'Terjadi kesalahan saat menghapus data.');
            }
        };
    }
</script>