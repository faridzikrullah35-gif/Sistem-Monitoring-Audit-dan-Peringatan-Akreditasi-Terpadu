
<nav class="navbar" id="navbar">
    <div class="container">
        <a href="<?php echo e(url('/')); ?>" class="logo">
            
            <img src="https://lpm.umbjm.ac.id/img/logo/icon.png" alt="UM Banjarmasin" style="height:80px; width:auto;" />
            <span class="logo-text">
                <span class="brand">SIMANTAP</span>
                <span style="font-size: 16px; font-weight: 600; color: var(--text-light); letter-spacing: 0.5px; text-transform: uppercase; display: block; line-height: 1.2;">
                    LPM - UM Banjarmasin
                </span>
            </span>
        </a>

        <button class="hamburger" id="hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="#beranda" class="active">Beranda</a></li>
            <li><a href="#tentang">Profil</a></li>
            <li><a href="#struktur">Struktur Organisasi</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li>
                <?php if(auth()->guard()->check()): ?>
                    <?php
                        $dashboardRoute = match(auth()->user()->role) {
                            'admin' => 'admin.dashboard',
                            'auditor' => 'auditor.dashboard',
                            'prodi' => 'prodi.dashboard',
                            'unit_kerja' => 'unit-kerja.dashboard',
                            default => null,
                        };
                    ?>

                    <?php if($dashboardRoute): ?>
                        <a href="<?php echo e(route($dashboardRoute)); ?>" class="btn-login">
                            <i class="fas fa-th-large"></i> Dashboard
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login SIMANTAP
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</nav>

<style>
    .navbar {
        position: fixed; 
        top: 0; 
        left: 0; 
        right: 0; 
        z-index: 1000;
        padding: 16px 0; 
        transition: var(--transition); 
        background: transparent !important; /* FULL TRANSPARAN */
        backdrop-filter: none; 
        box-shadow: none;
        border-bottom: 1px solid rgba(255,255,255,0.05); /* Opsional: garis tipis */
    }
    
    /* Saat scroll TETAP transparan, cuma efek blur tipis + shadow */
    .navbar.scrolled {
        background: rgba(255,255,255,0.08) !important; /* Transparan banget */
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        box-shadow: 0 2px 30px rgba(0,0,0,0.04);
        padding: 10px 0;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    /* Warna teks biar kontras dengan background hero */
    .navbar .nav-links a {
        color: #1E293B; /* Gelap biar keliatan di hero terang */
        font-weight: 500;
    }

    .navbar .logo .logo-text .brand {
        color: #0F4C81;
    }

    .navbar .logo .logo-text .sub-brand {
        color: #64748B;
    }

    /* Tombol login tetep solid */
    .nav-links .btn-login {
        background: #0F4C81; 
        color: #ffffff !important;
        padding: 10px 28px; 
        border-radius: 50px; 
        font-weight: 600;
        box-shadow: 0 4px 16px rgba(15,76,129,0.3); 
        transition: var(--transition);
    }
    .nav-links .btn-login:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 8px 30px rgba(15,76,129,0.4); 
    }

    /* Hamburger icon */
    .hamburger span {
        background: #1E293B;
    }

    /* Sisanya tetap sama */
    .navbar .container {
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        flex-wrap: wrap; 
        gap: 12px;
    }
    .navbar .logo {
        display: flex; 
        align-items: center; 
        gap: 12px;
        font-family: 'Poppins', sans-serif; 
        font-weight: 800; 
        font-size: 22px;
        color: #0F4C81; 
        flex-shrink: 0;
    }
    .navbar .logo img { 
        height: 80px; 
        width: auto; 
    }
    .navbar .logo .logo-text { 
        display: flex; 
        flex-direction: column; 
        line-height: 1.15; 
    }
    .navbar .logo .logo-text .brand { 
        font-size: 22px; 
        letter-spacing: -0.5px; 
        color: #0F4C81;
    }
    .navbar .logo .logo-text .sub-brand {
        font-size: 14px;
        font-weight: 600;
        color: #64748B;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .nav-links { 
        display: flex; 
        align-items: center; 
        gap: 28px; 
    }
    .nav-links a {
        font-weight: 500; 
        font-size: 14px; 
        color: #1E293B;
        transition: var(--transition); 
        position: relative;
    }
    .nav-links a::after {
        content: ''; 
        position: absolute; 
        bottom: -4px; 
        left: 0;
        width: 0; 
        height: 2px; 
        background: #0F4C81; 
        transition: var(--transition);
    }
    .nav-links a:hover::after, 
    .nav-links a.active::after { 
        width: 100%; 
    }
    .nav-links a:hover { 
        color: #0F4C81; 
    }

    .hamburger {
        display: none; 
        flex-direction: column; 
        gap: 5px;
        cursor: pointer; 
        padding: 4px; 
        background: none; 
        border: none;
    }
    .hamburger span {
        display: block; 
        width: 26px; 
        height: 3px;
        background: #1E293B; 
        border-radius: 3px; 
        transition: var(--transition);
    }
    .hamburger.active span:nth-child(1) { 
        transform: rotate(45deg) translate(5px, 6px); 
    }
    .hamburger.active span:nth-child(2) { 
        opacity: 0; 
    }
    .hamburger.active span:nth-child(3) { 
        transform: rotate(-45deg) translate(5px, -6px); 
    }

    @media (max-width: 768px) {
        .hamburger { display: flex; }
        .nav-links {
            display: none; 
            flex-direction: column; 
            width: 100%;
            padding: 20px 0 10px; 
            gap: 16px; 
            border-top: 1px solid rgba(0,0,0,0.06);
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
        }
        .nav-links.open { display: flex; }
        .navbar .container { flex-wrap: wrap; }
    }

    @media (max-width: 480px) {
        .navbar .logo .logo-text .brand { font-size: 18px; }
        .navbar .logo img { height: 50px; }
        .navbar .logo .logo-text .sub-brand { font-size: 11px; }
    }
</style><?php /**PATH F:\Project-2\audit-app\resources\views/components/landing/navbar.blade.php ENDPATH**/ ?>