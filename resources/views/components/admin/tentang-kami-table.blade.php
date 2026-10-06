@props(['contents' => []])

<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Kelola Konten Tentang Kami
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kelola konten halaman tentang kami yang ditampilkan di landing page SIMANTAP.
            </p>
        </div>

        <button
            onclick="openCreateModal()"
            class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            <i class="fas fa-plus mr-2"></i> Tambah Konten
        </button>
    </div>

    {{-- Tabel --}}
    <div
        id="tentangKamiTableContainer"
        class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden"
    >
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                {{-- ==================== HEADER ==================== --}}
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-12">
                            No
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">
                            Deskripsi
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">
                            Visi
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">
                            Misi
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">
                            Tujuan
                        </th>

                        {{-- BARU --}}
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">
                            Sasaran
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">
                            Dibuat Oleh
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-24">
                            Status
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">
                            Aksi
                        </th>
                    </tr>
                </thead>

                {{-- ==================== BODY ==================== --}}
                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">

                    @forelse($contents as $index => $content)

                    <tr
                        class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition align-top"
                        data-id="{{ $content->id }}"
                        data-deskripsi="{{ htmlspecialchars($content->deskripsi ?? '', ENT_QUOTES, 'UTF-8') }}"
                        data-visi="{{ htmlspecialchars($content->visi ?? '', ENT_QUOTES, 'UTF-8') }}"
                        data-misi="{{ htmlspecialchars($content->misi ?? '', ENT_QUOTES, 'UTF-8') }}"
                        data-tujuan="{{ htmlspecialchars($content->tujuan ?? '', ENT_QUOTES, 'UTF-8') }}"

                        {{-- BARU --}}
                        data-sasaran="{{ htmlspecialchars($content->sasaran ?? '', ENT_QUOTES, 'UTF-8') }}"

                        data-dibuat-oleh="{{ htmlspecialchars($content->pembuat ?? '', ENT_QUOTES, 'UTF-8') }}"
                        data-is-active="{{ $content->is_active ? '1' : '0' }}"
                    >

                        {{-- No --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white text-center align-top">
                            {{ $index + 1 }}
                        </td>

                        {{-- ==================== DESKRIPSI ==================== --}}
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            @if($content->deskripsi)
                                <div class="
                                    max-w-none break-words
                                    [&_p]:mb-2
                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ul]:mb-2
                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                    [&_ol]:mb-2
                                    [&_li]:mb-1
                                    [&_strong]:font-semibold
                                    [&_em]:italic
                                    [&_u]:underline
                                    [&_h1]:text-lg
                                    [&_h1]:font-bold
                                    [&_h1]:mb-2
                                    [&_h2]:text-base
                                    [&_h2]:font-semibold
                                    [&_h2]:mb-2
                                    [&_h3]:text-sm
                                    [&_h3]:font-semibold
                                    [&_h3]:mb-2
                                    [&_blockquote]:border-l-4
                                    [&_blockquote]:border-gray-300
                                    [&_blockquote]:pl-4
                                    [&_blockquote]:italic
                                    [&_blockquote]:text-gray-600
                                    [&_table]:w-full
                                    [&_table]:border-collapse
                                    [&_td]:border
                                    [&_td]:p-2
                                    [&_th]:border
                                    [&_th]:p-2
                                    [&_th]:font-semibold
                                ">
                                    {!! $content->deskripsi !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- ==================== VISI ==================== --}}
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            @if($content->visi)
                                <div class="
                                    max-w-none break-words
                                    [&_p]:mb-2
                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ul]:mb-2
                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                    [&_ol]:mb-2
                                    [&_li]:mb-1
                                    [&_strong]:font-semibold
                                    [&_em]:italic
                                    [&_u]:underline
                                ">
                                    {!! $content->visi !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- ==================== MISI ==================== --}}
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            @if($content->misi)
                                <div class="
                                    max-w-none break-words
                                    [&_p]:mb-2
                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ul]:mb-2
                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                    [&_ol]:mb-2
                                    [&_li]:mb-1
                                    [&_strong]:font-semibold
                                    [&_em]:italic
                                    [&_u]:underline
                                ">
                                    {!! $content->misi !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- ==================== TUJUAN ==================== --}}
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            @if($content->tujuan)
                                <div class="
                                    max-w-none break-words
                                    [&_p]:mb-2
                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ul]:mb-2
                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                    [&_ol]:mb-2
                                    [&_li]:mb-1
                                    [&_strong]:font-semibold
                                    [&_em]:italic
                                    [&_u]:underline
                                ">
                                    {!! $content->tujuan !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- ==================== SASARAN ==================== --}}
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            @if($content->sasaran)
                                <div class="
                                    max-w-none break-words
                                    [&_p]:mb-2
                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ul]:mb-2
                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                    [&_ol]:mb-2
                                    [&_li]:mb-1
                                    [&_strong]:font-semibold
                                    [&_em]:italic
                                    [&_u]:underline
                                    [&_h1]:text-lg
                                    [&_h1]:font-bold
                                    [&_h1]:mb-2
                                    [&_h2]:text-base
                                    [&_h2]:font-semibold
                                    [&_h2]:mb-2
                                    [&_h3]:text-sm
                                    [&_h3]:font-semibold
                                    [&_h3]:mb-2
                                    [&_blockquote]:border-l-4
                                    [&_blockquote]:border-gray-300
                                    [&_blockquote]:pl-4
                                    [&_blockquote]:italic
                                ">
                                    {!! $content->sasaran !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- ==================== DIBUAT OLEH ==================== --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            {{ $content->pembuat }}
                        </td>

                        {{-- ==================== STATUS ==================== --}}
                        <td class="whitespace-nowrap px-4 py-4 align-top">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                {{ $content->is_active
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                                    : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400'
                                }}">
                                {{ $content->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>

                        {{-- ==================== AKSI ==================== --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <div class="flex items-center gap-1">

                                {{-- Edit --}}
                                <button
                                    onclick="openEditModal(
                                        {{ $content->id }},
                                        '{{ addslashes($content->deskripsi ?? '') }}',
                                        '{{ addslashes($content->visi ?? '') }}',
                                        '{{ addslashes($content->misi ?? '') }}',
                                        '{{ addslashes($content->tujuan ?? '') }}',
                                        '{{ addslashes($content->sasaran ?? '') }}',
                                        '{{ addslashes($content->pembuat ?? '') }}',
                                        {{ $content->is_active ? 1 : 0 }}
                                    )"
                                    class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                                    title="Edit Data"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                        />
                                    </svg>
                                    Edit
                                </button>

                                {{-- Hapus --}}
                                <button
                                    type="button"
                                    onclick="deleteContent({{ $content->id }})"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
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
                        <td colspan="9" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                    <svg
                                        class="h-8 w-8 text-gray-400 dark:text-gray-500"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12h6m-6 4h3m5 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                </div>

                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Belum Ada Konten Tentang Kami
                                </h3>

                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Klik tombol "Tambah Konten" untuk membuat konten baru.
                                </p>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    <x-admin.modal.modal-setting-tentang-kami />
</div>