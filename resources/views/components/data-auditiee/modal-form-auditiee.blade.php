{{-- Modal Tambah / Edit Auditiee --}}
<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm"
>
    <div class="mx-4 w-full max-w-md animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white p-6 shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Modal Header --}}
        <div class="mb-5 flex items-center justify-between">
            <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                Tambah Auditiee
            </h3>
            <button
                type="button"
                onclick="closeModalFormAuditiee()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="AuditieeForm"
            action="{{ route('auditiee.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#auditieeTableContainer"
            data-refresh-selects="users_id">

            @csrf

            <input type="hidden" id="auditieeId" name="id" value="" />
            
            <input type="hidden" name="_method" value="POST">

            <div class="space-y-4">

                {{-- Tahun Akademik --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tahun Akademik <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="tahunAkademik"
                        name="tahun_akademik_id"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85"
                    >
                        <option value="" disabled selected>
                            Pilih Tahun Akademik
                        </option>

                        @foreach($tahunAkademik as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->tahun_akademik }} - {{ $item->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nama Auditiee --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Auditiee <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="namaAuditiee"
                        name="nama_auditiee"
                        placeholder="Masukkan nama auditiee"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500"
                    />
                </div>

            </div>

            {{-- Footer --}}
            <div class="mt-6 flex items-center justify-end gap-3">

                <button
                    type="button"
                    onclick="closeModalFormAuditiee()"
                    class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:border-gray-700 dark:bg-white/[0.05] dark:text-gray-300 dark:hover:bg-white/[0.08]"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white"
                >
                    Simpan
                </button>

            </div>
        </form>

    </div>
</div>

<script>
    async function openModalFormAuditiee(type, id = null)
        {
            const modal = document.getElementById('userModal');
            const form = document.getElementById('AuditieeForm');
            const title = document.getElementById('modalFormTitle');

            // INPUT
            const hiddenId = document.getElementById('auditieeId');
            const inputNama = document.getElementById('namaAuditiee');
            const selectTahunAkademik = document.getElementById('tahunAkademik');

            // OPEN MODAL
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

            // RESET DEFAULT
            form.reset();

            hiddenId.value = '';

            form.action = "{{ route('auditiee.store') }}";

            form.querySelector('input[name="_method"]').value = 'POST';

            // =========================
            // EDIT MODE
            // =========================
            if (type === 'edit' && id) {

                title.innerText = 'Edit Auditiee';

                try {

                    const url = `/auditor/isi-data-auditiee/${id}/edit`;

                    const res = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    const result = await res.json();

                    const data = result.data;

                    // SET VALUE
                    hiddenId.value = data.id ?? '';

                    selectTahunAkademik.value = data.tahun_akademik_id ?? '';
                    
                    inputNama.value = data.nama_auditiee ?? '';

                    // UPDATE ACTION
                    form.action = `/auditor/isi-data-auditiee/${id}`;

                    form.querySelector('input[name="_method"]').value = 'PUT';

                } catch (err) {

                    console.error(err);

                    window.toast?.error('Gagal mengambil data')
                    || toastr.error('Gagal mengambil data');
                }

            } else {

                // =========================
                // CREATE MODE
                // =========================
                title.innerText = 'Tambah Auditiee';

                form.action = "{{ route('auditiee.store') }}";

                form.querySelector('input[name="_method"]').value = 'POST';

                inputNama.focus();
            }
        }

    function closeModalFormAuditiee()
        {
            const modal = document.getElementById('userModal');

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
        }
</script>