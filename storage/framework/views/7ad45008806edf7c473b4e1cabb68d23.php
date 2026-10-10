

<?php $__env->startSection('title', 'Identitas Prodi | SIMANTAP'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginald07245451647f5715f9bac44fc38d4f4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald07245451647f5715f9bac44fc38d4f4 = $attributes; } ?>
<?php $component = App\View\Components\Common\PageBreadcrumb::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.page-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Common\PageBreadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageTitle' => 'Identitas Prodi']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald07245451647f5715f9bac44fc38d4f4)): ?>
<?php $attributes = $__attributesOriginald07245451647f5715f9bac44fc38d4f4; ?>
<?php unset($__attributesOriginald07245451647f5715f9bac44fc38d4f4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald07245451647f5715f9bac44fc38d4f4)): ?>
<?php $component = $__componentOriginald07245451647f5715f9bac44fc38d4f4; ?>
<?php unset($__componentOriginald07245451647f5715f9bac44fc38d4f4); ?>
<?php endif; ?>

    <div class="space-y-6">
        <?php if (isset($component)) { $__componentOriginaldfb4fb67ae0382c84b2f8081e8e0d0af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfb4fb67ae0382c84b2f8081e8e0d0af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.vmts','data' => ['profil' => $profil]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.vmts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['profil' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profil)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldfb4fb67ae0382c84b2f8081e8e0d0af)): ?>
<?php $attributes = $__attributesOriginaldfb4fb67ae0382c84b2f8081e8e0d0af; ?>
<?php unset($__attributesOriginaldfb4fb67ae0382c84b2f8081e8e0d0af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldfb4fb67ae0382c84b2f8081e8e0d0af)): ?>
<?php $component = $__componentOriginaldfb4fb67ae0382c84b2f8081e8e0d0af; ?>
<?php unset($__componentOriginaldfb4fb67ae0382c84b2f8081e8e0d0af); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalefb0901b65d1a464ae14feb12b216277 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalefb0901b65d1a464ae14feb12b216277 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.sosial-media','data' => ['sosialMedia' => $sosialMedia]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.sosial-media'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sosialMedia' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sosialMedia)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalefb0901b65d1a464ae14feb12b216277)): ?>
<?php $attributes = $__attributesOriginalefb0901b65d1a464ae14feb12b216277; ?>
<?php unset($__attributesOriginalefb0901b65d1a464ae14feb12b216277); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalefb0901b65d1a464ae14feb12b216277)): ?>
<?php $component = $__componentOriginalefb0901b65d1a464ae14feb12b216277; ?>
<?php unset($__componentOriginalefb0901b65d1a464ae14feb12b216277); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal3c0422dcf702a42f5096313956de2a3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3c0422dcf702a42f5096313956de2a3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.rip','data' => ['dokumenRip' => $dokumenRip]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.rip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenRip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRip)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3c0422dcf702a42f5096313956de2a3e)): ?>
<?php $attributes = $__attributesOriginal3c0422dcf702a42f5096313956de2a3e; ?>
<?php unset($__attributesOriginal3c0422dcf702a42f5096313956de2a3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3c0422dcf702a42f5096313956de2a3e)): ?>
<?php $component = $__componentOriginal3c0422dcf702a42f5096313956de2a3e; ?>
<?php unset($__componentOriginal3c0422dcf702a42f5096313956de2a3e); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal9a9b8f92345ce72f642bda25019541ca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a9b8f92345ce72f642bda25019541ca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.renstra','data' => ['dokumenRenstra' => $dokumenRenstra]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.renstra'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenRenstra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRenstra)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a9b8f92345ce72f642bda25019541ca)): ?>
<?php $attributes = $__attributesOriginal9a9b8f92345ce72f642bda25019541ca; ?>
<?php unset($__attributesOriginal9a9b8f92345ce72f642bda25019541ca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a9b8f92345ce72f642bda25019541ca)): ?>
<?php $component = $__componentOriginal9a9b8f92345ce72f642bda25019541ca; ?>
<?php unset($__componentOriginal9a9b8f92345ce72f642bda25019541ca); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal118fe550f42946561857a9d5e2613994 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal118fe550f42946561857a9d5e2613994 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.renop','data' => ['dokumenRenop' => $dokumenRenop]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.renop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenRenop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenRenop)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal118fe550f42946561857a9d5e2613994)): ?>
<?php $attributes = $__attributesOriginal118fe550f42946561857a9d5e2613994; ?>
<?php unset($__attributesOriginal118fe550f42946561857a9d5e2613994); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal118fe550f42946561857a9d5e2613994)): ?>
<?php $component = $__componentOriginal118fe550f42946561857a9d5e2613994; ?>
<?php unset($__componentOriginal118fe550f42946561857a9d5e2613994); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginale662ec858ba2ef011dfe1ef92d208005 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale662ec858ba2ef011dfe1ef92d208005 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.kegiatan-benchmarking','data' => ['kegiatanBenchmarking' => $kegiatanBenchmarking]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.kegiatan-benchmarking'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kegiatanBenchmarking' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kegiatanBenchmarking)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale662ec858ba2ef011dfe1ef92d208005)): ?>
<?php $attributes = $__attributesOriginale662ec858ba2ef011dfe1ef92d208005; ?>
<?php unset($__attributesOriginale662ec858ba2ef011dfe1ef92d208005); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale662ec858ba2ef011dfe1ef92d208005)): ?>
<?php $component = $__componentOriginale662ec858ba2ef011dfe1ef92d208005; ?>
<?php unset($__componentOriginale662ec858ba2ef011dfe1ef92d208005); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal935646ebb616ee71515c83865cb12f58 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal935646ebb616ee71515c83865cb12f58 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.mou','data' => ['dokumenMou' => $dokumenMou]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.mou'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dokumenMou' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumenMou)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal935646ebb616ee71515c83865cb12f58)): ?>
<?php $attributes = $__attributesOriginal935646ebb616ee71515c83865cb12f58; ?>
<?php unset($__attributesOriginal935646ebb616ee71515c83865cb12f58); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal935646ebb616ee71515c83865cb12f58)): ?>
<?php $component = $__componentOriginal935646ebb616ee71515c83865cb12f58; ?>
<?php unset($__componentOriginal935646ebb616ee71515c83865cb12f58); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginald1fd71db806a757e651ee957e786d8f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1fd71db806a757e651ee957e786d8f1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.dtps','data' => ['dtps' => $profil]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.dtps'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dtps' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profil)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald1fd71db806a757e651ee957e786d8f1)): ?>
<?php $attributes = $__attributesOriginald1fd71db806a757e651ee957e786d8f1; ?>
<?php unset($__attributesOriginald1fd71db806a757e651ee957e786d8f1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1fd71db806a757e651ee957e786d8f1)): ?>
<?php $component = $__componentOriginald1fd71db806a757e651ee957e786d8f1; ?>
<?php unset($__componentOriginald1fd71db806a757e651ee957e786d8f1); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0761f0985f14e045df32dae51afe6d05 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0761f0985f14e045df32dae51afe6d05 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.Jabatan-Fungsional','data' => ['jabatan' => $profil]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.Jabatan-Fungsional'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['jabatan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profil)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0761f0985f14e045df32dae51afe6d05)): ?>
<?php $attributes = $__attributesOriginal0761f0985f14e045df32dae51afe6d05; ?>
<?php unset($__attributesOriginal0761f0985f14e045df32dae51afe6d05); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0761f0985f14e045df32dae51afe6d05)): ?>
<?php $component = $__componentOriginal0761f0985f14e045df32dae51afe6d05; ?>
<?php unset($__componentOriginal0761f0985f14e045df32dae51afe6d05); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginala2f24a056050f3fb73d6e9905e61a533 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2f24a056050f3fb73d6e9905e61a533 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.mahasiswa','data' => ['mahasiswa' => $profil]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.mahasiswa'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['mahasiswa' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profil)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2f24a056050f3fb73d6e9905e61a533)): ?>
<?php $attributes = $__attributesOriginala2f24a056050f3fb73d6e9905e61a533; ?>
<?php unset($__attributesOriginala2f24a056050f3fb73d6e9905e61a533); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2f24a056050f3fb73d6e9905e61a533)): ?>
<?php $component = $__componentOriginala2f24a056050f3fb73d6e9905e61a533; ?>
<?php unset($__componentOriginala2f24a056050f3fb73d6e9905e61a533); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalb882eaa3bfa7f8f30543a9843952cef5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb882eaa3bfa7f8f30543a9843952cef5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.identitas-prodi.rasio','data' => ['profil' => $profil]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('identitas-prodi.rasio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['profil' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profil)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb882eaa3bfa7f8f30543a9843952cef5)): ?>
<?php $attributes = $__attributesOriginalb882eaa3bfa7f8f30543a9843952cef5; ?>
<?php unset($__attributesOriginalb882eaa3bfa7f8f30543a9843952cef5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb882eaa3bfa7f8f30543a9843952cef5)): ?>
<?php $component = $__componentOriginalb882eaa3bfa7f8f30543a9843952cef5; ?>
<?php unset($__componentOriginalb882eaa3bfa7f8f30543a9843952cef5); ?>
<?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // ======================================================
    // ROUTE UPDATE
    // ======================================================

    const updateRouteBase =
    "<?php echo e(route('prodi.identitas-prodi.dokumen.update',['id'=>'__ID__'])); ?>";

    // ======================================================
    // MAPPING KATEGORI KE NAMA LENGKAP
    // ======================================================
    const categoryNames = {
        'RIP': 'Rencana Induk Pengembangan',
        'RENSTRA': 'Rencana Strategis',
        'RENOP': 'Rencana Operasional',
        'MOU': 'Kerjasama MoU / MoA'
    };

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
        form.action="<?php echo e(route('prodi.identitas-prodi.dokumen.store')); ?>";
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
            const fullName = categoryNames[kategori.value] || kategori.value;
            title.innerText="Tambah "+fullName;
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
            const fullName = categoryNames[kategori.value] || kategori.value;
            title.innerText="Edit "+fullName;
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

    // HANYA UNTUK DOKUMEN (RIP, RENSTRA, RENOP, MOU)
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

    // Buka modal untuk EDIT VMTS
    function openEditModalVmts(
        modalId,
        id,
        visi,
        misi,
        tujuan,
        sasaran,
        file,
        tglPenetapan
    ) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('formVmts');
        if (!form) return;

        const updateRoute = "<?php echo e(route('prodi.identitas-prodi.vmts.update', ['id' => '__ID__'])); ?>";
        form.action = updateRoute.replace('__ID__', id);

        const methodInput = form.querySelector('[name="_method"]');
        if (methodInput) {
            methodInput.value = 'PUT';
        }

        const idInput = document.getElementById('editId');
        if (idInput) {
            idInput.value = id;
        }

        // ==================================================
        // ISI EDITOR VMTS
        // ==================================================

        setVmtsEditorContent('visiEditorModal', visi);
        setVmtsEditorContent('misiEditorModal', misi);
        setVmtsEditorContent('tujuanEditorModal', tujuan);
        setVmtsEditorContent('sasaranEditorModal', sasaran);

        syncVmtsEditors();

        // ==================================================
        // ISI TANGGAL PENETAPAN
        // ==================================================

        const tanggalInput = document.getElementById('tglPenetapanVmts');

        if (tanggalInput) {

            if (tanggalInput._flatpickr) {

                tanggalInput._flatpickr.setDate(
                    tglPenetapan || null,
                    true
                );

            } else {

                tanggalInput.value = tglPenetapan || '';

            }
        }

        // ==================================================
        // FILE LAMA
        // ==================================================

        const fileInput = form.querySelector('[name="file"]');

        if (fileInput) {
            fileInput.required = false;
            fileInput.value = '';
        }

        // Tampilkan file lama
        const existingFileContainer = document.getElementById('existingVmtsFile');

        if (existingFileContainer) {

            if (file) {

                const fileUrl = "<?php echo e(asset('storage')); ?>/" + file.replace(/^\/+/, '');

                existingFileContainer.innerHTML = `
                    <div class="mt-2 rounded-lg border border-gray-200 bg-gray-50 p-3">
                        <div class="flex items-center justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-gray-500">
                                    File saat ini
                                </p>

                                <p class="truncate text-sm text-gray-700">
                                    ${file.split('/').pop()}
                                </p>
                            </div>

                            <a
                                href="${fileUrl}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="shrink-0 rounded-lg bg-blue-50 px-3 py-2 text-xs font-medium text-blue-600 hover:bg-blue-100"
                            >
                                Lihat File
                            </a>
                        </div>
                    </div>
                `;

            } else {

                existingFileContainer.innerHTML = `
                    <div class="mt-2 text-xs text-gray-500">
                        Belum ada file yang diunggah.
                    </div>
                `;
            }
        }

        // ==================================================
        // TITLE
        // ==================================================

        const title = modal.querySelector('h3');

        if (title) {
            title.innerText = 'Edit VMTS';
        }

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

        form.action = "<?php echo e(route('prodi.identitas-prodi.vmts.store')); ?>";
        const methodInput = form.querySelector('[name="_method"]');
        if (methodInput) methodInput.value = 'POST';
        document.getElementById('editId').value = '';

        const title = modal.querySelector('h3');
        if (title) title.innerText = 'Tambah VMTS';

        clearValidationErrors(form);
    }

    // Hapus VMTS - PAKAI CUSTOM CONFIRM DIALOG DARI CONFIRM-DIALOG.JS
    async function deleteVmts(id, tableSelector) {
        // Coba gunakan confirmDialog dari window
        if (window.confirmDialog && typeof window.confirmDialog === 'function') {
            window.confirmDialog(
                'Konfirmasi Hapus',
                'Yakin ingin menghapus data VMTS?',
                async function() {
                    await executeDeleteVmts(id, tableSelector);
                },
                function() {
                    // On Cancel - tidak melakukan apa-apa
                    console.log('Delete dibatalkan');
                }
            );
        } 
        // Coba gunakan confirmDialog dari window (nama lain)
        else if (window.showConfirmDialog && typeof window.showConfirmDialog === 'function') {
            window.showConfirmDialog(
                'Konfirmasi Hapus',
                'Yakin ingin menghapus data VMTS?',
                async function() {
                    await executeDeleteVmts(id, tableSelector);
                },
                function() {
                    // On Cancel
                }
            );
        }
        // Fallback ke confirm bawaan
        else {
            if (!confirm('Yakin ingin menghapus data VMTS?')) return;
            await executeDeleteVmts(id, tableSelector);
        }
    }

    // Fungsi eksekusi delete yang terpisah
    async function executeDeleteVmts(id, tableSelector) {
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        const url = "<?php echo e(route('prodi.identitas-prodi.vmts.destroy', ['id' => '__ID__'])); ?>".replace('__ID__', id);

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

            if (window.toast) {
                window.toast.success(data.message || 'VMTS berhasil dihapus.');
            } else if (window.toastr) {
                toastr.success(data.message || 'VMTS berhasil dihapus.');
            } else {
                alert(data.message || 'VMTS berhasil dihapus.');
            }

            if (typeof window.refreshTable === 'function') {
                await window.refreshTable(tableSelector);
            } else if (typeof window.refreshVmtsTable === 'function') {
                await window.refreshVmtsTable();
            } else {
                location.reload();
            }
        } catch (err) {
            console.error(err);
            if (window.toast) {
                window.toast.error(err.message);
            } else if (window.toastr) {
                toastr.error(err.message);
            } else {
                alert(err.message);
            }
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/pages/prodi/identitas-prodi.blade.php ENDPATH**/ ?>