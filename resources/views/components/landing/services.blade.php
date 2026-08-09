{{-- resources/views/components/landing/services.blade.php --}}
<section class="section-padding" id="layanan" style="background: var(--white);">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-label">Layanan SIMANTAP</span>
            <h2 class="section-title">Solusi Mutu <span>Terintegrasi</span></h2>
            <p class="section-desc mx-auto">
                Kelola audit, pantau akreditasi, dan tingkatkan mutu pendidikan
                dengan sistem terpadu SIMANTAP.
            </p>
        </div>

        <div class="layanan-grid">
            <div class="layanan-card reveal"><div class="icon"><i class="fas fa-clipboard-list"></i></div><h4>Audit Mutu Internal</h4><p>Pelaksanaan AMI secara profesional dan terstandar.</p></div>
            <div class="layanan-card reveal" style="transition-delay:0.1s;"><div class="icon"><i class="fas fa-file-alt"></i></div><h4>Dokumen Mutu</h4><p>Manajemen dokumen SPMI, SOP, dan standar mutu.</p></div>
            <div class="layanan-card reveal" style="transition-delay:0.2s;"><div class="icon"><i class="fas fa-trophy"></i></div><h4>Akreditasi</h4><p>Pendampingan akreditasi program studi dan institusi.</p></div>
            <div class="layanan-card reveal" style="transition-delay:0.3s;"><div class="icon"><i class="fas fa-chart-line"></i></div><h4>Monitoring & Evaluasi</h4><p>Pemantauan capaian mutu secara berkala.</p></div>
            <div class="layanan-card reveal" style="transition-delay:0.4s;"><div class="icon"><i class="fas fa-users"></i></div><h4>Pelatihan Mutu</h4><p>Pengembangan kapasitas sumber daya manusia.</p></div>
            <div class="layanan-card reveal" style="transition-delay:0.5s;"><div class="icon"><i class="fas fa-dashboard"></i></div><h4>Dashboard AMI</h4><p>Visualisasi data audit dan kinerja mutu real-time.</p></div>
        </div>
    </div>
</section>

<style>
    .layanan-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 28px; margin-top: 48px; }
    .layanan-card {
        background: var(--bg); border-radius: var(--radius); padding: 32px 24px;
        text-align: center; transition: var(--transition); border: 1px solid transparent;
        cursor: default;
    }
    .layanan-card:hover { transform: translateY(-8px); border-color: var(--primary); box-shadow: 0 20px 50px rgba(15,76,129,0.08); background: var(--white); }
    .layanan-card .icon { font-size: 40px; color: var(--primary); margin-bottom: 16px; display: inline-block; }
    .layanan-card h4 { font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 6px; }
    .layanan-card p { font-size: 14px; color: var(--text-light); margin: 0; }
</style>