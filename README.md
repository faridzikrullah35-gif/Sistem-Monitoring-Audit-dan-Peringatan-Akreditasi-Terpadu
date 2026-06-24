<h1>Sistem Monitoring Audit dan Peringatan Akreditasi Terpadu</h1>

<p>Sistem Informasi berbasis web yang dirancang khusus untuk <strong>Lembaga Penjaminan Mutu (LPM) Universitas Muhammadiyah Banjarmasin (UMBJM)</strong>. Sistem ini berfungsi untuk mengelola, memonitor, dan memberikan peringatan dini terkait proses Audit Mutu Internal (AMI) serta status akreditasi program studi dan fakultas di lingkungan UMBJM secara terintegrasi.</p>

<h2>🚀 Fitur Sistem</h2>

<p>Sistem ini dirancang untuk mempermudah tugas auditor, pimpinan unit, dan tim LPM dalam mengawal standar mutu akademik melalui modul-modul berikut:</p>

<ul>
  <li><strong>Dashboard Eksekutif LPM:</strong> Visualisasi real-time status audit fakultas/unit kerja dan grafik pemantauan masa berlaku akreditasi.</li>
  <li><strong>Sistem Peringatan Dini (Early Warning System):</strong> Notifikasi otomatis untuk masa berlaku akreditasi program studi yang akan habis guna persiapan re-akreditasi.</li>
  <li><strong>Siklus Audit Mutu Internal (AMI) Terintegrasi:</strong>
    <ul>
      <li><strong>Daftar Periksa:</strong> Lembar kerja instrumen audit untuk evaluasi standar mutu.</li>
      <li><strong>Hasil Audit &amp; Observasi:</strong> Pencatatan temuan, bukti fisik, dan kondisi lapangan oleh auditor.</li>
      <li><strong>PTK (Permintaan Tindakan Koreksi):</strong> Penerbitan formulir tindakan koreksi dan pelacakan status perbaikan oleh auditi.</li>
      <li><strong>Kategori Capaian (Terpenuhi):</strong> Pengelompokan indikator yang telah memenuhi standar mutu eksternal dan internal.</li>
    </ul>
  </li>
  <li><strong>Pelaporan Resmi (Fitur Print):</strong> Ekspor dan cetak langsung dokumen Hasil Audit, formulir PTK, serta Rekapitulasi capaian mutu sebagai arsip fisik resmi instansi.</li>
</ul>

<br>

<h2>🛠️ Tech Stack</h2>

<table>
  <thead>
    <tr>
      <th align="left">Komponen</th>
      <th align="left">Teknologi yang Digunakan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Backend Framework</strong></td>
      <td>Laravel (PHP)</td>
    </tr>
    <tr>
      <td><strong>Frontend UI</strong></td>
      <td>Blade Templating &amp; Tailwind CSS (TailAdmin Dashboard Template)</td>
    </tr>
    <tr>
      <td><strong>Asset Bundler</strong></td>
      <td>Vite</td>
    </tr>
    <tr>
      <td><strong>Database</strong></td>
      <td>MySQL</td>
    </tr>
  </tbody>
</table>

<br>

<h2>💻 Alur Instalasi Lokal</h2>

<p>Ikuti langkah-langkah berikut untuk menjalankan salinan proyek ini di lingkungan pengembangan lokal Anda:</p>

<h3>1. Clone Repositori</h3>
<pre><code>git clone https://github.com/faridzikrullah35-gif/Sistem-Monitoring-Audit-dan-Peringatan-Akreditasi-Terpadu.git
cd Sistem-Monitoring-Audit-dan-Peringatan-Akreditasi-Terpadu</code></pre>

<h3>2. Pemasangan Dependencies</h3>
<pre><code># Memasang package PHP via Composer
composer install

# Memasang package JavaScript via NPM
npm install</code></pre>

<h3>3. Konfigurasi Environment</h3>
<p>Salin file <code>.env.example</code> menjadi file <code>.env</code> baru:</p>
<pre><code>cp .env.example .env</code></pre>
<p>Buka file <code>.env</code> dan sesuaikan kredensial database lokal Anda:</p>
<pre><code>DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=</code></pre>

<h3>4. Pembuatan Application Key &amp; Migrasi Database</h3>
<pre><code>php artisan key:generate
php artisan migrate --seed</code></pre>

<h3>5. Menjalankan Aplikasi</h3>
<p>Jalankan kedua perintah berikut pada terminal terpisah untuk mengaktifkan local server dan compiler aset:</p>
<pre><code># Terminal 1: Menjalankan Laravel local server
php artisan serve

# Terminal 2: Menjalankan Vite compiler
npm run dev</code></pre>
<p>Aplikasi dapat diakses melalui peramban pada alamat resmi lokal: <code>http://127.0.0.1:8000</code>.</p>

<br>

<h2>🏛️ Instansi Pengembang</h2>
<ul>
  <li><strong>Klien/Instansi:</strong> Lembaga Penjaminan Mutu (LPM) - Universitas Muhammadiyah Banjarmasin (UMBJM)</li>
  <li><strong>Status Proyek:</strong> Produksi / Pengembangan Aktif</li>
</ul>

<br>

<h2>📄 Lisensi</h2>
<p>Proyek ini dilisensikan di bawah <a href="LICENSE">MIT License</a>.</p>