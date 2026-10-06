{{-- Modal Tambah / Edit Konten Tentang Kami --}}
<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Konten
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalForm()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form
            id="contentForm"
            action="{{ route('admin.setting-profile.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#tentangKamiTableContainer"
            data-refresh-selects=""
        >
            @csrf
            <input type="hidden" id="contentId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethod" value="POST" />

            <div class="space-y-4 px-6 py-5">

                {{-- Deskripsi (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                            <button type="button" onclick="execContentCmd('deskripsi', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bold">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('deskripsi', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Italic">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('deskripsi', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Underline">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('deskripsi', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bullet List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('deskripsi', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Numbered List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('deskripsi', 'justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Left">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('deskripsi', 'justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('deskripsi', 'justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Right">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                        </div>
                        <div
                            id="deskripsiEditor"
                            contenteditable="true"
                            data-placeholder="Masukkan deskripsi tentang kami..."
                            class="min-h-[100px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"
                            style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                        ></div>
                    </div>
                    <input type="hidden" name="deskripsi" id="deskripsiHidden" value="" />
                </div>

                {{-- Visi (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Visi <span class="text-red-500">*</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                            <button type="button" onclick="execContentCmd('visi', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bold">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('visi', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Italic">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('visi', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Underline">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('visi', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bullet List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('visi', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Numbered List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('visi', 'justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Left">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('visi', 'justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('visi', 'justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Right">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                        </div>
                        <div
                            id="visiEditor"
                            contenteditable="true"
                            data-placeholder="Masukkan visi lembaga..."
                            class="min-h-[80px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"
                            style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                        ></div>
                    </div>
                    <input type="hidden" name="visi" id="visiHidden" value="" />
                </div>

                {{-- Misi (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Misi <span class="text-red-500">*</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                            <button type="button" onclick="execContentCmd('misi', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bold">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('misi', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Italic">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('misi', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Underline">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('misi', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bullet List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('misi', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Numbered List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('misi', 'justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Left">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('misi', 'justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('misi', 'justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Right">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                        </div>
                        <div
                            id="misiEditor"
                            contenteditable="true"
                            data-placeholder="Masukkan misi lembaga..."
                            class="min-h-[80px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"
                            style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                        ></div>
                    </div>
                    <input type="hidden" name="misi" id="misiHidden" value="" />
                </div>

                {{-- Tujuan (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tujuan <span class="text-red-500">*</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                            <button type="button" onclick="execContentCmd('tujuan', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bold">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('tujuan', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Italic">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('tujuan', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Underline">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('tujuan', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bullet List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('tujuan', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Numbered List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execContentCmd('tujuan', 'justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Left">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('tujuan', 'justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                            <button type="button" onclick="execContentCmd('tujuan', 'justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Right">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                            </button>
                        </div>
                        <div
                            id="tujuanEditor"
                            contenteditable="true"
                            data-placeholder="Masukkan tujuan lembaga..."
                            class="min-h-[80px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"
                            style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                        ></div>
                    </div>
                    <input type="hidden" name="tujuan" id="tujuanHidden" value="" />
                </div>

                {{-- Sasaran (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sasaran <span class="text-red-500">*</span>
                    </label>

                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">

                            {{-- Bold --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'bold')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Bold"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/>
                                </svg>
                            </button>

                            {{-- Italic --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'italic')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Italic"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path d="M10 4h4m-2 0v16m-4 0h8"/>
                                </svg>
                            </button>

                            {{-- Underline --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'underline')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Underline"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/>
                                </svg>
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>

                            {{-- Bullet List --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'insertUnorderedList')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Bullet List"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                </svg>
                            </button>

                            {{-- Numbered List --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'insertOrderedList')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Numbered List"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/>
                                </svg>
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>

                            {{-- Align Left --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'justifyLeft')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Align Left"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                                </svg>
                            </button>

                            {{-- Align Center --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'justifyCenter')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Align Center"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/>
                                </svg>
                            </button>

                            {{-- Align Right --}}
                            <button
                                type="button"
                                onclick="execContentCmd('sasaran', 'justifyRight')"
                                class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700"
                                title="Align Right"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/>
                                </svg>
                            </button>

                        </div>

                        <div
                            id="sasaranEditor"
                            contenteditable="true"
                            data-placeholder="Masukkan sasaran lembaga..."
                            class="min-h-[80px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"
                        ></div>
                    </div>

                    <input
                        type="hidden"
                        name="sasaran"
                        id="sasaranHidden"
                        value=""
                    />
                </div>

                {{-- Dibuat Oleh --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Dibuat Oleh <span class="text-gray-400 text-xs">(opsional - kosongkan untuk menggunakan nama user)</span>
                    </label>
                    <input
                        type="text"
                        id="dibuat_oleh"
                        name="dibuat_oleh"
                        placeholder="Masukkan nama pembuat (kosongkan untuk menggunakan nama user)"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500"
                    />
                </div>

                {{-- Status Aktif --}}
                <div class="flex items-center gap-3 pt-2">
                    <input
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        value="1"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04]"
                    >
                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Aktifkan konten ini
                    </label>
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalForm()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    id="submitButton"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="submitText">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* CSS untuk bullet dan number lists */
    #deskripsiEditor ul, #deskripsiEditor ol,
    #visiEditor ul, #visiEditor ol,
    #misiEditor ul, #misiEditor ol,
    #tujuanEditor ul, #tujuanEditor ol,
    #sasaranEditor ul, #sasaranEditor ol {
        margin: 0.5em 0;
        padding-left: 1.5em;
    }

    #deskripsiEditor ul,
    #visiEditor ul,
    #misiEditor ul,
    #tujuanEditor ul,
    #sasaranEditor ul {
        list-style-type: disc;
    }

    #deskripsiEditor ol,
    #visiEditor ol,
    #misiEditor ol,
    #tujuanEditor ol,
    #sasaranEditor ol {
        list-style-type: decimal;
    }

    #deskripsiEditor li,
    #visiEditor li,
    #misiEditor li,
    #tujuanEditor li,
    #sasaranEditor li {
        margin: 0.25em 0;
    }
    
    /* Placeholder style */
    [contenteditable][data-placeholder]:empty:before {
        content: attr(data-placeholder);
        color: #9ca3af;
    }
    
    /* Dark mode placeholder */
    .dark [contenteditable][data-placeholder]:empty:before {
        color: #6b7280;
    }
</style>

<script>
    // ==========================================
    // RICH TEXT EDITOR CORE
    // ==========================================
    const ContentEditor = {
        getEditor(id) {
            const editors = {
                'deskripsi': 'deskripsiEditor',
                'visi': 'visiEditor',
                'misi': 'misiEditor',
                'tujuan': 'tujuanEditor',
                'sasaran': 'sasaranEditor'
            };
            return document.getElementById(editors[id]);
        },

        getHidden(id) {
            const hiddens = {
                'deskripsi': 'deskripsiHidden',
                'visi': 'visiHidden',
                'misi': 'misiHidden',
                'tujuan': 'tujuanHidden',
                'sasaran': 'sasaranHidden'
            };
            return document.getElementById(hiddens[id]);
        },

        execCommand(editorId, command) {
            const editor = this.getEditor(editorId);
            if (!editor) return;

            editor.focus();

            const selection = window.getSelection();
            if (selection.rangeCount === 0) {
                const range = document.createRange();
                range.selectNodeContents(editor);
                range.collapse(false);
                selection.removeAllRanges();
                selection.addRange(range);
            }

            document.execCommand(command, false, null);
            editor.dispatchEvent(new Event('input', { bubbles: true }));
            this.syncToHidden(editorId);
        },

        syncToHidden(editorId) {
            const editor = this.getEditor(editorId);
            const hidden = this.getHidden(editorId);
            if (editor && hidden) {
                hidden.value = editor.innerHTML;
            }
        },

        syncAllToHidden() {
            ['deskripsi', 'visi', 'misi', 'tujuan', 'sasaran'].forEach(id => {
                this.syncToHidden(id);
            });
        },

        reset() {
            ['deskripsi', 'visi', 'misi', 'tujuan', 'sasaran'].forEach(id => {
                const editor = this.getEditor(id);
                if (editor) editor.innerHTML = '';

                const hidden = this.getHidden(id);
                if (hidden) hidden.value = '';
            });
        },

        setContent(id, html) {
            const editor = this.getEditor(id);
            if (editor) {
                editor.innerHTML = html || '';
                this.syncToHidden(id);
            }
        }
    };

    // ==========================================
    // MODAL CONTROLLER
    // ==========================================
    function openCreateModal() {
        const elements = {
            modal: document.getElementById('userModal'),
            form: document.getElementById('contentForm'),
            title: document.getElementById('modalFormTitle'),
            submitText: document.getElementById('submitText'),
            submitButton: document.getElementById('submitButton'),
            formMethod: document.getElementById('formMethod'),
            hiddenId: document.getElementById('contentId'),
            inputDibuatOleh: document.getElementById('dibuat_oleh'),
            checkboxActive: document.getElementById('is_active')
        };

        // Cek semua elemen
        for (const [key, el] of Object.entries(elements)) {
            if (!el) {
                console.error(`Element "${key}" not found`);
                return;
            }
        }

        // OPEN MODAL
        elements.modal.classList.remove('hidden');
        elements.modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // RESET DEFAULT - Pastikan semua field direset
        elements.form.reset();
        ContentEditor.reset();
        elements.hiddenId.value = '';
        elements.formMethod.value = 'POST';
        elements.form.action = "{{ route('admin.setting-profile.store') }}";
        elements.checkboxActive.checked = true;

        // SET DEFAULT VALUES
        const userName = '{{ Auth::user()->name ?? '' }}';
        elements.inputDibuatOleh.value = userName;

        // SET TITLE & BUTTON TEXT
        elements.title.innerText = 'Tambah Konten';
        elements.submitText.innerText = 'Simpan';

        // FOCUS
        setTimeout(() => {
            const editor = ContentEditor.getEditor('deskripsi');
            if (editor) editor.focus();
        }, 100);
    }

    // ==========================================
    // FUNGSI EDIT DENGAN INJECT DATA DARI TABEL
    // ==========================================
    function openEditModal(
        id,
        deskripsi,
        visi,
        misi,
        tujuan,
        sasaran,
        dibuatOleh,
        isActive
    ) {
        const elements = {
            modal: document.getElementById('userModal'),
            form: document.getElementById('contentForm'),
            title: document.getElementById('modalFormTitle'),
            submitText: document.getElementById('submitText'),
            submitButton: document.getElementById('submitButton'),
            formMethod: document.getElementById('formMethod'),
            hiddenId: document.getElementById('contentId'),
            inputDibuatOleh: document.getElementById('dibuat_oleh'),
            checkboxActive: document.getElementById('is_active')
        };

        // Cek semua elemen
        for (const [key, el] of Object.entries(elements)) {
            if (!el) {
                console.error(`Element "${key}" not found`);
                return;
            }
        }

        // OPEN MODAL
        elements.modal.classList.remove('hidden');
        elements.modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // RESET FORM
        elements.form.reset();
        ContentEditor.reset();

        // SET TITLE & BUTTON TEXT
        elements.title.innerText = 'Edit Konten';
        elements.submitText.innerText = 'Update';

        // SET VALUE
        elements.hiddenId.value = id;
        elements.formMethod.value = 'PUT';
        elements.form.action = `/admin/setting-profile/${id}`;

        // Set rich text content
        ContentEditor.setContent('deskripsi', deskripsi || '');
        ContentEditor.setContent('visi', visi || '');
        ContentEditor.setContent('misi', misi || '');
        ContentEditor.setContent('tujuan', tujuan || '');
        ContentEditor.setContent('sasaran', sasaran || '');
        
        elements.inputDibuatOleh.value = dibuatOleh || '';
        elements.checkboxActive.checked = isActive == 1;
    }

    function closeModalForm() {
        const modal = document.getElementById('userModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    // ==========================================
    // GLOBAL FUNGSI (untuk onclick HTML)
    // ==========================================
    function execContentCmd(editorId, command) {
        ContentEditor.execCommand(editorId, command);
    }

    function syncContentEditors() {
        ContentEditor.syncAllToHidden();
    }

    // ==========================================
    // EVENT LISTENERS
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        // Sync hidden inputs on form submit
        const form = document.getElementById('contentForm');
        if (form) {
            form.addEventListener('submit', function() {
                ContentEditor.syncAllToHidden();
            }, true);
        }

        // Auto-sync on input events
        ['deskripsi', 'visi', 'misi', 'tujuan', 'sasaran'].forEach(id => {
            const editor = ContentEditor.getEditor(id);
            if (editor) {
                editor.addEventListener('input', function() {
                    ContentEditor.syncToHidden(id);
                });
            }
        });
    });

    // Close modal on Escape key ONLY
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('userModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeModalForm();
            }
        }
    });

    // Prevent closing on backdrop click
    document.getElementById('userModal').addEventListener('click', function(e) {
        if (e.target.closest('.rounded-2xl')) {
            return;
        }
    });
</script>