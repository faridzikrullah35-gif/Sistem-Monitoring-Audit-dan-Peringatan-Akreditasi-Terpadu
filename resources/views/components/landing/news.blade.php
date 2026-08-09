{{-- resources/views/components/landing/news.blade.php --}}
<section class="section-padding" id="berita" style="background: var(--white);">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-label">Berita & Artikel</span>
            <h2 class="section-title">Informasi <span>Terbaru</span></h2>
            <p class="section-desc mx-auto">Update kegiatan, pencapaian, dan pengumuman dari LPM UM Banjarmasin.</p>
        </div>

        <div class="berita-grid">
            <div class="berita-card reveal">
                <div class="thumb"><i class="fas fa-calendar-check"></i></div>
                <div class="body">
                    <span class="date"><i class="far fa-calendar-alt"></i> 12 Juli 2026</span>
                    <h4>Pelaksanaan Audit Mutu Internal Periode 2026</h4>
                    <p>AMI dilaksanakan serentak di seluruh program studi dengan melibatkan 45 auditor internal.</p>
                    <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="berita-card reveal" style="transition-delay:0.1s;">
                <div class="thumb"><i class="fas fa-award"></i></div>
                <div class="body">
                    <span class="date"><i class="far fa-calendar-alt"></i> 5 Juli 2026</span>
                    <h4>UM Banjarmasin Raih Akreditasi Unggul</h4>
                    <p>Universitas Muhammadiyah Banjarmasin berhasil meraih predikat Akreditasi Unggul dari BAN-PT.</p>
                    <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="berita-card reveal" style="transition-delay:0.2s;">
                <div class="thumb"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="body">
                    <span class="date"><i class="far fa-calendar-alt"></i> 28 Juni 2026</span>
                    <h4>Pelatihan Auditor Mutu Internal Angkatan IV</h4>
                    <p>LPM menyelenggarakan pelatihan bagi calon auditor internal guna meningkatkan kompetensi.</p>
                    <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .berita-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-top: 48px; }
    .berita-card { background: var(--white); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); }
    .berita-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(15,76,129,0.10); }
    .berita-card .thumb { height: 200px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); display: flex; align-items: center; justify-content: center; font-size: 48px; color: var(--primary); }
    .berita-card .body { padding: 24px; }
    .berita-card .body .date { font-size: 13px; color: var(--text-light); font-weight: 500; }
    .berita-card .body h4 { font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; margin: 6px 0 8px; }
    .berita-card .body p { font-size: 14px; color: var(--text-light); margin-bottom: 12px; }
    .berita-card .body .read-more { font-weight: 600; font-size: 14px; color: var(--primary); display: inline-flex; align-items: center; gap: 6px; transition: var(--transition); }
    .berita-card .body .read-more:hover { gap: 12px; }
    @media (max-width: 1024px) { .berita-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 768px) { .berita-grid { grid-template-columns: 1fr; } }
</style>