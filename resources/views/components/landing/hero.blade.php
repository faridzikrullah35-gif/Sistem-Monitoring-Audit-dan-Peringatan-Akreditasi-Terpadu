{{-- resources/views/components/landing/hero.blade.php --}}
<section class="hero" id="beranda">
    <div class="container">
        <div class="hero-content reveal">
            <div class="sub-brand">SIMANTAP</div>
            <h1>
                Sistem Monitoring Audit &amp;
                <br />
                <span class="highlight">Peringatan Akreditasi Terpadu</span>
            </h1>
            <p>
                Kelola seluruh siklus Audit Mutu Internal (AMI) dan pantau
                status akreditasi secara real-time. Terintegrasi dengan
                Lembaga Penjaminan Mutu Universitas Muhammadiyah Banjarmasin.
            </p>
            <div class="hero-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Dashboard AMI
                    </a>
                @else
                    <!-- <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login Sistem SIMANTAP
                    </a> -->
                @endauth
                <a href="#tentang" class="btn btn-outline">
                    <i class="fas fa-info-circle"></i> Lihat Profil
                </a>
                {{-- TOMBOL EWS --}}
                <a href="#ews" class="btn btn-danger">
                    <i class="fas fa-exclamation-triangle"></i> Early Warning System
                </a>
                {{-- TOMBOL SURVEI KEPUASAN --}}
                <a href="https://survei-kepuasan.umbjm.ac.id/Survei_Kepuasan"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-success">
                    <i class="fas fa-poll"></i> Survei Kepuasan
                </a>
            </div>
        </div>

        <div class="hero-image reveal-right">
            <div class="illustration">
                <div class="deco d1"></div>
                <div class="deco d2"></div>
                <i class="fas fa-clipboard-check"></i>
                <h3>SIMANTAP</h3>
                <p>Audit Mutu Internal & Akreditasi Terpadu</p>
                <div style="margin-top: 16px; display:flex; gap:12px; font-size:13px; opacity:0.7;">
                    <span><i class="fas fa-check-circle"></i> Real-time</span>
                    <span><i class="fas fa-check-circle"></i> Terintegrasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hero {
        min-height: 100vh; display: flex; align-items: center;
        padding: 120px 0 80px;
        background: linear-gradient(165deg, #f0f7ff 0%, #ffffff 100%);
        position: relative; overflow: hidden;
    }
    .hero::before {
        content: ''; position: absolute; top: -30%; right: -10%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(56,189,248,0.10) 0%, transparent 70%);
        border-radius: 50%; pointer-events: none;
    }
    .hero .container {
        display: grid; grid-template-columns: 1fr 1fr; gap: 60px;
        align-items: center; position: relative; z-index: 1;
    }
    .hero-content .badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(15,76,129,0.08); color: var(--primary);
        font-size: 13px; font-weight: 600; padding: 6px 18px;
        border-radius: 50px; margin-bottom: 20px;
        border: 1px solid rgba(15,76,129,0.10);
    }
    .hero-content .sub-brand {
        font-family: 'Poppins', sans-serif;
        font-size: 18px; font-weight: 600; color: var(--secondary);
        letter-spacing: 1px; margin-bottom: 8px;
    }
    .hero-content h1 {
        font-family: 'Poppins', sans-serif; font-size: 48px; font-weight: 900;
        line-height: 1.1; margin-bottom: 12px;
    }
    .hero-content h1 .highlight { color: var(--primary); position: relative; }
    .hero-content h1 .highlight::after {
        content: ''; position: absolute; bottom: 4px; left: 0; right: 0;
        height: 8px; background: rgba(56,189,248,0.30); border-radius: 4px; z-index: -1;
    }
    .hero-content p { font-size: 18px; color: var(--text-light); max-width: 520px; margin-bottom: 32px; line-height: 1.8; }
    .hero-buttons { display: flex; flex-wrap: wrap; gap: 14px; }
    .hero-image .illustration {
        width: 100%; max-width: 520px;
        background: linear-gradient(145deg, var(--primary), var(--secondary));
        border-radius: 32px; padding: 40px 30px; color: var(--white);
        box-shadow: 0 30px 80px rgba(15,76,129,0.25);
        position: relative; overflow: hidden; aspect-ratio: 4/3;
        display: flex; flex-direction: column; justify-content: center;
        align-items: center; text-align: center;
    }
    .hero-image .illustration i { font-size: 72px; margin-bottom: 16px; opacity: 0.9; }
    .hero-image .illustration h3 { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 700; }
    .hero-image .illustration p { font-size: 14px; opacity: 0.8; margin-top: 4px; }
    .hero-image .illustration .deco {
        position: absolute; border-radius: 50%; background: rgba(255,255,255,0.04);
    }
    .hero-image .illustration .deco.d1 { width: 200px; height: 200px; top: -60px; right: -60px; }
    .hero-image .illustration .deco.d2 { width: 120px; height: 120px; bottom: -40px; left: -40px; }
    @media (max-width: 1024px) {
        .hero .container { grid-template-columns: 1fr; text-align: center; }
        .hero-content p { margin-left: auto; margin-right: auto; }
        .hero-buttons { justify-content: center; }
        .hero-image .illustration { max-width: 400px; margin: 0 auto; }
    }
    @media (max-width: 768px) {
        .hero-content h1 { font-size: 32px; }
        .hero-content .sub-brand { font-size: 15px; }
    }
    @media (max-width: 480px) {
        .hero-content h1 { font-size: 26px; }
        .hero-buttons .btn { width: 100%; justify-content: center; }
        .hero-image .illustration { padding: 24px 16px; aspect-ratio: 4/3; }
        .hero-image .illustration i { font-size: 48px; }
    }
    .btn-success {
    background: #16a34a;
    color: #fff;
    border: 2px solid #16a34a;
    }

    .btn-success:hover {
        background: #15803d;
        border-color: #15803d;
        color: #fff;
        transform: translateY(-2px);
    }
</style>