{{-- resources/views/components/landing/footer.blade.php --}}
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="brand">
                <h3>SIMANTAP</h3>
                <span class="tagline">Sistem Monitoring Audit &amp; Peringatan Akreditasi Terpadu</span>
                <p>Lembaga Penjaminan Mutu Universitas Muhammadiyah Banjarmasin berkomitmen mewujudkan pendidikan tinggi yang bermutu.</p>
                <div class="contact-info">
                    <span><i class="fas fa-map-marker-alt"></i> Jl. Gubernur Syarkawi, Semangat Dalam, Kec. Alalak, Kabupaten Barito Kuala, Kalimantan Selatan 70581</span>
                    <span><i class="fas fa-phone"></i> - </span>
                    <span><i class="fas fa-envelope"></i> lpm@umbjm.ac.id</span>
                </div>
            </div>

            <div class="col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#tentang">Profil</a></li>
                    <li><a href="#layanan">Layanan</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#dokumen">Dokumen</a></li>
                </ul>
            </div>

            <div class="col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Audit Mutu Internal</a></li>
                    <li><a href="#">Dokumen Mutu</a></li>
                    <li><a href="#">Akreditasi</a></li>
                    <li><a href="#">Monitoring & Evaluasi</a></li>
                </ul>
            </div>

            <div class="col">
                <h4>Ikuti Kami</h4>
                <ul>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom">
            &copy; {{ date('Y') }} SIMANTAP - Lembaga Penjaminan Mutu Universitas Muhammadiyah Banjarmasin. Dibangun untuk mutu pendidikan.
        </div>
    </div>
</footer>

<style>
    footer { background: #0a1628; color: rgba(255,255,255,0.7); padding: 60px 0 30px; }
    footer .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px; }
    footer .brand h3 { font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 800; color: var(--white); margin-bottom: 4px; }
    footer .brand h3 span { color: var(--accent); }
    footer .brand .tagline { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: var(--accent); font-weight: 600; margin-bottom: 10px; display: block; }
    footer .brand p { font-size: 14px; max-width: 300px; }
    footer .brand .contact-info { margin-top: 16px; display: flex; flex-direction: column; gap: 6px; font-size: 14px; }
    footer .brand .contact-info i { width: 20px; color: var(--accent); }
    footer .col h4 { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; color: var(--white); margin-bottom: 16px; }
    footer .col ul li { margin-bottom: 8px; }
    footer .col ul li a { font-size: 14px; transition: var(--transition); }
    footer .col ul li a:hover { color: var(--white); }
    footer .bottom { border-top: 1px solid rgba(255,255,255,0.06); padding-top: 24px; text-align: center; font-size: 14px; }
    @media (max-width: 1024px) { footer .footer-grid { grid-template-columns: 1fr 1fr; gap: 30px; } }
    @media (max-width: 768px) { footer .footer-grid { grid-template-columns: 1fr; gap: 24px; } }
</style>