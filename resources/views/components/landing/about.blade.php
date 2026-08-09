{{-- resources/views/components/landing/about.blade.php --}}
<section class="section-padding" id="tentang">
    <div class="container">
        <div class="tentang-grid">
            <div class="tentang-image reveal-left">
                <i class="fas fa-university"></i>
                {{-- <img src="{{ asset('images/gedung-um-banjarmasin.jpg') }}" alt="Gedung UM Banjarmasin" /> --}}
            </div>

            <div class="tentang-content reveal">
                <span class="section-label">Tentang Kami</span>
                <h2>Lembaga Penjaminan Mutu <span>UM Banjarmasin</span></h2>
                <p style="color: var(--text-light); margin-bottom: 16px;">
                    LPM berkomitmen mewujudkan pendidikan tinggi yang bermutu melalui
                    pengelolaan SPMI yang efektif, transparan, dan akuntabel.
                    <strong>SIMANTAP</strong> hadir sebagai sistem terpadu untuk
                    monitoring audit dan peringatan akreditasi.
                </p>
                <div class="visi-misi">
                    <div class="vm-item">
                        <h4><i class="fas fa-eye"></i> Visi</h4>
                        <p>Menjadi pusat unggulan penjaminan mutu pendidikan tinggi di Kalimantan.</p>
                    </div>
                    <div class="vm-item">
                        <h4><i class="fas fa-bullseye"></i> Misi</h4>
                        <p>Mengimplementasikan SPMI secara konsisten dan berkelanjutan.</p>
                    </div>
                </div>
                <p class="tugas">
                    <strong>Tugas:</strong> Melaksanakan audit mutu internal, monitoring evaluasi,
                    pengembangan standar, dan pelatihan mutu bagi seluruh civitas akademika.
                </p>
                <a href="#" class="btn btn-secondary">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<style>
    .tentang-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
    .tentang-image {
        border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow);
        aspect-ratio: 4/3; display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #dbeafe, #eff6ff); color: var(--primary); font-size: 80px;
    }
    .tentang-content h2 { font-family: 'Poppins', sans-serif; font-size: 36px; font-weight: 800; margin-bottom: 16px; }
    .tentang-content h2 span { color: var(--primary); }
    .tentang-content .visi-misi { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0 24px; }
    .tentang-content .visi-misi .vm-item {
        background: var(--white); padding: 18px 20px; border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04); border-left: 4px solid var(--primary);
    }
    .tentang-content .visi-misi .vm-item h4 {
        font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700;
        color: var(--primary); margin-bottom: 2px;
    }
    .tentang-content .visi-misi .vm-item p { font-size: 14px; color: var(--text-light); margin: 0; }
    .tentang-content .tugas { font-size: 15px; color: var(--text-light); margin-bottom: 24px; }
    @media (max-width: 1024px) { .tentang-grid { grid-template-columns: 1fr; } }
    @media (max-width: 768px) { .tentang-content .visi-misi { grid-template-columns: 1fr; } }
</style>