@php
    $about = App\Models\SettingProfileAdmin::where('is_active', true)->first();
@endphp

<section class="section-padding" id="tentang" style="background: var(--bg);">
    <div class="container">
        <div class="tentang-wrapper">
            {{-- Header Section --}}
            <div class="tentang-header text-center reveal">
                <span class="section-label">Tentang Kami</span>
                <h2 class="section-title">Lembaga Penjaminan Mutu <span>UM Banjarmasin</span></h2>
                <p class="section-desc mx-auto" style="max-width: 700px;">
                    Sistem Informasi Monitoring Audit dan Peringatan Akreditasi Terpadu
                </p>
            </div>

            {{-- Content --}}
            <div class="tentang-content reveal">
                {{-- Deskripsi --}}
                <div class="vm-item deskripsi-item">
                    <div class="vm-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <p>
                        {!! $about->deskripsi ?? 'LPM berkomitmen mewujudkan pendidikan tinggi yang bermutu melalui pengelolaan SPMI yang efektif, transparan, dan akuntabel. <strong>SIMANTAP</strong> hadir sebagai sistem terpadu untuk monitoring audit dan peringatan akreditasi.' !!}
                    </p>
                </div>

                {{-- Grid Visi Misi Tujuan --}}
                <div class="visi-misi-tujuan">

                    {{-- Visi --}}
                    <div class="vm-item">
                        <h4><i class="fas fa-eye"></i> Visi</h4>
                        <p>
                            {!! $about->visi ?? 'Menjadi pusat unggulan penjaminan mutu pendidikan tinggi di Kalimantan.' !!}
                        </p>
                    </div>

                    {{-- Misi --}}
                    <div class="vm-item">
                        <h4><i class="fas fa-bullseye"></i> Misi</h4>
                        <p>
                            {!! $about->misi ?? 'Mengimplementasikan SPMI secara konsisten dan berkelanjutan.' !!}
                        </p>
                    </div>

                    {{-- Tujuan --}}
                    <div class="vm-item">
                        <h4><i class="fas fa-crosshairs"></i> Tujuan</h4>
                        <p>
                            {!! $about->tujuan ?? 'Melaksanakan audit mutu internal, monitoring evaluasi, pengembangan standar, dan pelatihan mutu bagi seluruh civitas akademika.' !!}
                        </p>
                    </div>

                </div>

                {{-- Sasaran --}}
                <div class="sasaran-item vm-item">
                    <h4>
                        <i class="fas fa-bullseye"></i>
                        Sasaran
                    </h4>

                    <div class="sasaran-content">
                        {!! $about->sasaran ?? 'Mewujudkan sistem penjaminan mutu yang efektif, berkelanjutan, transparan, dan berorientasi pada peningkatan mutu institusi.' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ============================================================
       TENTANG KAMI SECTION
       ============================================================ */
    .tentang-wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    /* ============================================================
       HEADER
       ============================================================ */
    .tentang-header {
        margin-bottom: 40px;
    }

    .tentang-header .section-label {
        color: var(--secondary);
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-size: 13px;
        display: inline-block;
        margin-bottom: 8px;
    }

    .tentang-header .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 12px;
        color: var(--text);
    }

    .tentang-header .section-title span {
        color: var(--primary);
    }

    .tentang-header .section-desc {
        color: var(--text-light);
        font-size: 16px;
        line-height: 1.7;
    }

    /* ============================================================
       CONTENT
       ============================================================ */
    .tentang-content {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* ============================================================
       CARD ITEM (UNIVERSAL)
       ============================================================ */
    .tentang-content .vm-item {
        background: var(--white);
        padding: 24px 28px;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border-left: 4px solid var(--primary);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .tentang-content .vm-item::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle at top right, rgba(15, 76, 129, 0.03), transparent 70%);
        pointer-events: none;
    }

    .tentang-content .vm-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    /* ============================================================
       DESKRIPSI CARD
       ============================================================ */
    .tentang-content .deskripsi-item {
        border-left-color: var(--secondary);
        padding: 28px 32px;
        background: linear-gradient(135deg, var(--white), #f8faff);
        position: relative;
    }

    .tentang-content .deskripsi-item .vm-icon {
        position: absolute;
        top: 20px;
        right: 24px;
        font-size: 32px;
        color: var(--primary);
        opacity: 0.08;
    }

    .tentang-content .deskripsi-item p {
        font-size: 16px;
        color: var(--text-light);
        margin: 0;
        line-height: 1.8;
        position: relative;
        z-index: 1;
    }

    .tentang-content .deskripsi-item p strong {
        color: var(--primary);
        font-weight: 600;
    }

    /* ============================================================
       VISI MISI TUJUAN GRID
       ============================================================ */
    .tentang-content .visi-misi-tujuan {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .tentang-content .visi-misi-tujuan .vm-item {
        padding: 20px 24px;
        text-align: center;
        border-left: 4px solid var(--primary);
    }

    .tentang-content .visi-misi-tujuan .vm-item:nth-child(1) {
        border-left-color: #3B82F6;
    }

    .tentang-content .visi-misi-tujuan .vm-item:nth-child(2) {
        border-left-color: #10B981;
    }

    .tentang-content .visi-misi-tujuan .vm-item:nth-child(3) {
        border-left-color: #F59E0B;
    }

    .tentang-content .visi-misi-tujuan .vm-item h4 {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .tentang-content .visi-misi-tujuan .vm-item h4 i {
        font-size: 18px;
        width: 24px;
        text-align: center;
        color: var(--secondary);
    }

    .tentang-content .visi-misi-tujuan .vm-item p {
        font-size: 14px;
        color: var(--text-light);
        margin: 0;
        line-height: 1.7;
        text-align: left;
    }

    .tentang-content .sasaran-item {
        border-left-color: #8B5CF6;
        padding: 24px 28px;
    }

    .tentang-content .sasaran-item h4 {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .tentang-content .sasaran-item h4 i {
        font-size: 18px;
        width: 24px;
        text-align: center;
        color: #8B5CF6;
    }

    .tentang-content .sasaran-content {
        font-size: 14px;
        color: var(--text-light);
        line-height: 1.7;
    }

    /* ============================================================
       RICH TEXT SUPPORT (Bullet & Number) - FIXED
       ============================================================ */
    /* Style untuk semua list di dalam vm-item */
    .tentang-content .vm-item p ul,
    .tentang-content .vm-item p ol,
    .tentang-content .vm-item ul,
    .tentang-content .vm-item ol {
        margin: 0.5em 0;
        padding-left: 1.8em;
    }

    /* Bullet list (disc) */
    .tentang-content .vm-item p ul,
    .tentang-content .vm-item ul {
        list-style-type: disc !important;
        list-style-position: outside;
    }

    /* Number list (decimal) */
    .tentang-content .vm-item p ol,
    .tentang-content .vm-item ol {
        list-style-type: decimal !important;
        list-style-position: outside;
    }

    /* List item spacing */
    .tentang-content .vm-item p li,
    .tentang-content .vm-item li {
        margin: 0.25em 0;
        padding-left: 0.2em;
    }

    /* Nested list support */
    .tentang-content .vm-item p ul ul,
    .tentang-content .vm-item ul ul {
        list-style-type: circle !important;
    }

    .tentang-content .vm-item p ul ul ul,
    .tentang-content .vm-item ul ul ul {
        list-style-type: square !important;
    }

    .tentang-content .vm-item p ol ol,
    .tentang-content .vm-item ol ol {
        list-style-type: lower-alpha !important;
    }

    .tentang-content .vm-item p ol ol ol,
    .tentang-content .vm-item ol ol ol {
        list-style-type: lower-roman !important;
    }

    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media (max-width: 1024px) {
        .tentang-wrapper {
            max-width: 100%;
        }

        .tentang-header .section-title {
            font-size: 32px;
        }

        .tentang-content .visi-misi-tujuan {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .tentang-header .section-title {
            font-size: 28px;
        }

        .tentang-header .section-desc {
            font-size: 14px;
        }

        .tentang-content .visi-misi-tujuan {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .tentang-content .deskripsi-item {
            padding: 20px 24px;
        }

        .tentang-content .deskripsi-item .vm-icon {
            font-size: 24px;
            top: 16px;
            right: 20px;
        }

        .tentang-content .deskripsi-item p {
            font-size: 14px;
        }

        .tentang-content .visi-misi-tujuan .vm-item {
            padding: 18px 20px;
            text-align: left;
        }

        .tentang-content .visi-misi-tujuan .vm-item h4 {
            justify-content: flex-start;
            font-size: 14px;
        }

        .tentang-content .visi-misi-tujuan .vm-item p {
            font-size: 13px;
        }

        .tentang-content .vm-item {
            padding: 18px 20px;
        }
    }

    @media (max-width: 480px) {
        .tentang-header .section-title {
            font-size: 24px;
        }

        .tentang-content .deskripsi-item {
            padding: 16px 18px;
        }

        .tentang-content .deskripsi-item .vm-icon {
            font-size: 20px;
            top: 12px;
            right: 16px;
        }

        .tentang-content .deskripsi-item p {
            font-size: 13px;
        }

        .tentang-content .visi-misi-tujuan .vm-item {
            padding: 14px 16px;
        }

        .tentang-content .visi-misi-tujuan .vm-item h4 {
            font-size: 13px;
        }

        .tentang-content .visi-misi-tujuan .vm-item p {
            font-size: 12px;
        }
    }
</style>