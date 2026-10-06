<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataAuditorController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\StandarController;
use App\Http\Controllers\SettingAksesAuditorController;
use App\Http\Controllers\IsiAksesAuditorController;
use App\Http\Controllers\MatrixPenilaianController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\PertanyaanAmiProdiController;
use App\Http\Controllers\PertanyaanAmiUnitController;
use App\Http\Controllers\IsiDataAuditieeController;
use App\Http\Controllers\FormDaftarPeriksaController;
use App\Http\Controllers\FormKetidaksesuaianNcrController;
use App\Http\Controllers\FormObservasiController;
use App\Http\Controllers\CetakRekapitulasiAmiController;
use App\Http\Controllers\SettingScoreController;
use App\Http\Controllers\DataAuditeeController;
use App\Http\Controllers\AuditeeDaftarPeriksaController;
use App\Http\Controllers\FormPtkController;
use App\Http\Controllers\AuditeeObservasiController;
use App\Http\Controllers\CetakRekapitulasiController;
use App\Http\Controllers\CetakRekapitulasiAuditeeController;
use App\Http\Controllers\FormTerpenuhiController;
use App\Http\Controllers\AuditeeTerpenuhiController;
use App\Http\Controllers\HasilAuditDaftarPeriksaController;
use App\Http\Controllers\HasilAuditPtkController;
use App\Http\Controllers\HasilAuditObservasiController;
use App\Http\Controllers\HasilAuditTerpenuhiController;
use App\Http\Controllers\HasilAuditRekapitulasiController;
use App\Http\Controllers\PenilaianKinerjaController;
use App\Http\Controllers\EarlyWarningSystemController;
use App\Http\Controllers\EarlyWarningSystemAdminController;
use App\Http\Controllers\DataAkreditasiController;
use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\Prodi\ProfileProdiController;
use App\Http\Controllers\Prodi\ProdiSosialMediaController;
use App\Http\Controllers\Prodi\ProdiKegiatanBenchmarkingController;
use App\Http\Controllers\Prodi\ProfilePdDiktiController as ProdiProfilePdDiktiController;
use App\Http\Controllers\Prodi\ProfileSdmController;
use App\Http\Controllers\Prodi\RasioController;
use App\Http\Controllers\Prodi\LulusanController;
use App\Http\Controllers\Prodi\DosenController;
use App\Http\Controllers\Prodi\TendikController;
use App\Http\Controllers\Prodi\PenelitianController;
use App\Http\Controllers\Prodi\PublikasiIlmiahController;
use App\Http\Controllers\Prodi\PKMController;
use App\Http\Controllers\Prodi\InovasiController;
use App\Http\Controllers\Prodi\PrestasiAkademikMahasiswaController;
use App\Http\Controllers\Prodi\PendidikanController;
use App\Http\Controllers\Prodi\ProdiKurikulumController;
use App\Http\Controllers\Prodi\ProdiPengajaranController;
use App\Http\Controllers\Prodi\ProdiBimbinganController;
use App\Http\Controllers\Prodi\ProdiSintaController;
use App\Http\Controllers\Prodi\SarprasProdiController;
use App\Http\Controllers\Auditor\IdentitasProdiController;
use App\Http\Controllers\Auditor\ProfilePddiktiController as AuditorProfilePddiktiController;
use App\Http\Controllers\Auditor\ProfileSdmController as AuditorProfileSdmController;
use App\Http\Controllers\Auditor\SarprasAuditorController;
use App\Http\Controllers\Auditor\PendidikanAuditorController;
use App\Http\Controllers\Auditor\SintaAuditorController;
use App\Http\Controllers\Auditor\PenelitianAuditorController;
use App\Http\Controllers\Auditor\PublikasiIlmiahAuditorController;
use App\Http\Controllers\Auditor\PkmAuditorController;
use App\Http\Controllers\Auditor\InovasiAuditorController;
use App\Http\Controllers\Auditor\PrestasiAkademikMahasiswaAuditorController;
use App\Http\Controllers\Admin\SettingHeaderCetakController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserImportController;
use App\Http\Controllers\Admin\SettingLandingPageController;
use App\Http\Controllers\Admin\SettingProfileAdminController;
use App\Http\Controllers\Admin\SettingHakAksesFakultasController;
use App\Http\Controllers\Admin\SarprasController;
use App\Http\Controllers\Fakultas\ProfileFakultasController;
use App\Http\Controllers\Fakultas\FakultasHasilAuditDaftarPeriksaController;
use App\Http\Controllers\Fakultas\FakultasHasilAuditPtkController;
use App\Http\Controllers\Fakultas\FakultasHasilAuditObservasiController;
use App\Http\Controllers\Fakultas\FakultasHasilAuditTerpenuhiController;
use App\Http\Controllers\Fakultas\FakultasHasilAuditRekapitulasiController;
use App\Http\Controllers\Fakultas\SarprasFakultasController;
use App\Http\Controllers\Fakultas\FakultasProfilePdDiktiController;
use App\Http\Controllers\Fakultas\FakultasProfileSdmController;
use App\Http\Controllers\Fakultas\FakultasPendidikanController;
use App\Http\Controllers\Fakultas\FakultasSintaController;
use App\Http\Controllers\Fakultas\FakultasPenelitianController;
use App\Http\Controllers\Fakultas\FakultasPublikasiIlmiahController;
use App\Http\Controllers\Fakultas\FakultasPkmController;
use App\Http\Controllers\Fakultas\FakultasInovasiController;
use App\Http\Controllers\Fakultas\FakultasPrestasiAkademikMahasiswaController;

use App\Http\Controllers\LandingController;

// Route::get('/', function () {
//     return redirect()->route('login');
// });

// Route::redirect('/', '/SIMANTAP-Sistem-Monitoring-Audit-dan-Peringatan-Akreditasi-Terpadu');

// Route::get('/SIMANTAP-Sistem-Monitoring-Audit-dan-Peringatan-Akreditasi-Terpadu', function () {
//     return view('pages.landing.landingpage-simantap');
// })->name('landing');

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/early-warning-system', [App\Http\Controllers\EarlyWarningSystemController::class, 'index'])->name('ews.index');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/dashboard', function () {

    return match (auth()->user()->role) {

        'admin' => redirect()->route('admin.dashboard'),

        'auditor',
        'unit_kerja' => redirect()->route('auditor.dashboard'),

        'prodi' => redirect()->route('prodi.dashboard'),

        'fakultas' => redirect()->route('fakultas.dashboard'),

        default => abort(403),

    };

})->name('dashboard');

