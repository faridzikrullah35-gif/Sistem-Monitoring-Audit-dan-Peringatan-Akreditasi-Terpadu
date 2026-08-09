@extends('layouts.app')

@section('title', 'Identitas Prodi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Identitas Prodi" />

    <div class="space-y-6">
        <x-identitas-prodi.vmts :profil="$profil" />
        <x-identitas-prodi.rip :dokumenRip="$dokumenRip" />
        <x-identitas-prodi.renstra :dokumenRenstra="$dokumenRenstra" />
        <x-identitas-prodi.renop :dokumenRenop="$dokumenRenop" />
        <x-identitas-prodi.mou :dokumenMou="$dokumenMou" />
        <x-identitas-prodi.dtps />
        <x-identitas-prodi.mahasiswa />
        <x-identitas-prodi.rasio />
    </div>
@endsection

@push('scripts')
<script>
    // ======================================================
    // ROUTE UPDATE
    // ======================================================

    const updateRouteBase =
    "{{ route('prodi.identitas-prodi.dokumen.update',['id'=>'__ID__']) }}";

    // ======================================================
    // RESET DATEPICKER
    // ======================================================

    function resetDatepicker(form){

        form.querySelectorAll(".datepicker").forEach(input=>{

            if(input._flatpickr){

                input._flatpickr.clear();

            }

        });

    }


    // ======================================================
    // SET DATEPICKER
    // ======================================================

    function setDatepicker(form,name,value){

        const input=form.querySelector(`[name="${name}"]`);

        if(!input) return;

        if(input._flatpickr){

            input._flatpickr.setDate(value,true);

        }else{

            input.value=value;

        }

    }


    // ======================================================
    // OPEN MODAL TAMBAH
    // ======================================================

    function openModal(modalId){

        const modal=document.getElementById(modalId);

        if(!modal) return;

        modal.classList.remove("hidden");

        document.body.style.overflow="hidden";

        const form=modal.querySelector("form");

        if(!form) return;

        form.reset();

        resetDatepicker(form);

        form.action="{{ route('prodi.identitas-prodi.dokumen.store') }}";

        const method=form.querySelector('[name="_method"]');

        if(method){

            method.value="POST";

        }

        const file=form.querySelector('[name="file"]');

        if(file){

            file.required=true;

            file.value="";

        }

        clearValidationErrors(form);

        const title=modal.querySelector("h3");

        const kategori=form.querySelector('[name="kategori"]');

        if(title && kategori){

            title.innerText="Tambah "+kategori.value;

        }

    }


    // ======================================================
    // OPEN MODAL EDIT
    // ======================================================

    function openEditModal(
        modalId,
        id,
        nama,
        penetapan,
        revisi,
        keterangan
    ){

        const modal=document.getElementById(modalId);

        if(!modal) return;

        modal.classList.remove("hidden");

        document.body.style.overflow="hidden";

        const form=modal.querySelector("form");

        if(!form) return;

        form.action=updateRouteBase.replace("__ID__",id);

        const method=form.querySelector('[name="_method"]');

        if(method){

            method.value="PUT";

        }

        form.querySelector('[name="nama_dokumen"]').value=nama ?? "";

        form.querySelector('[name="keterangan"]').value=keterangan ?? "";

        setDatepicker(form,"tanggal_penetapan",penetapan);

        setDatepicker(form,"tanggal_revisi",revisi);

        const file=form.querySelector('[name="file"]');

        if(file){

            file.required=false;

            file.value="";

        }

        clearValidationErrors(form);

        const title=modal.querySelector("h3");

        const kategori=form.querySelector('[name="kategori"]');

        if(title && kategori){

            title.innerText="Edit "+kategori.value;

        }

    }


    // ======================================================
    // CLOSE MODAL
    // ======================================================

    function closeModal(modalId){

        const modal=document.getElementById(modalId);

        if(!modal) return;

        modal.classList.add("hidden");

        document.body.style.overflow="auto";

    }


    // ======================================================
    // ESC CLOSE
    // ======================================================

    document.addEventListener("keydown",function(e){

        if(e.key!=="Escape") return;

        document.querySelectorAll(".modal-overlay").forEach(modal=>{

            if(!modal.classList.contains("hidden")){

                closeModal(modal.id);

            }

        });

    });


    // ======================================================
    // CLEAR VALIDATION
    // ======================================================

    function clearValidationErrors(form){

        form.querySelectorAll(".is-invalid").forEach(el=>{

            el.classList.remove("is-invalid");

            el.classList.remove("border-red-500");

        });

        form.querySelectorAll(".invalid-feedback").forEach(el=>{

            el.remove();

        });

    }


    // ======================================================
    // SHOW VALIDATION
    // ======================================================

    function showValidationErrorsLocal(form,errors){

        clearValidationErrors(form);

        Object.entries(errors).forEach(([field,messages])=>{

            const input=form.querySelector(`[name="${field}"]`);

            if(!input) return;

            input.classList.add("is-invalid");

            input.classList.add("border-red-500");

            const div=document.createElement("div");

            div.className="invalid-feedback text-red-500 text-xs mt-1";

            div.innerHTML=messages[0];

            input.parentNode.appendChild(div);

        });

    }

    // ======================================================
    // EXEC COMMAND FOR RICH EDITOR
    // ======================================================
    function execCmdModal(editorId, command) {

    const editor = document.getElementById(editorId);

    editor.focus();

    const result = document.execCommand(command, false, null);

    console.log("COMMAND :", command);
    console.log("RESULT :", result);
    console.log(editor.innerHTML);

    syncVmtsEditors();
}

    // ======================================================
    // TABLE TARGET
    // ======================================================

    function resolveTableId(modal){

        return modal.dataset.tableId ?? null;

    }

    /* =========================================================
    AJAX SUBMIT + TOASTR + AUTO REFRESH TABLE
    ========================================================= */

    // 🔥 HANYA UNTUK DOKUMEN (RIP, RENSTRA, RENOP, MOU)
    // Form VMTS ditangani oleh listener sendiri
    document.addEventListener("submit", async function (e) {

        const form = e.target;

        // SKIP form VMTS
        if (form.id === 'formVmts') return;

        const modal = form.closest(".modal-overlay");
        if (!modal) return;

        e.preventDefault();

        clearValidationErrors(form);

        const submitBtn = form.querySelector('[type="submit"]');
        const originalText = submitBtn ? submitBtn.innerHTML : "";

        try {

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add("opacity-50");
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-4 w-4 inline mr-2"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4A10 10 0 002 12h2z"></path>
                    </svg>
                    Menyimpan...
                `;
            }

            const formData = new FormData(form);
            const csrf = document.querySelector('meta[name="csrf-token"]').content;

            const response = await fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrf,
                    "Accept": "application/json"
                },
                body: formData
            });

            let data = {};
            try {
                data = await response.json();
            } catch (err) {
                throw new Error("Response server bukan JSON.");
            }

            if (response.status === 422) {
                showValidationErrorsLocal(form, data.errors ?? {});
                window.toast?.error(data.message ?? "Periksa kembali data yang diisi.");
                return;
            }

            if (!response.ok) {
                throw new Error(data.message ?? "Terjadi kesalahan server.");
            }

            window.toast?.success(data.message ?? "Berhasil disimpan.");
            closeModal(modal.id);

            const tableId = resolveTableId(modal);
            if (tableId && typeof window.refreshTable === "function") {
                await window.refreshTable(tableId);
            } else {
                location.reload();
            }

        } catch (err) {
            console.error(err);
            window.toast?.error(err.message ?? "Terjadi kesalahan.");
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove("opacity-50");
                submitBtn.innerHTML = originalText;
            }
        }
    });

    /* ======================================================
    VMTS CRUD (FULL) - DENGAN FLAG ANTI DOUBLE
    ====================================================== */

    let isVmtsSubmitting = false;

    // Sinkronkan semua editor ke hidden input
    function syncVmtsEditors() {
        const editors = ['visiEditorModal', 'misiEditorModal', 'tujuanEditorModal', 'sasaranEditorModal'];
        editors.forEach(id => {
            const editor = document.getElementById(id);
            const hidden = document.getElementById(id.replace('EditorModal', 'HiddenModal'));
            if (editor && hidden) {
                hidden.value = editor.innerHTML;
            }
        });
    }

    // Isi konten editor
    function setVmtsEditorContent(editorId, content) {
        const editor = document.getElementById(editorId);
        if (editor) {
            editor.innerHTML = content || '';
        }
    }

    // Buka modal untuk EDIT
    function openEditModalVmts(modalId, id, visi, misi, tujuan, sasaran) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('formVmts');
        if (!form) return;

        const updateRoute = "{{ route('prodi.identitas-prodi.vmts.update', ['id' => '__ID__']) }}";
        form.action = updateRoute.replace('__ID__', id);

        const methodInput = form.querySelector('[name="_method"]');
        if (methodInput) methodInput.value = 'PUT';

        const idInput = document.getElementById('editId');
        if (idInput) idInput.value = id;

        setVmtsEditorContent('visiEditorModal', visi);
        setVmtsEditorContent('misiEditorModal', misi);
        setVmtsEditorContent('tujuanEditorModal', tujuan);
        setVmtsEditorContent('sasaranEditorModal', sasaran);

        syncVmtsEditors();

        const title = modal.querySelector('h3');
        if (title) title.innerText = 'Edit VMTS';

        clearValidationErrors(form);
    }

    // Buka modal untuk TAMBAH VMTS
    function openModalVmts() {
        const modal = document.getElementById('modalVmts');
        if (!modal) return;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('formVmts');
        if (!form) return;

        form.reset();

        // Reset semua editor
        const editors = ['visiEditorModal', 'misiEditorModal', 'tujuanEditorModal', 'sasaranEditorModal'];
        editors.forEach(id => {
            const editor = document.getElementById(id);
            if (editor) editor.innerHTML = '';
        });
        syncVmtsEditors();

        form.action = "{{ route('prodi.identitas-prodi.vmts.store') }}";
        const methodInput = form.querySelector('[name="_method"]');
        if (methodInput) methodInput.value = 'POST';
        document.getElementById('editId').value = '';

        const title = modal.querySelector('h3');
        if (title) title.innerText = 'Tambah VMTS';

        clearValidationErrors(form);
    }

    // Hapus VMTS
    async function deleteVmts(id, tableSelector) {
        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;

        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        const url = "{{ route('prodi.identitas-prodi.vmts.destroy', ['id' => '__ID__']) }}".replace('__ID__', id);

        try {
            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Gagal menghapus.');
            }

            window.toast?.success(data.message || 'Data berhasil dihapus.');

            if (typeof window.refreshTable === 'function') {
                await window.refreshTable(tableSelector);
            } else {
                location.reload();
            }
        } catch (err) {
            console.error(err);
            window.toast?.error(err.message);
        }
    }

    // ======================================================
    // AUTO SYNC VMTS EDITORS
    // ======================================================
    document.addEventListener('DOMContentLoaded', function() {
        const editorIds = ['visiEditorModal', 'misiEditorModal', 'tujuanEditorModal', 'sasaranEditorModal'];
        editorIds.forEach(id => {
            const editor = document.getElementById(id);
            if (editor) {
                editor.addEventListener('input', function() {
                    syncVmtsEditors();
                });
            }
        });
    });

</script>
@endpush

<style>
    .rich-editor-wrapper [contenteditable] ul {
    list-style-type: disc !important;
    list-style-position: outside !important;
    padding-left: 24px !important;
    margin: 8px 0 !important;
    }

    .rich-editor-wrapper [contenteditable] ol {
        list-style-type: decimal !important;
        list-style-position: outside !important;
        padding-left: 24px !important;
        margin: 8px 0 !important;
    }

    .rich-editor-wrapper [contenteditable] li {
        display: list-item !important;
    }
</style>