{{-- Modal Tambah / Edit Role --}}
<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm"
>
    <div class="mx-4 w-full max-w-md animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white p-6 shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Modal Header --}}
        <div class="mb-5 flex items-center justify-between">

            <h3
                id="modalFormTitle"
                class="text-base font-semibold text-gray-800 dark:text-white/90"
            >
                Tambah Role
            </h3>

            {{-- Close --}}
            <button
                type="button"
                onclick="closeModalFormRole()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>


        {{-- Form --}}
        <form
            id="roleForm"
            action="{{ route('roles.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#roleTableContainer"
        >

            @csrf

            {{-- ID Role --}}
            <input
                type="hidden"
                id="roleId"
                name="id"
                value=""
            >

            {{-- Method --}}
            <input
                type="hidden"
                name="_method"
                value="POST"
            >


            <div class="space-y-4">

                {{-- Nama Role --}}
                <div>

                    <label
                        for="name"
                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300"
                    >
                        Nama Role
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        autocomplete="off"
                        placeholder="Contoh: admin / unit_kerja"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500"
                    >

                </div>

            </div>


            {{-- Footer --}}
            <div class="mt-6 flex items-center justify-end gap-3">

                {{-- Batal --}}
                <button
                    type="button"
                    onclick="closeModalFormRole()"
                    class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:border-gray-700 dark:bg-white/[0.05] dark:text-gray-300 dark:hover:bg-white/[0.08]"
                >
                    Batal
                </button>

                {{-- Submit --}}
                <button
                    type="submit"
                    id="submitRoleButton"
                    class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <span id="submitButtonText">
                        Simpan
                    </span>
                </button>

            </div>

        </form>

    </div>
</div>


<script>
    // =====================================================
    // OPEN MODAL ROLE
    // =====================================================
    async function openModalFormRole(type, id = null)
    {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('roleForm');
        const title = document.getElementById('modalFormTitle');
        const submitButton = document.getElementById('submitButtonText');
        const hiddenId = document.getElementById('roleId');
        const inputName = document.getElementById('name');

        // =================================================
        // OPEN MODAL
        // =================================================
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // =================================================
        // RESET FORM
        // =================================================
        form.reset();
        hiddenId.value = '';
        form.action = "{{ route('roles.store') }}";
        form.querySelector('input[name="_method"]').value = 'POST';

        // =================================================
        // EDIT MODE
        // =================================================
        if (type === 'edit' && id) {

            title.innerText = 'Edit Role';
            submitButton.innerText = 'Update';

            try {

                const url = `/admin/kelola-roles/${id}/edit`;

                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!response.ok) {
                    throw new Error(
                        `HTTP Error ${response.status}`
                    );
                }
                const result = await response.json();
                if (!result.success) {
                    throw new Error(
                        result.message || 'Gagal mengambil data role'
                    );
                }

                // =================================================
                // DATA ROLE
                // =================================================
                const data = result.data ?? result.role;
                hiddenId.value = data.id ?? '';
                inputName.value = data.name ?? '';
                // =================================================
                // UPDATE FORM
                // =================================================
                form.action = `/admin/kelola-roles/${id}`;
                form.querySelector(
                    'input[name="_method"]'
                ).value = 'PUT';
                inputName.focus();
            } catch (error) {
                console.error('Error mengambil role:', error);
                if (window.toast) {
                    window.toast.error(
                        'Gagal mengambil data role'
                    );
                } else if (typeof toastr !== 'undefined') {
                    toastr.error(
                        'Gagal mengambil data role'
                    );
                } else {
                    alert('Gagal mengambil data role');
                }
                closeModalFormRole();
            }
        } else {
            // =================================================
            // CREATE MODE
            // =================================================
            title.innerText = 'Tambah Role';
            submitButton.innerText = 'Simpan';
            form.action = "{{ route('roles.store') }}";
            form.querySelector(
                'input[name="_method"]'
            ).value = 'POST';
            inputName.focus();
        }
    }

    // =====================================================
    // CLOSE MODAL ROLE
    // =====================================================
    function closeModalFormRole()
    {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    // =====================================================
    // EDIT ROLE
    // =====================================================
    function editRole(id)
    {
        openModalFormRole('edit', id);
    }

    // =====================================================
    // ESC CLOSE
    // =====================================================
    document.addEventListener('keydown', function(event) {
        if (event.key !== 'Escape') {
            return;
        }
        const modal = document.getElementById('userModal');
        if (
            modal &&
            !modal.classList.contains('hidden')
        ) {

            closeModalFormRole();
        }
    });
</script>