Route::middleware(['auth', 'admin.access'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    Route::prefix('others')->group(function () {
        Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
        Route::get('/pengguna/sub-unit', [UserController::class, 'getSubUnit'])->name('pengguna.sub-unit');
        Route::get('/pengguna/filter', [UserController::class, 'filterData'])->name('pengguna.filter');
        Route::post('/pengguna/store', [UserController::class, 'store'])->name('pengguna.store');
        Route::get('/pengguna/{id}', [UserController::class, 'show'])->name('pengguna.show');
        Route::put('/pengguna/update/{id}', [UserController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.delete');
    });

    // ==================== SETTING HAK AKSES FAKULTAS ====================
    // Route AJAX - Taruh DI ATAS route dengan parameter {id}
    Route::get('/setting-hak-akses-fakultas/get-sub-units', [SettingHakAksesFakultasController::class, 'getSubUnitsByFaculty'])
        ->name('admin.setting-hak-akses-fakultas.get-sub-units');
    Route::get('/setting-hak-akses-fakultas/get-user-data/{id}', [SettingHakAksesFakultasController::class, 'getUserData'])
        ->name('admin.setting-hak-akses-fakultas.get-user-data');

    // Route CRUD - Taruh DI BAWAH route AJAX
    Route::get('/setting-hak-akses-fakultas', [SettingHakAksesFakultasController::class, 'index'])
        ->name('admin.setting-hak-akses-fakultas.index');
    Route::post('/setting-hak-akses-fakultas/store', [SettingHakAksesFakultasController::class, 'store'])
        ->name('admin.setting-hak-akses-fakultas.store');
    Route::get('/setting-hak-akses-fakultas/{id}', [SettingHakAksesFakultasController::class, 'show'])
        ->name('admin.setting-hak-akses-fakultas.show');
    Route::put('/setting-hak-akses-fakultas/update/{id}', [SettingHakAksesFakultasController::class, 'update'])
        ->name('admin.setting-hak-akses-fakultas.update');

    // TAMBAHKAN ROUTE EDIT DAN DESTROY
    Route::get('/setting-hak-akses-fakultas/{id}/edit', [SettingHakAksesFakultasController::class, 'edit'])
        ->name('admin.setting-hak-akses-fakultas.edit');
    Route::delete('/setting-hak-akses-fakultas/delete/{id}', [SettingHakAksesFakultasController::class, 'destroy'])
        ->name('admin.setting-hak-akses-fakultas.destroy');

    Route::post('/setting-hak-akses-fakultas/toggle-status/{id}', [SettingHakAksesFakultasController::class, 'toggleStatus'])
        ->name('admin.setting-hak-akses-fakultas.toggle-status');

    // ==================== ROUTE UNTUK MANAJEMEN ROLE ====================
    Route::get('/kelola-roles', [RoleController::class, 'index'])
        ->name('kelola-roles.index');
    Route::post('/kelola-roles/store', [RoleController::class, 'store'])
        ->name('roles.store');
    Route::get('/kelola-roles/{id}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit');
    Route::put('/kelola-roles/{id}', [RoleController::class, 'update'])
        ->name('roles.update');
    Route::delete('/kelola-roles/{id}', [RoleController::class, 'destroy'])
        ->name('roles.destroy');
    
    Route::get('/users/import/template',[UserImportController::class, 'downloadTemplate'])
        ->name('admin.users.import.template');
    Route::post('/users/import',[UserImportController::class, 'import'])
        ->name('admin.users.import');

    // Data Auditor - list page
    Route::get('/data-auditor', [DataAuditorController::class, 'index'])
        ->name('data-auditor.index');
    // Store auditor baru
    Route::post('/data-auditor/store', [DataAuditorController::class, 'store'])
        ->name('data-auditor.store');
    // Show detail auditor
    Route::get('/data-auditor/{id}', [DataAuditorController::class, 'show'])
        ->name('data-auditor.show');
    // Update auditor
    Route::post('/data-auditor/update/{id}', [DataAuditorController::class, 'update'])
        ->name('data-auditor.update');
    // Delete auditor
    Route::delete('/data-auditor/delete/{id}', [DataAuditorController::class, 'destroy'])
        ->name('data-auditor.delete');

    // Setting Tahun Akademik - list page
    Route::get('/setting-tahun-akademik', [TahunAkademikController::class, 'index'])
        ->name('tahun-akademik.index');
    // Store tahun akademik baru
    Route::post('/setting-tahun-akademik/store', [TahunAkademikController::class, 'store'])
        ->name('tahun-akademik.store');
    // Show detail tahun akademik
    Route::get('/setting-tahun-akademik/{id}', [TahunAkademikController::class, 'show'])
        ->name('tahun-akademik.show');
    // Update tahun akademik
    Route::post('/setting-tahun-akademik/update/{id}', [TahunAkademikController::class, 'update'])
        ->name('tahun-akademik.update');
    // Delete tahun akademik
    Route::delete('/setting-tahun-akademik/delete/{id}', [TahunAkademikController::class, 'destroy'])
        ->name('tahun-akademik.delete');
    // LIST
    Route::get('/setting-kriteria', [KriteriaController::class, 'index'])
        ->name('setting-kriteria.index');
    // STORE
    Route::post('/setting-kriteria', [KriteriaController::class, 'store'])
        ->name('setting-kriteria.store');
    // UPDATE (PUT)
    Route::put('/setting-kriteria/{id}', [KriteriaController::class, 'update'])
        ->name('setting-kriteria.update');
    // DELETE
    Route::delete('/setting-kriteria/{id}', [KriteriaController::class, 'destroy'])
        ->name('setting-kriteria.delete');
    // SHOW (TARUH PALING BAWAH BIAR GAK TABRAKAN)
    Route::get('/setting-kriteria/{id}', [KriteriaController::class, 'show'])
        ->name('setting-kriteria.show');

        // List standar
    Route::get('/standar', [StandarController::class, 'index'])
        ->name('standar.index');
    // Store standar baru
    Route::post('/standar/store', [StandarController::class, 'store'])
        ->name('standar.store');
    Route::get('/standar/data', [StandarController::class, 'getData'])->name('standar.data');
    // Show detail standar
    Route::get('/standar/{id}', [StandarController::class, 'show'])
        ->name('standar.show');
    // Update standar
    Route::post('/standar/update/{id}', [StandarController::class, 'update'])
        ->name('standar.update');
    // Delete standar
    Route::post('/standar/delete/{id}', [StandarController::class, 'destroy'])
        ->name('standar.delete');

    // Halaman utama
    Route::get('/setting-akses-auditor', [SettingAksesAuditorController::class, 'index'])
        ->name('akses-auditor.index');
    Route::get('/ajax/isi-akses/{id}', [SettingAksesAuditorController::class, 'getIsiAkses']);
    // STORE
    Route::post('/setting-akses-auditor', [SettingAksesAuditorController::class, 'store'])
        ->name('akses-auditor.store');
    // SHOW (ambil data buat edit modal)
    Route::get('/setting-akses-auditor/{id}', [SettingAksesAuditorController::class, 'show'])
        ->name('akses-auditor.show');
    // UPDATE
    Route::put('/setting-akses-auditor/{id}', [SettingAksesAuditorController::class, 'update'])
        ->name('akses-auditor.update');
    // DELETE
    Route::delete('/setting-akses-auditor/{id}', [SettingAksesAuditorController::class, 'destroy'])
        ->name('akses-auditor.destroy');
    // STORE
    Route::post('/isi-akses-auditor', [IsiAksesAuditorController::class, 'store'])
        ->name('isi-akses-auditor.store');
    // SHOW (ambil semua auditor dalam 1 akses)
    Route::get('/isi-akses-auditor/{id}', [IsiAksesAuditorController::class, 'show'])
        ->name('isi-akses-auditor.show');
    // UPDATE
    Route::get('/isi-akses-auditor/{id}/edit', [IsiAksesAuditorController::class, 'edit'])
        ->name('isi-akses-auditor.edit');
    Route::put('/isi-akses-auditor/{id}', [IsiAksesAuditorController::class, 'update'])
        ->name('isi-akses-auditor.update');
    // DELETE
    Route::delete('/isi-akses-auditor/{id}', [IsiAksesAuditorController::class, 'destroy'])
        ->name('isi-akses-auditor.destroy');

    // LIST PAGE (INDEX)
    Route::get('/matriks-penilaian', [MatrixPenilaianController::class, 'index'])
        ->name('matriks-penilaian.index');
    // CREATE / STORE
    Route::post('/matrix/store', [MatrixPenilaianController::class, 'store'])
        ->name('matrix.store');
    // GET SINGLE DATA (FOR EDIT MODAL AJAX)
    Route::get('/matrix/{id}', [MatrixPenilaianController::class, 'show'])
        ->name('matrix.show');
    // UPDATE DATA
    Route::post('/matrix/update/{id}', [MatrixPenilaianController::class, 'update'])
        ->name('matrix.update');
    // DELETE DATA
    Route::delete('/matrix/delete/{id}', [MatrixPenilaianController::class, 'destroy'])
        ->name('matrix.delete');

    Route::post('/indikator/store', [IndikatorController::class, 'store'])
        ->name('indikator.store');
    Route::put('/indikator/{id}', [IndikatorController::class, 'update'])
        ->name('indikator.update');
    Route::delete('/indikator/{id}', [IndikatorController::class, 'destroy'])
        ->name('indikator.destroy');
    Route::get('/indikator/by-elemen/{id}', [IndikatorController::class, 'getByElemen']);
    
    // LIST PAGE (INDEX)
    Route::get('/pertanyaan-ami-prodi', [PertanyaanAmiProdiController::class, 'index'])
        ->name('pertanyaan-ami-prodi.index');
    // Store
    Route::post('/pertanyaan-ami-prodi/store', [PertanyaanAmiProdiController::class, 'store'])
        ->name('pertanyaan-ami-prodi.store');
    // Update
    Route::put('/pertanyaan-ami-prodi/{id}', [PertanyaanAmiProdiController::class, 'update'])
        ->name('pertanyaan-ami-prodi.update');

    // Delete
    Route::delete('/pertanyaan-ami-prodi/delete-all', [PertanyaanAmiProdiController::class, 'deleteAll'])
        ->name('pertanyaan-ami-prodi.delete-all');
    Route::delete('/pertanyaan-ami-prodi/delete-filtered', [PertanyaanAmiProdiController::class, 'destroyFiltered'])
        ->name('pertanyaan-ami-prodi.delete-filtered');
    Route::delete('/pertanyaan-ami-prodi/{id}', [PertanyaanAmiProdiController::class, 'destroy'])
        ->name('pertanyaan-ami-prodi.delete');

        // LIST PAGE (INDEX)
    Route::get('/pertanyaan-ami-unit', [PertanyaanAmiUnitController::class, 'index'])
        ->name('pertanyaan-ami-unit.index');
    // Store
    Route::post('/pertanyaan-ami-unit/store', [PertanyaanAmiUnitController::class, 'store'])
        ->name('pertanyaan-ami-unit.store');
    // Update
    Route::put('/pertanyaan-ami-unit/{id}', [PertanyaanAmiUnitController::class, 'update'])
        ->name('pertanyaan-ami-unit.update');

    // Delete
    Route::delete('/pertanyaan-ami-unit/delete-all', [PertanyaanAmiUnitController::class, 'deleteAll'])
        ->name('pertanyaan-ami-unit.delete-all');
    Route::delete('/pertanyaan-ami-unit/delete-filtered', [PertanyaanAmiUnitController::class, 'destroyFiltered'])
        ->name('pertanyaan-ami-unit.delete-filtered');
    Route::delete('/pertanyaan-ami-unit/{id}', [PertanyaanAmiUnitController::class, 'destroy'])
        ->name('pertanyaan-ami-unit.delete');

    Route::get('/setting-score', [SettingScoreController::class, 'index'])
        ->name('setting-score.index');
    Route::get('/setting-score/create', [SettingScoreController::class, 'create'])
        ->name('setting-score.create');
    Route::post('/setting-score/store', [SettingScoreController::class, 'store'])
        ->name('setting-score.store');
    Route::get('/setting-score/edit/{id}', [SettingScoreController::class, 'edit'])
        ->name('setting-score.edit');
    Route::put('/setting-score/update/{id}', [SettingScoreController::class, 'update'])
        ->name('setting-score.update');
    Route::delete('/setting-score/delete/{id}', [SettingScoreController::class, 'destroy'])
        ->name('setting-score.delete');

    Route::get('/hasil-audit/daftar-periksa', [HasilAuditDaftarPeriksaController::class, 'index'])
        ->name('hasil-audit.daftar-periksa');
    Route::get('/hasil-audit/daftar-periksa/print', [HasilAuditDaftarPeriksaController::class, 'print'])
        ->name('hasil-audit.daftar-periksa.print');
    Route::get('/hasil-audit/filter', [HasilAuditDaftarPeriksaController::class, 'filter'])
        ->name('hasil-audit.filter');

    Route::get('/hasil-audit/ptk', [HasilAuditPtkController::class, 'index'])
        ->name('hasil-audit.ptk');
    Route::get('/hasil-audit/ptk/filter', [HasilAuditPtkController::class, 'filter'])
        ->name('hasil-audit.ptk.filter');
    Route::get('/hasil-audit/ptk/print', [HasilAuditPtkController::class, 'print'])
        ->name('hasil-audit.ptk.print');

    Route::get('/hasil-audit/observasi', [HasilAuditObservasiController::class, 'index'])
        ->name('hasil-audit.observasi');
    Route::get('/hasil-audit/observasi/filter', [HasilAuditObservasiController::class, 'filter'])
        ->name('hasil-audit.observasi.filter');
    Route::get('/hasil-audit/observasi/print', [HasilAuditObservasiController::class, 'print'])
        ->name('hasil-audit.observasi.print');

    Route::get('/hasil-audit/terpenuhi', [HasilAuditTerpenuhiController::class, 'index'])
        ->name('hasil-audit.terpenuhi');
    Route::get('/hasil-audit/terpenuhi/filter', [HasilAuditTerpenuhiController::class, 'filter'])
        ->name('hasil-audit.terpenuhi.filter');
    Route::get('/hasil-audit/terpenuhi/print', [HasilAuditTerpenuhiController::class, 'print'])
        ->name('hasil-audit.terpenuhi.print');

    Route::get('/hasil-audit/rekapitulasi', [HasilAuditRekapitulasiController::class, 'index'])
        ->name('hasil-audit.rekapitulasi');
    Route::get('/hasil-audit/rekapitulasi/filter', [HasilAuditRekapitulasiController::class, 'filter'])
        ->name('hasil-audit.rekapitulasi.filter');
    Route::get('/hasil-audit/rekapitulasi/print', [HasilAuditRekapitulasiController::class, 'print'])
        ->name('hasil-audit.rekapitulasi.print');

    // ==================== DATA AKREDITASI ====================
    Route::get('/data-akreditasi', [DataAkreditasiController::class, 'index'])
        ->name('data-akreditasi');
    Route::post('/data-akreditasi/store', [DataAkreditasiController::class, 'store'])
        ->name('data-akreditasi.store');
    Route::get('/data-akreditasi/{id}', [DataAkreditasiController::class, 'show'])
        ->name('data-akreditasi.show');
    Route::put('/data-akreditasi/update/{id}', [DataAkreditasiController::class, 'update'])
        ->name('data-akreditasi.update');
    Route::delete('/data-akreditasi/delete/{id}', [DataAkreditasiController::class, 'destroy'])
        ->name('data-akreditasi.delete');
    
    Route::get('/early-warning-system', [EarlyWarningSystemAdminController::class, 'index'])
        ->name('early-warning-system');
    Route::get('/sub-unit/{unit}', [EarlyWarningSystemAdminController::class, 'getSubUnit'])
        ->name('early-warning-system.sub-unit');
    Route::post('/early-warning-system', [EarlyWarningSystemAdminController::class, 'store'])
        ->name('early-warning-system.store');
    Route::get('/early-warning-system/{id}/edit', [EarlyWarningSystemAdminController::class, 'edit'])
        ->name('early-warning-system.edit');
    Route::put('/early-warning-system/{id}', [EarlyWarningSystemAdminController::class, 'update'])
        ->name('early-warning-system.update');
    Route::delete('/early-warning-system/{id}', [EarlyWarningSystemAdminController::class, 'destroy'])
        ->name('early-warning-system.destroy');

    // Setting Header Cetak
    Route::get('/setting-header-cetak', [SettingHeaderCetakController::class, 'index'])
        ->name('setting-header-cetak');
    Route::post('/setting-header-cetak/store', [SettingHeaderCetakController::class, 'store'])
        ->name('setting-header-cetak.store');
    Route::get('/setting-header-cetak/{id}', [SettingHeaderCetakController::class, 'show'])
        ->name('setting-header-cetak.show');
    Route::put('/setting-header-cetak/update/{id}', [SettingHeaderCetakController::class, 'update'])
        ->name('setting-header-cetak.update');
    Route::delete('/setting-header-cetak/delete/{id}', [SettingHeaderCetakController::class, 'destroy'])
        ->name('setting-header-cetak.delete');

    // Setting Landing Page
    Route::get('/setting-landing-page', [SettingLandingPageController::class, 'index'])
        ->name('setting-landing-page.index');
    Route::post('/setting-landing-page/store', [SettingLandingPageController::class, 'store'])
        ->name('setting-landing-page.store');
    Route::get('/setting-landing-page/data', [SettingLandingPageController::class, 'getData'])
        ->name('setting-landing-page.data');
    Route::get('/setting-landing-page/preview/{id}', [SettingLandingPageController::class, 'preview'])
        ->name('setting-landing-page.preview');
    Route::get('/setting-landing-page/download/{id}', [SettingLandingPageController::class, 'download'])
        ->name('setting-landing-page.download');
    Route::get('/setting-landing-page/{id}', [SettingLandingPageController::class, 'show'])
        ->name('setting-landing-page.show');
    Route::put('/setting-landing-page/update/{id}', [SettingLandingPageController::class, 'update'])
        ->name('setting-landing-page.update');
    Route::delete('/setting-landing-page/delete/{id}', [SettingLandingPageController::class, 'destroy'])
        ->name('setting-landing-page.destroy');
    
    Route::get('/setting-profile-admin', [SettingProfileAdminController::class, 'index'])
        ->name('setting-profile-admin.index');    
    // Route CRUD untuk konten tentang kami
    Route::post('/setting-profile', [SettingProfileAdminController::class, 'store'])
        ->name('admin.setting-profile.store');    
    Route::get('/setting-profile/{id}/edit', [SettingProfileAdminController::class, 'edit'])
        ->name('admin.setting-profile.edit');    
    Route::put('/setting-profile/{id}', [SettingProfileAdminController::class, 'update'])
        ->name('admin.setting-profile.update');    
    Route::delete('/setting-profile/{id}', [SettingProfileAdminController::class, 'destroy'])
        ->name('admin.setting-profile.destroy');
    // Route CRUD untuk struktur organisasi
    Route::post('/setting-struktur', [SettingProfileAdminController::class, 'storeStruktur'])
        ->name('admin.setting-struktur.store');
    Route::get('/setting-struktur/{id}/edit', [SettingProfileAdminController::class, 'editStruktur'])
        ->name('admin.setting-struktur.edit');
    Route::put('/setting-struktur/{id}', [SettingProfileAdminController::class, 'updateStruktur'])
        ->name('admin.setting-struktur.update');
    Route::delete('/setting-struktur/{id}', [SettingProfileAdminController::class, 'destroyStruktur'])
        ->name('admin.setting-struktur.destroy');

    Route::get('/sarpras', [SarprasController::class, 'index'])
        ->name('sarpras');
    Route::get('/sarpras/data', [SarprasController::class, 'data'])
        ->name('sarpras.data');
    Route::post('/sarpras', [SarprasController::class, 'store'])
        ->name('sarpras.store');
    Route::get('/sarpras/{sarpras}', [SarprasController::class, 'show'])
        ->name('sarpras.show');
    Route::put('/sarpras/{sarpras}', [SarprasController::class, 'update'])
        ->name('sarpras.update');
    Route::delete('/sarpras/{sarpras}', [SarprasController::class, 'destroy'])
        ->name('sarpras.destroy');

});

Route::middleware(['auth', 'role:auditor,prodi,unit_kerja'])
    ->prefix('auditor')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'auditor'])
        ->name('auditor.dashboard');

    // Route untuk view only
    Route::get('/identitas-prodi', [IdentitasProdiController::class, 'index'])
        ->name('identitas-prodi');
    Route::get('/profile-pd-dikti', [AuditorProfilePddiktiController::class, 'index'])
        ->name('profile-pd-dikti');
    Route::get('/profile-sdm', [AuditorProfileSdmController::class, 'index'])
        ->name('profile-sdm');

    Route::get('/isi-data-auditee', [IsiDataAuditieeController::class, 'index'])
        ->name('isi-data-auditee');

    Route::post('/isi-data-auditiee/store', [IsiDataAuditieeController::class, 'store'])
            ->name('auditiee.store');

    Route::get('/isi-data-auditiee/{id}/edit', [IsiDataAuditieeController::class, 'edit'])
        ->name('auditiee.edit');

    Route::put('/isi-data-auditiee/{id}', [IsiDataAuditieeController::class, 'update'])
        ->name('auditiee.update');

    Route::delete('/isi-data-auditiee/{id}', [IsiDataAuditieeController::class, 'destroy'])
        ->name('auditiee.destroy');

    Route::get('/form-daftar-periksa', [FormDaftarPeriksaController::class, 'index'])
        ->name('form-daftar-periksa');
    Route::get('/form-daftar-periksa/print', [FormDaftarPeriksaController::class, 'print'])
        ->name('form-daftar-periksa.print');
    Route::post('/form-daftar-periksa/store', [FormDaftarPeriksaController::class, 'store'])
        ->name('form-daftar-periksa.store');
    Route::get('/form-daftar-periksa/{id}/edit', [FormDaftarPeriksaController::class, 'edit'])
        ->name('form-daftar-periksa.edit');
    Route::put('/form-daftar-periksa/{id}', [FormDaftarPeriksaController::class, 'update'])
        ->name('form-daftar-periksa.update');
    Route::delete('/form-daftar-periksa/{id}', [FormDaftarPeriksaController::class, 'destroy'])
        ->name('form-daftar-periksa.destroy');

    Route::get('/form-ptk-permintaan-tindakan-koreksi', [FormKetidaksesuaianNcrController::class, 'index'])
        ->name('form-ptk-permintaan-tindakan-koreksi');
    Route::get('/form-ketidaksesuaian-ncr/print', [FormKetidaksesuaianNcrController::class, 'print'])
        ->name('form-ketidaksesuaian-ncr.print');
    Route::post('/form-ketidaksesuaian-ncr/store', [FormKetidaksesuaianNcrController::class, 'store'])
        ->name('form-ketidaksesuaian-ncr.store');
    Route::get('/form-ketidaksesuaian-ncr/{id}/edit', [FormKetidaksesuaianNcrController::class, 'edit'])
        ->name('form-ketidaksesuaian-ncr.edit');
    Route::put('/form-ketidaksesuaian-ncr/{id}', [FormKetidaksesuaianNcrController::class, 'update'])
        ->name('form-ketidaksesuaian-ncr.update');
    Route::delete('/form-ketidaksesuaian-ncr/{id}', [FormKetidaksesuaianNcrController::class, 'destroy'])
        ->name('form-ketidaksesuaian-ncr.destroy');

    Route::get('/form-observasi', [FormObservasiController::class, 'index'])
        ->name('form-observasi');
    Route::get('/form-observasi/print', [FormObservasiController::class, 'print'])
        ->name('form-observasi.print');
    Route::post('/form-observasi/store', [FormObservasiController::class, 'store'])
        ->name('form-observasi.store');
    Route::get('/form-observasi/{id}/edit', [FormObservasiController::class, 'edit'])
        ->name('form-observasi.edit');
    Route::put('/form-observasi/{id}', [FormObservasiController::class, 'update'])
        ->name('form-observasi.update');
    Route::delete('/form-observasi/{id}', [FormObservasiController::class, 'destroy'])
        ->name('form-observasi.destroy');

    Route::get('/form-terpenuhi', [FormTerpenuhiController::class, 'index'])->name('form-terpenuhi');
    Route::get('/form-terpenuhi/print', [FormTerpenuhiController::class, 'print'])->name('form-terpenuhi.print');
    Route::post('/form-terpenuhi/store', [FormTerpenuhiController::class, 'store'])->name('form-terpenuhi.store');
    Route::get('/form-terpenuhi/{id}/edit', [FormTerpenuhiController::class, 'edit'])->name('form-terpenuhi.edit');
    Route::put('/form-terpenuhi/{id}', [FormTerpenuhiController::class, 'update'])->name('form-terpenuhi.update');
    Route::delete('/form-terpenuhi/{id}', [FormTerpenuhiController::class, 'destroy'])->name('form-terpenuhi.destroy');

    Route::get('/cetak-rekapitulasi-ami', [CetakRekapitulasiController::class, 'index'])->name('cetak-ami.index');
    Route::get('/cetak-rekapitulasi-ami/data', [CetakRekapitulasiController::class, 'getData'])->name('cetak-ami.data');
    Route::get('/cetak-rekapitulasi-ami/print', [CetakRekapitulasiController::class, 'print'])->name('cetak-ami.print');

    Route::get('/sarpras', [App\Http\Controllers\Auditor\SarprasAuditorController::class, 'index'])
        ->name('sarpras');
    Route::get('/sarpras/data', [App\Http\Controllers\Auditor\SarprasAuditorController::class, 'data'])
        ->name('sarpras.data');

    // PENDIDIKAN (View Only)
    Route::get('/pendidikan', [App\Http\Controllers\Auditor\PendidikanAuditorController::class, 'index'])->name('pendidikan');
    // SINTA (View Only)
    Route::get('/sinta', [App\Http\Controllers\Auditor\SintaAuditorController::class, 'index'])->name('sinta');
    // PENELITIAN
    Route::get('/penelitian', [App\Http\Controllers\Auditor\PenelitianAuditorController::class, 'index'])->name('penelitian');
    // PUBLIKASI ILMIAH (View Only)
    Route::get('/publikasi-ilmiah', [App\Http\Controllers\Auditor\PublikasiIlmiahAuditorController::class, 'index'])->name('publikasi-ilmiah');
    // PKM (View Only)
    Route::get('/pkm', [App\Http\Controllers\Auditor\PkmAuditorController::class, 'index'])->name('pkm');
    // INOVASI (View Only)
    Route::get('/inovasi', [App\Http\Controllers\Auditor\InovasiAuditorController::class, 'index'])->name('inovasi');
    // PRESTASI AKADEMIK MAHASISWA (View Only)
    Route::get('/prestasi-akademik-mahasiswa', [App\Http\Controllers\Auditor\PrestasiAkademikMahasiswaAuditorController::class, 'index'])->name('prestasi-akademik-mahasiswa');
});

