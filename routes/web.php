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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// dashboard pages
Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard', [
        'title' => 'Dashboard | SIMANTAP'
    ]);
})->middleware('auth')->name('dashboard');

// calender pages
Route::get('/calendar', function () {
    return view('pages.calender', ['title' => 'Calendar']);
})->name('calendar');

// profile pages
Route::get('/profile', function () {
    return view('pages.profile', ['title' => 'Profile']);
})->name('profile');
Route::post('/profile/update', [ProfileController::class, 'update'])
    ->name('profile.update')
    ->middleware('auth');
Route::post('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])
->name('profile.delete-photo');

// form pages
Route::get('/form-elements', function () {
    return view('pages.form.form-elements', ['title' => 'Form Elements']);
})->name('form-elements');

// tables pages
Route::get('/basic-tables', function () {
    return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
})->name('basic-tables');

// pages

Route::get('/blank', function () {
    return view('pages.blank', ['title' => 'Blank']);
})->name('blank');

// error pages
Route::get('/error-404', function () {
    return view('pages.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');

// chart pages
Route::get('/line-chart', function () {
    return view('pages.chart.line-chart', ['title' => 'Line Chart']);
})->name('line-chart');

Route::get('/bar-chart', function () {
    return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
})->name('bar-chart');


// authentication pages
Route::get('/signin', function () {
    return view('pages.auth.signin', ['title' => 'Sign In']);
})->name('signin');

Route::get('/signup', function () {
    return view('pages.auth.signup', ['title' => 'Sign Up']);
})->name('signup');

// ui elements pages
Route::get('/alerts', function () {
    return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
})->name('alerts');

Route::get('/avatars', function () {
    return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
})->name('avatars');

Route::get('/badge', function () {
    return view('pages.ui-elements.badges', ['title' => 'Badges']);
})->name('badges');

Route::get('/buttons', function () {
    return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
})->name('buttons');

Route::get('/image', function () {
    return view('pages.ui-elements.images', ['title' => 'Images']);
})->name('images');

Route::get('/videos', function () {
    return view('pages.ui-elements.videos', ['title' => 'Videos']);
})->name('videos');

Route::prefix('others')->group(function () {

    Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');

    Route::get('/pengguna/filter', [UserController::class, 'filterData'])->name('pengguna.filter');

    Route::post('/pengguna/store', [UserController::class, 'store'])->name('pengguna.store');

    Route::get('/pengguna/{id}', [UserController::class, 'show'])->name('pengguna.show');

    Route::post('/pengguna/update/{id}', [UserController::class, 'update'])->name('pengguna.update');

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
Route::post('/data-auditor/delete/{id}', [DataAuditorController::class, 'destroy'])
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
Route::post('/setting-tahun-akademik/delete/{id}', [TahunAkademikController::class, 'destroy'])
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