{{-- resources/views/components/landing/structure.blade.php --}}
<section class="section-padding" id="struktur" style="background: var(--bg);">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-label">Struktur Organisasi</span>
            <h2 class="section-title">Kepala & Staff <span>LPM</span></h2>
            <p class="section-desc mx-auto">Pengelola mutu yang berdedikasi untuk kemajuan UM Banjarmasin.</p>
        </div>

        {{-- Kepala LPM --}}
        <div class="struktur-kepala reveal" style="text-align:center; margin-top:40px;">
            <img src="{{ asset('images/kepala-lpm.jpg') }}" alt="Kepala LPM" 
                 style="width:160px; height:160px; border-radius:50%; object-fit:cover; border:4px solid var(--primary); background: #e2e8f0;"
                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22160%22 height=%22160%22%3E%3Crect fill=%22%23e2e8f0%22 width=%22160%22 height=%22160%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2230%22 fill=%22%2394a3b8%22%3E📸%3C/text%3E%3C/svg%3E'">
            <h3 style="margin-top:16px; font-family:'Poppins',sans-serif;">Dr. H. Ahmad Fauzi, M.Pd.</h3>
            <p style="color:var(--text-light);">Kepala Lembaga Penjaminan Mutu</p>
        </div>

        {{-- Staff --}}
        <div class="struktur-staff" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap:30px; margin-top:40px;">
            <div class="staff-card" style="text-align:center;">
                <img src="{{ asset('images/staff1.jpg') }}" alt="Staff" 
                     style="width:120px; height:120px; border-radius:50%; object-fit:cover; background:#e2e8f0;"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%22120%22%3E%3Crect fill=%22%23e2e8f0%22 width=%22120%22 height=%22120%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22 fill=%22%2394a3b8%22%3E👤%3C/text%3E%3C/svg%3E'">
                <h4 style="margin-top:10px; font-size:15px;">Dra. Siti Aminah, M.Si.</h4>
                <p style="font-size:13px; color:var(--text-light);">Sekretaris LPM</p>
            </div>
            <div class="staff-card" style="text-align:center;">
                <img src="{{ asset('images/staff2.jpg') }}" alt="Staff" 
                     style="width:120px; height:120px; border-radius:50%; object-fit:cover; background:#e2e8f0;"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%22120%22%3E%3Crect fill=%22%23e2e8f0%22 width=%22120%22 height=%22120%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22 fill=%22%2394a3b8%22%3E👤%3C/text%3E%3C/svg%3E'">
                <h4 style="margin-top:10px; font-size:15px;">Muhammad Ridwan, S.T., M.Eng.</h4>
                <p style="font-size:13px; color:var(--text-light);">Ketua Tim AMI</p>
            </div>
            <div class="staff-card" style="text-align:center;">
                <img src="{{ asset('images/staff3.jpg') }}" alt="Staff" 
                     style="width:120px; height:120px; border-radius:50%; object-fit:cover; background:#e2e8f0;"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%22120%22%3E%3Crect fill=%22%23e2e8f0%22 width=%22120%22 height=%22120%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22 fill=%22%2394a3b8%22%3E👤%3C/text%3E%3C/svg%3E'">
                <h4 style="margin-top:10px; font-size:15px;">Dr. Rina Marlina, S.Sos., M.A.</h4>
                <p style="font-size:13px; color:var(--text-light);">Koordinator Akreditasi</p>
            </div>
            <div class="staff-card" style="text-align:center;">
                <img src="{{ asset('images/staff4.jpg') }}" alt="Staff" 
                     style="width:120px; height:120px; border-radius:50%; object-fit:cover; background:#e2e8f0;"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%22120%22%3E%3Crect fill=%22%23e2e8f0%22 width=%22120%22 height=%22120%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22Arial%22 font-size=%2220%22 fill=%22%2394a3b8%22%3E👤%3C/text%3E%3C/svg%3E'">
                <h4 style="margin-top:10px; font-size:15px;">Hendra Gunawan, S.Kom., M.Kom.</h4>
                <p style="font-size:13px; color:var(--text-light);">Developer SIMANTAP</p>
            </div>
        </div>
    </div>
</section>