Route::middleware(['auth', 'role:prodi,unit_kerja'])
    ->prefix('prodi')
    ->name('prodi.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'prodi'])
        ->name('dashboard');
    
    Route::get('/notifications', [DashboardController::class, 'getAuditeeNotifications'])
        ->name('notifications');

    Route::get('/data-auditee', [DataAuditeeController::class, 'index'])
        ->name('data-auditee.index');

    Route::get('/daftar-periksa', [AuditeeDaftarPeriksaController::class, 'index'])
        ->name('daftar-periksa.index');
    Route::get('/daftar-periksa/print', [AuditeeDaftarPeriksaController::class, 'print'])
        ->name('daftar-periksa.print');

    Route::get('/form-ptk', [FormPtkController::class, 'index'])
        ->name('auditee.form-ptk.index');
    Route::get('/form-ptk/print', [FormPtkController::class, 'print'])
    ->name('auditee.ptk.print');
    Route::put('/form-ptk/{id}', [FormPtkController::class, 'update'])
        ->name('auditee.form-ptk.update');

    Route::get('/observasi', [AuditeeObservasiController::class, 'index'])
        ->name('auditee.observasi');
    Route::get('/observasi/print', [AuditeeObservasiController::class, 'print'])
        ->name('auditee-observasi.print');

    Route::get('/terpenuhi', [AuditeeTerpenuhiController::class, 'index'])
        ->name('auditee.terpenuhi');
    Route::get('/terpenuhi/print', [AuditeeTerpenuhiController::class, 'print'])
        ->name('auditee.terpenuhi.print');

    Route::get('/cetak-rekapitulasi-ami', [CetakRekapitulasiAuditeeController::class, 'index'])
        ->name('cetak-auditee.index');
    Route::get('/cetak-rekapitulasi-auditee/data', [CetakRekapitulasiAuditeeController::class, 'getData'])
        ->name('cetak-auditee.data');
    Route::get('/cetak-rekapitulasi-auditee/print', [CetakRekapitulasiAuditeeController::class, 'print'])
        ->name('cetak-auditee.print');

    Route::get('/penilaian-kinerja', [PenilaianKinerjaController::class, 'index'])
            ->name('penilaian-kinerja.index');

    Route::post('/penilaian-kinerja', [PenilaianKinerjaController::class, 'store'])
        ->name('penilaian-kinerja.store');

    Route::get('/penilaian-kinerja/{id}', [PenilaianKinerjaController::class, 'show'])
        ->name('penilaian-kinerja.show');

    Route::get('/penilaian-kinerja/{id}/edit', [PenilaianKinerjaController::class, 'edit'])
        ->name('penilaian-kinerja.edit');

    Route::put('/penilaian-kinerja/{id}', [PenilaianKinerjaController::class, 'update'])
        ->name('penilaian-kinerja.update');

    Route::delete('/penilaian-kinerja/{id}', [PenilaianKinerjaController::class, 'destroy'])
        ->name('penilaian-kinerja.destroy');

    // ==================== DATA AKREDITASI ====================
    Route::get('/data-akreditasi', [DataAkreditasiController::class, 'index'])
        ->name('data-akreditasi');
    Route::post('/data-akreditasi/store', [DataAkreditasiController::class, 'store'])
        ->name('data-akreditasi.store');
    Route::get('/data-akreditasi/{id}', [DataAkreditasiController::class, 'show'])
        ->name('data-akreditasi.show');
    Route::put('/data-akreditasi/update/{id}', [DataAkreditasiController::class, 'update'])
        ->name('data-akreditasi.update');
    Route::delete('/data-akreditasi/delete/{id}', [DataAkreditasiController::class, 'destroy'])
        ->name('data-akreditasi.delete');
    
    Route::get('/early-warning-system', [EarlyWarningSystemAdminController::class, 'index'])
        ->name('early-warning-system');
    Route::get('/sub-unit/{unit}', [EarlyWarningSystemAdminController::class, 'getSubUnit'])
        ->name('early-warning-system.sub-unit');
    Route::post('/early-warning-system', [EarlyWarningSystemAdminController::class, 'store'])
        ->name('early-warning-system.store');
    Route::get('/early-warning-system/{id}/edit', [EarlyWarningSystemAdminController::class, 'edit'])
        ->name('early-warning-system.edit');
    Route::put('/early-warning-system/{id}', [EarlyWarningSystemAdminController::class, 'update'])
        ->name('early-warning-system.update');
    Route::delete('/early-warning-system/{id}', [EarlyWarningSystemAdminController::class, 'destroy'])
        ->name('early-warning-system.destroy');

    // ==================== PROFILE PRODI ====================
    // Halaman utama
    Route::get('/identitas-prodi', [ProfileProdiController::class, 'index'])
        ->name('identitas-prodi');
    // ==================== VMTS ====================
    Route::post('/identitas-prodi/vmts', [ProfileProdiController::class, 'storeVmts'])
        ->name('identitas-prodi.vmts.store');
    Route::get('/identitas-prodi/vmts/{id}', [ProfileProdiController::class, 'showVmts'])
        ->name('identitas-prodi.vmts.show');
    Route::put('/identitas-prodi/vmts/{id}', [ProfileProdiController::class, 'updateVmts'])
        ->name('identitas-prodi.vmts.update');
    Route::delete('/identitas-prodi/vmts/{id}', [ProfileProdiController::class, 'destroyVmts'])
        ->name('identitas-prodi.vmts.destroy');
        // ==================== SOSIAL MEDIA PRODI ====================
    Route::get('/identitas-prodi/sosial-media/show', [ProdiSosialMediaController::class, 'show'])
        ->name('sosial-media.show');
    Route::get('/identitas-prodi/sosial-media/edit', [ProdiSosialMediaController::class, 'edit'])
        ->name('sosial-media.edit');
    Route::put('/identitas-prodi/sosial-media/{id}', [ProdiSosialMediaController::class, 'update'])
        ->name('sosial-media.update');
    Route::delete('/identitas-prodi/sosial-media/{id}', [ProdiSosialMediaController::class, 'destroy'])
        ->name('sosial-media.destroy');
    // ==================== DTPS ====================
    Route::post('/identitas-prodi/dtps', [ProfileProdiController::class, 'storeDtps'])
        ->name('identitas-prodi.dtps.store');
    Route::put('/identitas-prodi/dtps/{id}', [ProfileProdiController::class, 'updateDtps'])
        ->name('identitas-prodi.dtps.update');
    Route::delete('/identitas-prodi/dtps/{id}', [ProfileProdiController::class, 'destroyDtps'])
        ->name('identitas-prodi.dtps.destroy');
    // ==================== JABATAN FUNGSIONAL ====================
    Route::post('/identitas-prodi/jabatan-fungsional', [ProfileProdiController::class, 'storeJabatan'])
        ->name('identitas-prodi.jabatan.store');
    Route::put('/identitas-prodi/jabatan-fungsional', [ProfileProdiController::class, 'updateJabatan'])
        ->name('identitas-prodi.jabatan.update');
    Route::delete('/identitas-prodi/jabatan-fungsional/{id}', [ProfileProdiController::class, 'destroyJabatan'])
        ->name('identitas-prodi.jabatan.destroy');
    // ==================== MAHASISWA ====================
    Route::post('/identitas-prodi/mahasiswa', [ProfileProdiController::class, 'storeMahasiswa'])
        ->name('identitas-prodi.mahasiswa.store');
    Route::put('/identitas-prodi/mahasiswa/{id}', [ProfileProdiController::class, 'updateMahasiswa'])
        ->name('identitas-prodi.mahasiswa.update');
    Route::delete('/identitas-prodi/mahasiswa/{id}', [ProfileProdiController::class, 'destroyMahasiswa'])
        ->name('identitas-prodi.mahasiswa.destroy');
    // ==================== RASIO ====================
    Route::get('/identitas-prodi/rasio/{id}', [ProfileProdiController::class, 'getRasio'])
        ->name('identitas-prodi.rasio');
    // ==================== DOKUMEN ====================
    Route::post('/identitas-prodi/dokumen', [ProfileProdiController::class, 'storeDocument'])
        ->name('identitas-prodi.dokumen.store');
    Route::get('/identitas-prodi/dokumen/{id}', [ProfileProdiController::class, 'showDocument'])
        ->name('identitas-prodi.dokumen.show');
    Route::get('/identitas-prodi/dokumen/{id}/edit', [ProfileProdiController::class, 'editDocument'])
        ->name('identitas-prodi.dokumen.edit');
    Route::put('/identitas-prodi/dokumen/{id}', [ProfileProdiController::class, 'updateDocument'])
        ->name('identitas-prodi.dokumen.update');
    Route::delete('/identitas-prodi/dokumen/{id}', [ProfileProdiController::class, 'destroyDocument'])
        ->name('identitas-prodi.dokumen.destroy');
    // ==================== PROFILE PD DIKTI ====================
    Route::get('/profile-pd-dikti', [ProdiProfilePdDiktiController::class, 'index'])
        ->name('profile-pd-dikti');
    Route::post('/profile-pd-dikti', [ProdiProfilePdDiktiController::class, 'store'])
        ->name('profile-pd-dikti.store');
    Route::get('/profile-pd-dikti/{id}', [ProdiProfilePdDiktiController::class, 'show'])
        ->name('profile-pd-dikti.show');
    Route::put('/profile-pd-dikti/{id}', [ProdiProfilePdDiktiController::class, 'update'])
        ->name('profile-pd-dikti.update');
    Route::delete('/profile-pd-dikti/{id}', [ProdiProfilePdDiktiController::class, 'destroy'])
        ->name('profile-pd-dikti.destroy');
    // Route kegiatan benchmarking
    Route::post('/identitas-prodi/kegiatan-benchmarking', [ProdiKegiatanBenchmarkingController::class, 'store'])
        ->name('identitas-prodi.kegiatan-benchmarking.store');
    Route::put('/identitas-prodi/kegiatan-benchmarking/{id}', [ProdiKegiatanBenchmarkingController::class, 'update'])
        ->name('identitas-prodi.kegiatan-benchmarking.update');
    Route::delete('/identitas-prodi/kegiatan-benchmarking/{id}', [ProdiKegiatanBenchmarkingController::class, 'destroy'])
        ->name('identitas-prodi.kegiatan-benchmarking.destroy');
    // ==================== RASIO ====================
    Route::post('/profile-pd-dikti/rasio', [RasioController::class, 'store'])
        ->name('rasio.store');
    Route::get('/profile-pd-dikti/rasio/{id}', [RasioController::class, 'show'])
        ->name('rasio.show');
    Route::put('/profile-pd-dikti/rasio/{id}', [RasioController::class, 'update'])
        ->name('rasio.update');
    Route::delete('/profile-pd-dikti/rasio/{id}', [RasioController::class, 'destroy'])
        ->name('rasio.destroy');
    // ==================== LULUSAN ====================
    Route::post('/profile-pd-dikti/lulusan', [LulusanController::class, 'store'])
        ->name('lulusan.store');
    Route::get('/profile-pd-dikti/lulusan/{id}', [LulusanController::class, 'show'])
        ->name('lulusan.show');
    Route::put('/profile-pd-dikti/lulusan/{id}', [LulusanController::class, 'update'])
        ->name('lulusan.update');
    Route::delete('/profile-pd-dikti/lulusan/{id}', [LulusanController::class, 'destroy'])
        ->name('lulusan.destroy');
    // ==================== PROFILE SDM ====================
    Route::get('/profile-sdm', [ProfileSdmController::class, 'index'])
        ->name('profile-sdm');
    // ==================== DOSEN ====================
    Route::post('/profile-sdm/dosen', [DosenController::class, 'store'])
        ->name('dosen.store');
    Route::get('/profile-sdm/dosen/{id}', [DosenController::class, 'show'])
        ->name('dosen.show');
    Route::put('/profile-sdm/dosen/{id}', [DosenController::class, 'update'])
        ->name('dosen.update');
    Route::delete('/profile-sdm/dosen/{id}', [DosenController::class, 'destroy'])
        ->name('dosen.destroy');
    // ==================== TENDIK ====================
    Route::post('/profile-sdm/tendik', [TendikController::class, 'store'])
        ->name('tendik.store');
    Route::get('/profile-sdm/tendik/{id}', [TendikController::class, 'show'])
        ->name('tendik.show');
    Route::put('/profile-sdm/tendik/{id}', [TendikController::class, 'update'])
        ->name('tendik.update');
    Route::delete('/profile-sdm/tendik/{id}', [TendikController::class, 'destroy'])
        ->name('tendik.destroy');

    // ==================== SINTA ====================
    Route::get('/sinta/filter', [ProdiSintaController::class, 'filter'])->name('prodi.sinta.filter');
    Route::get('/sinta', [ProdiSintaController::class, 'index'])->name('sinta');
    Route::post('/sinta', [ProdiSintaController::class, 'store'])->name('sinta.store');
    Route::get('/sinta/{id}', [ProdiSintaController::class, 'show'])->name('sinta.show');
    Route::put('/sinta/{id}', [ProdiSintaController::class, 'update'])->name('sinta.update');
    Route::delete('/sinta/{id}', [ProdiSintaController::class, 'destroy'])->name('sinta.destroy');

    // ==================== PENDIDIKAN ====================
    Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan');
    // ==================== KURIKULUM (CRUD saja, tanpa index) ====================
    Route::get('/kurikulum/filter', [ProdiKurikulumController::class, 'filter'])->name('prodi.kurikulum.filter');
    Route::post('/kurikulum', [ProdiKurikulumController::class, 'store'])->name('kurikulum.store');
    Route::get('/kurikulum/{id}', [ProdiKurikulumController::class, 'show'])->name('kurikulum.show');
    Route::put('/kurikulum/{id}', [ProdiKurikulumController::class, 'update'])->name('kurikulum.update');
    Route::delete('/kurikulum/{id}', [ProdiKurikulumController::class, 'destroy'])->name('kurikulum.destroy');
    // ==================== PENGAJARAN (CRUD saja, tanpa index) ====================
    Route::get('/pengajaran/filter', [ProdiPengajaranController::class, 'filter'])->name('prodi.pengajaran.filter');
    Route::post('/pengajaran', [ProdiPengajaranController::class, 'store'])->name('pengajaran.store');
    Route::get('/pengajaran/{id}', [ProdiPengajaranController::class, 'show'])->name('pengajaran.show');
    Route::put('/pengajaran/{id}', [ProdiPengajaranController::class, 'update'])->name('pengajaran.update');
    Route::delete('/pengajaran/{id}', [ProdiPengajaranController::class, 'destroy'])->name('pengajaran.destroy');
    // ==================== BIMBINGAN (CRUD saja, tanpa index) ====================
    Route::get('/bimbingan/filter', [ProdiBimbinganController::class, 'filter'])->name('prodi.bimbingan.filter');
    Route::post('/bimbingan', [ProdiBimbinganController::class, 'store'])->name('bimbingan.store');
    Route::get('/bimbingan/{id}', [ProdiBimbinganController::class, 'show'])->name('bimbingan.show');
    Route::put('/bimbingan/{id}', [ProdiBimbinganController::class, 'update'])->name('bimbingan.update');
    Route::delete('/bimbingan/{id}', [ProdiBimbinganController::class, 'destroy'])->name('bimbingan.destroy');

    // ==================== PENELITIAN ====================
    Route::get('/sinta/filter', [ProdiSintaController::class, 'filter'])
        ->name('prodi.sinta.filter');
    Route::get('/penelitian', [PenelitianController::class, 'index'])
        ->name('penelitian');
    Route::post('/penelitian', [PenelitianController::class, 'store'])
        ->name('penelitian.store');
    Route::get('/penelitian/{id}', [PenelitianController::class, 'show'])
        ->name('penelitian.show');
    Route::put('/penelitian/{id}', [PenelitianController::class, 'update'])
        ->name('penelitian.update');
    Route::delete('/penelitian/{id}', [PenelitianController::class, 'destroy'])
        ->name('penelitian.destroy');

    // ==================== PUBLIKASI ILMIAH ====================
    Route::get('/publikasi-ilmiah/filter', [PublikasiIlmiahController::class, 'filter'])
        ->name('prodi.publikasi-ilmiah.filter');
    Route::get('/publikasi-ilmiah', [PublikasiIlmiahController::class, 'index'])
        ->name('publikasi-ilmiah');
    Route::post('/publikasi-ilmiah', [PublikasiIlmiahController::class, 'store'])
        ->name('publikasi-ilmiah.store');
    Route::get('/publikasi-ilmiah/{id}', [PublikasiIlmiahController::class, 'show'])
        ->name('publikasi-ilmiah.show');
    Route::put('/publikasi-ilmiah/{id}', [PublikasiIlmiahController::class, 'update'])
        ->name('publikasi-ilmiah.update');
    Route::delete('/publikasi-ilmiah/{id}', [PublikasiIlmiahController::class, 'destroy'])
        ->name('publikasi-ilmiah.destroy');

    // ==================== PKM (PROGRAM KREATIVITAS MAHASISWA) ====================
    Route::get('/pkm/filter', [PKMController::class, 'filter'])->name('prodi.pkm.filter');
    Route::get('/pkm', [PKMController::class, 'index'])->name('pkm');
    Route::post('/pkm', [PKMController::class, 'store'])->name('pkm.store');
    Route::get('/pkm/{id}', [PKMController::class, 'show'])->name('pkm.show');
    Route::put('/pkm/{id}', [PKMController::class, 'update'])->name('pkm.update');
    Route::delete('/pkm/{id}', [PKMController::class, 'destroy'])->name('pkm.destroy');
    Route::get('/pkm/tingkat-options', [PKMController::class, 'getTingkatOptions'])->name('prodi.pkm.tingkat-options');
    Route::get('/pkm/statistics', [PKMController::class, 'statistics'])->name('prodi.pkm.statistics');
    Route::get('/pkm/export', [PKMController::class, 'export'])->name('prodi.pkm.export');

    // ==================== INOVASI ====================
    Route::get('/inovasi/filter', [InovasiController::class, 'filter'])->name('prodi.inovasi.filter');
    Route::get('/inovasi', [InovasiController::class, 'index'])->name('inovasi');
    Route::post('/inovasi', [InovasiController::class, 'store'])->name('inovasi.store');
    Route::get('/inovasi/{id}', [InovasiController::class, 'show'])->name('inovasi.show');
    Route::put('/inovasi/{id}', [InovasiController::class, 'update'])->name('inovasi.update');
    Route::delete('/inovasi/{id}', [InovasiController::class, 'destroy'])->name('inovasi.destroy');
    Route::get('/inovasi/tahun-options', [InovasiController::class, 'getTahunAkademikOptions'])->name('prodi.inovasi.tahun-options');
    Route::get('/inovasi/statistics', [InovasiController::class, 'statistics'])->name('prodi.inovasi.statistics');
    Route::get('/inovasi/export', [InovasiController::class, 'export'])->name('prodi.inovasi.export');

    // ==================== PRESTASI AKADEMIK MAHASISWA ====================
    Route::get('/prestasi-akademik-mahasiswa/filter', [PrestasiAkademikMahasiswaController::class, 'filter'])->name('prodi.prestasi-akademik-mahasiswa.filter');
    Route::get('/prestasi-akademik-mahasiswa', [PrestasiAkademikMahasiswaController::class, 'index'])->name('prestasi-akademik-mahasiswa');
    Route::post('/prestasi-akademik-mahasiswa', [PrestasiAkademikMahasiswaController::class, 'store'])->name('prestasi-akademik-mahasiswa.store');
    Route::get('/prestasi-akademik-mahasiswa/{id}', [PrestasiAkademikMahasiswaController::class, 'show'])->name('prestasi-akademik-mahasiswa.show');
    Route::put('/prestasi-akademik-mahasiswa/{id}', [PrestasiAkademikMahasiswaController::class, 'update'])->name('prestasi-akademik-mahasiswa.update');
    Route::delete('/prestasi-akademik-mahasiswa/{id}', [PrestasiAkademikMahasiswaController::class, 'destroy'])->name('prestasi-akademik-mahasiswa.destroy');
    Route::get('/prestasi-akademik-mahasiswa/tahun-options', [PrestasiAkademikMahasiswaController::class, 'getTahunAkademikOptions'])->name('prodi.prestasi-akademik-mahasiswa.tahun-options');
    Route::get('/prestasi-akademik-mahasiswa/tingkat-options', [PrestasiAkademikMahasiswaController::class, 'getTingkatOptions'])->name('prodi.prestasi-akademik-mahasiswa.tingkat-options');
    Route::get('/prestasi-akademik-mahasiswa/statistics', [PrestasiAkademikMahasiswaController::class, 'statistics'])->name('prodi.prestasi-akademik-mahasiswa.statistics');
    Route::get('/prestasi-akademik-mahasiswa/export', [PrestasiAkademikMahasiswaController::class, 'export'])->name('prodi.prestasi-akademik-mahasiswa.export');
    
    // ==================== SARPRAS PRODI ====================
    Route::get('/sarpras', [SarprasProdiController::class, 'index'])->name('sarpras');
    Route::get('/sarpras/data', [SarprasProdiController::class, 'data'])->name('sarpras.data');
    Route::post('/sarpras', [SarprasProdiController::class, 'store'])->name('sarpras.store');
    Route::get('/sarpras/{sarpras}/view', [SarprasProdiController::class, 'viewFile'])->name('sarpras.view');
    Route::get('/sarpras/{sarpras}', [SarprasProdiController::class, 'show'])->name('sarpras.show');
    Route::put('/sarpras/{sarpras}', [SarprasProdiController::class, 'update'])->name('sarpras.update');
    Route::delete('/sarpras/{sarpras}', [SarprasProdiController::class, 'destroy'])->name('sarpras.destroy');
});

