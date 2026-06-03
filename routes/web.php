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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// dashboard pages
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    Route::prefix('others')->group(function () {

        Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');

        Route::get('/pengguna/filter', [UserController::class, 'filterData'])->name('pengguna.filter');

        Route::post('/pengguna/store', [UserController::class, 'store'])->name('pengguna.store');

        Route::get('/pengguna/{id}', [UserController::class, 'show'])->name('pengguna.show');

        Route::put('/pengguna/update/{id}', [UserController::class, 'update'])->name('pengguna.update');

        Route::post('/pengguna/delete/{id}', [UserController::class, 'destroy'])->name('pengguna.delete');

    });

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
});

Route::middleware(['auth', 'role:auditor,unit_kerja'])
    ->prefix('auditor')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'auditor'])
        ->name('auditor.dashboard');

    Route::get('/isi-data-auditiee', [IsiDataAuditieeController::class, 'index'])
        ->name('isi-data-auditiee');

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

    Route::post('/form-observasi/store', [FormObservasiController::class, 'store'])
        ->name('form-observasi.store');

    Route::get('/form-observasi/{id}/edit', [FormObservasiController::class, 'edit'])
        ->name('form-observasi.edit');

    Route::put('/form-observasi/{id}', [FormObservasiController::class, 'update'])
        ->name('form-observasi.update');

    Route::delete('/form-observasi/{id}', [FormObservasiController::class, 'destroy'])
        ->name('form-observasi.destroy');

    Route::get('/cetak-rekapitulasi-ami', [CetakRekapitulasiController::class, 'index'])->name('cetak-ami.index');
    Route::get('/cetak-rekapitulasi-ami/data', [CetakRekapitulasiController::class, 'getData'])->name('cetak-ami.data');
    Route::get('/cetak-rekapitulasi-ami/print', [CetakRekapitulasiController::class, 'print'])->name('cetak-ami.print');

});

Route::middleware(['auth', 'role:prodi'])
    ->prefix('prodi')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'prodi'])
        ->name('prodi.dashboard');

    Route::get('/data-auditee', [DataAuditeeController::class, 'index'])
        ->name('data-auditee.index');

    Route::get('/daftar-periksa', [AuditeeDaftarPeriksaController::class, 'index'])
        ->name('daftar-periksa.index');

    Route::get('/form-ptk', [FormPtkController::class, 'index'])
        ->name('auditee.form-ptk.index');

    Route::put('/form-ptk/{id}', [FormPtkController::class, 'update'])
        ->name('auditee.form-ptk.update');

    Route::get('/observasi', [AuditeeObservasiController::class, 'index'])
        ->name('auditee.observasi');

    Route::get('/cetak-rekapitulasi-ami', function () {
        return 'Halaman Cetak Rekapitulasi';
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