Route::middleware(['auth', 'role:fakultas'])
    ->prefix('fakultas')
    ->name('fakultas.')
    ->group(function () {

    // Dashboard Fakultas
    Route::get('/dashboard', [DashboardController::class, 'fakultas'])
        ->name('dashboard');

    Route::get('/notifications', [DashboardController::class, 'getFakultasNotifications'])
        ->name('notifications');
        
    // ==================== IDENTITAS FAKULTAS (HALAMAN UTAMA) ====================
    Route::get('/identitas-fakultas', [ProfileFakultasController::class, 'index'])
        ->name('identitas-fakultas');

    // ==================== VMTS ====================
    Route::post('/identitas-fakultas/vmts', [ProfileFakultasController::class, 'storeVmts'])
        ->name('identitas-fakultas.vmts.store');
    Route::get('/identitas-fakultas/vmts/{id}', [ProfileFakultasController::class, 'showVmts'])
        ->name('identitas-fakultas.vmts.show');
    Route::put('/identitas-fakultas/vmts/{id}', [ProfileFakultasController::class, 'updateVmts'])
        ->name('identitas-fakultas.vmts.update');
    Route::delete('/identitas-fakultas/vmts/{id}', [ProfileFakultasController::class, 'destroyVmts'])
        ->name('identitas-fakultas.vmts.destroy');

    Route::delete('/identitas-fakultas/dokumen/{id}', [ProfileFakultasController::class, 'destroyDocument'])
        ->name('identitas-fakultas.dokumen.destroy');
    
    // ==================== DTPS ====================
    Route::post('/identitas-fakultas/dtps', [ProfileFakultasController::class, 'storeDtps'])
        ->name('identitas-fakultas.dtps.store');
    Route::put('/identitas-fakultas/dtps/{id}', [ProfileFakultasController::class, 'updateDtps'])
        ->name('identitas-fakultas.dtps.update');
    Route::delete('/identitas-fakultas/dtps/{id}', [ProfileFakultasController::class, 'destroyDtps'])
        ->name('identitas-fakultas.dtps.destroy');
    
    // ==================== JABATAN FUNGSIONAL ====================
    Route::post('/identitas-fakultas/jabatan-fungsional', [ProfileFakultasController::class, 'storeJabatan'])
        ->name('identitas-fakultas.jabatan.store');
    Route::put('/identitas-fakultas/jabatan-fungsional/{id}', [ProfileFakultasController::class, 'updateJabatan'])
        ->name('identitas-fakultas.jabatan.update');
    Route::delete('/identitas-fakultas/jabatan-fungsional/{id}', [ProfileFakultasController::class, 'destroyJabatan'])
        ->name('identitas-fakultas.jabatan.destroy');
    
    // ==================== MAHASISWA ====================
    Route::post('/identitas-fakultas/mahasiswa', [ProfileFakultasController::class, 'storeMahasiswa'])
        ->name('identitas-fakultas.mahasiswa.store');
    Route::put('/identitas-fakultas/mahasiswa/{id}', [ProfileFakultasController::class, 'updateMahasiswa'])
        ->name('identitas-fakultas.mahasiswa.update');
    Route::delete('/identitas-fakultas/mahasiswa/{id}', [ProfileFakultasController::class, 'destroyMahasiswa'])
        ->name('identitas-fakultas.mahasiswa.destroy');
    
    // ==================== RASIO ====================
    Route::get('/identitas-fakultas/rasio/{id}', [ProfileFakultasController::class, 'getRasio'])
        ->name('identitas-fakultas.rasio');
    
    // ==================== DOKUMEN ====================
    Route::post('/identitas-fakultas/dokumen', [ProfileFakultasController::class, 'storeDocument'])
        ->name('identitas-fakultas.dokumen.store');
    Route::get('/identitas-fakultas/dokumen/{id}', [ProfileFakultasController::class, 'showDocument'])
        ->name('identitas-fakultas.dokumen.show');
    Route::get('/identitas-fakultas/dokumen/{id}/edit', [ProfileFakultasController::class, 'editDocument'])
        ->name('identitas-fakultas.dokumen.edit');
    Route::put('/identitas-fakultas/dokumen/{id}', [ProfileFakultasController::class, 'updateDocument'])
        ->name('identitas-fakultas.dokumen.update');
    Route::delete('/identitas-fakultas/dokumen/{id}', [ProfileFakultasController::class, 'destroyDocument'])
        ->name('identitas-fakultas.dokumen.destroy');
    
    // ==================== PROFILE PD DIKTI ====================
    Route::get('/profile-pd-dikti', [FakultasProfilePdDiktiController::class, 'index'])->name('profile-pd-dikti');
    Route::post('/profile-pd-dikti', [FakultasProfilePdDiktiController::class, 'store'])->name('profile-pd-dikti.store');
    Route::get('/profile-pd-dikti/{id}', [FakultasProfilePdDiktiController::class, 'show'])->name('profile-pd-dikti.show');
    Route::put('/profile-pd-dikti/{id}', [FakultasProfilePdDiktiController::class, 'update'])->name('profile-pd-dikti.update');
    Route::delete('/profile-pd-dikti/{id}', [FakultasProfilePdDiktiController::class, 'destroy'])->name('profile-pd-dikti.destroy');

    // ==================== MAHASISWA PD DIKTI ====================
    Route::post('/profile-pd-dikti/mahasiswa', [FakultasProfilePdDiktiController::class, 'store'])
        ->name('profile-pd-dikti.mahasiswa.store');
    Route::get('/profile-pd-dikti/mahasiswa/{id}', [FakultasProfilePdDiktiController::class, 'show'])
        ->name('profile-pd-dikti.mahasiswa.show');
    Route::put('/profile-pd-dikti/mahasiswa/{id}', [FakultasProfilePdDiktiController::class, 'update'])
        ->name('profile-pd-dikti.mahasiswa.update');
    Route::delete('/profile-pd-dikti/mahasiswa/{id}', [FakultasProfilePdDiktiController::class, 'destroy'])
        ->name('profile-pd-dikti.mahasiswa.destroy');

    // ==================== RASIO DOSEN MAHASISWA ====================
    Route::post('/profile-pd-dikti/rasio', [FakultasProfilePdDiktiController::class, 'storeRasio'])
        ->name('profile-pd-dikti.rasio.store');
    Route::get('/profile-pd-dikti/rasio/{id}', [FakultasProfilePdDiktiController::class, 'showRasio'])
        ->name('profile-pd-dikti.rasio.show');
    Route::put('/profile-pd-dikti/rasio/{id}', [FakultasProfilePdDiktiController::class, 'updateRasio'])
        ->name('profile-pd-dikti.rasio.update');
    Route::delete('/profile-pd-dikti/rasio/{id}', [FakultasProfilePdDiktiController::class, 'destroyRasio'])
        ->name('profile-pd-dikti.rasio.destroy');

    // ==================== DATA LULUSAN ====================
    Route::post('/profile-pd-dikti/lulusan', [FakultasProfilePdDiktiController::class, 'storeLulusan'])
        ->name('profile-pd-dikti.lulusan.store');
    Route::get('/profile-pd-dikti/lulusan/{id}', [FakultasProfilePdDiktiController::class, 'showLulusan'])
        ->name('profile-pd-dikti.lulusan.show');
    Route::put('/profile-pd-dikti/lulusan/{id}', [FakultasProfilePdDiktiController::class, 'updateLulusan'])
        ->name('profile-pd-dikti.lulusan.update');
    Route::delete('/profile-pd-dikti/lulusan/{id}', [FakultasProfilePdDiktiController::class, 'destroyLulusan'])
        ->name('profile-pd-dikti.lulusan.destroy');
    
    // ==================== PROFILE SDM ====================
    Route::get('/profile-sdm', [FakultasProfileSdmController::class, 'index'])
        ->name('profile-sdm');
    // -------------------- DOSEN --------------------
    Route::get('/profile-sdm/dosen/{dosen}', [FakultasProfileSdmController::class, 'showDosen'])
        ->name('profile-sdm.dosen.show');
    Route::post('/profile-sdm/dosen', [FakultasProfileSdmController::class, 'storeDosen'])
        ->name('profile-sdm.dosen.store');
    Route::put('/profile-sdm/dosen/{dosen}', [FakultasProfileSdmController::class, 'updateDosen'])
        ->name('profile-sdm.dosen.update');
    Route::delete('/profile-sdm/dosen/{dosen}', [FakultasProfileSdmController::class, 'destroyDosen'])
        ->name('profile-sdm.dosen.destroy');
    // -------------------- TENDIK --------------------
    Route::get('/profile-sdm/tendik/{tendik}', [FakultasProfileSdmController::class, 'showTendik'])
        ->name('profile-sdm.tendik.show');
    Route::post('/profile-sdm/tendik', [FakultasProfileSdmController::class, 'storeTendik'])
        ->name('profile-sdm.tendik.store');
    Route::put('/profile-sdm/tendik/{tendik}', [FakultasProfileSdmController::class, 'updateTendik'])
        ->name('profile-sdm.tendik.update');
    Route::delete('/profile-sdm/tendik/{tendik}', [FakultasProfileSdmController::class, 'destroyTendik'])
        ->name('profile-sdm.tendik.destroy');

    // Route untuk Fakultas SARPRAS
    Route::get('/sarpras', [App\Http\Controllers\Fakultas\SarprasFakultasController::class, 'index'])
        ->name('sarpras');
    Route::get('/sarpras/data', [App\Http\Controllers\Fakultas\SarprasFakultasController::class, 'data'])
        ->name('sarpras.data');
    Route::post('/sarpras', [App\Http\Controllers\Fakultas\SarprasFakultasController::class, 'store'])
        ->name('sarpras.store');
    Route::get('/sarpras/{sarpras}', [App\Http\Controllers\Fakultas\SarprasFakultasController::class, 'show'])
        ->name('sarpras.show');
    Route::put('/sarpras/{sarpras}', [App\Http\Controllers\Fakultas\SarprasFakultasController::class, 'update'])
        ->name('sarpras.update');
    Route::delete('/sarpras/{sarpras}', [App\Http\Controllers\Fakultas\SarprasFakultasController::class, 'destroy'])
        ->name('sarpras.destroy');
    Route::get('/sarpras/{sarpras}/download', [App\Http\Controllers\Fakultas\SarprasFakultasController::class, 'downloadFile'])
        ->name('sarpras.download');

    // ==================== PENDIDIKAN (View Only dari Prodi) ====================
    Route::get('/pendidikan', [FakultasPendidikanController::class, 'index'])->name('pendidikan');
    // ==================== SINTA (View Only dari Prodi) ====================
    Route::get('/sinta', [FakultasSintaController::class, 'index'])->name('sinta');
    // ==================== PENELITIAN (View Only dari Prodi) ====================
    Route::get('/penelitian', [FakultasPenelitianController::class, 'index'])->name('penelitian');
    // ==================== PUBLIKASI ILMIAH (View Only dari Prodi) ====================
    Route::get('/publikasi-ilmiah', [FakultasPublikasiIlmiahController::class, 'index'])->name('publikasi-ilmiah');
    // ==================== PKM (View Only dari Prodi) ====================
    Route::get('/pkm', [FakultasPkmController::class, 'index'])->name('pkm');
    // ==================== INOVASI (View Only dari Prodi) ====================
    Route::get('/inovasi', [FakultasInovasiController::class, 'index'])->name('inovasi');
    // ==================== PRESTASI AKADEMIK MAHASISWA (View Only dari Prodi) ====================
    Route::get('/prestasi-akademik-mahasiswa', [FakultasPrestasiAkademikMahasiswaController::class, 'index'])->name('prestasi-akademik-mahasiswa');


    // ==================== HASIL AUDIT ====================
    Route::prefix('hasil-audit')->name('hasil-audit.')->group(function () {
        Route::get('/daftar-periksa', [FakultasHasilAuditDaftarPeriksaController::class, 'index'])->name('daftar-periksa');
        Route::get('/daftar-periksa/filter', [FakultasHasilAuditDaftarPeriksaController::class, 'filter'])->name('daftar-periksa.filter');
        Route::get('/daftar-periksa/print', [FakultasHasilAuditDaftarPeriksaController::class, 'print'])->name('daftar-periksa.print');

        Route::get('/ptk', [FakultasHasilAuditPtkController::class, 'index'])->name('ptk');
        Route::get('/ptk/filter', [FakultasHasilAuditPtkController::class, 'filter'])->name('ptk.filter');
        Route::get('/ptk/print', [FakultasHasilAuditPtkController::class, 'print'])->name('ptk.print');

        Route::get('/observasi', [FakultasHasilAuditObservasiController::class, 'index'])->name('observasi');
        Route::get('/observasi/filter', [FakultasHasilAuditObservasiController::class, 'filter'])->name('observasi.filter');
        Route::get('/observasi/print', [FakultasHasilAuditObservasiController::class, 'print'])->name('observasi.print');

        Route::get('/terpenuhi', [FakultasHasilAuditTerpenuhiController::class, 'index'])->name('terpenuhi');
        Route::get('/terpenuhi/filter', [FakultasHasilAuditTerpenuhiController::class, 'filter'])->name('terpenuhi.filter');
        Route::get('/terpenuhi/print', [FakultasHasilAuditTerpenuhiController::class, 'print'])->name('terpenuhi.print');

        Route::get('/rekapitulasi', [FakultasHasilAuditRekapitulasiController::class, 'index'])->name('rekapitulasi');
        Route::get('/rekapitulasi/filter', [FakultasHasilAuditRekapitulasiController::class, 'filter'])->name('rekapitulasi.filter');
        Route::get('/rekapitulasi/print', [FakultasHasilAuditRekapitulasiController::class, 'print'])->name('rekapitulasi.print');
    });

});

// profile pages
Route::get('/profile', function () {
    return view('pages.profile', ['title' => 'Profile']);
})->name('profile');
Route::post('/profile/update', [ProfileController::class, 'update'])
    ->name('profile.update')
    ->middleware('auth');
Route::post('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])
->name('profile.delete-photo');

// pages

Route::get('/blank', function () {
    return view('pages.blank', ['title' => 'Blank']);
})->name('blank');

// authentication pages
Route::get('/signin', function () {
    return view('pages.auth.signin', ['title' => 'Sign In']);
})->name('signin');

Route::get('/signup', function () {
    return view('pages.auth.signup', ['title' => 'Sign Up']);
})->name('signup');

