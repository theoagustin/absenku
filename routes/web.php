<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginApkController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AjaxController;

Route::get('/', function () {
    return view('home');
});

//route resource
Route::get('google-autocomplete', [GoogleController::class, 'index']);
Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
Route::resource('/redirect', \App\Http\Controllers\RedirectController::class);
Route::resource('/home', \App\Http\Controllers\HomeController::class);
Route::resource('/admin', \App\Http\Controllers\AdminController::class);
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('loginapk', [LoginApkController::class, 'loginapk'])->name('loginapk');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//Route::resource('/login', \App\Http\Controllers\LoginController::class);

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('actionregister', [RegisterController::class, 'actionregister'])->name('actionregister');
Route::resource('/posts', \App\Http\Controllers\PostController::class);
Route::resource('/perusahaan', \App\Http\Controllers\PerusahaanController::class);
Route::get('/perusahaan-approve', [PerusahaanController::class, 'perusahaan_approve'])->name('perusahaan_approve');
Route::post('/perusahaan/saveBagian', [PerusahaanController::class,'saveBagian'])->name('perusahaan.saveBagian');
Route::post('/perusahaan/savePosisi', [PerusahaanController::class,'savePosisi'])->name('perusahaan.savePosisi');
Route::resource('/bagian', \App\Http\Controllers\BagianController::class);

Route::resource('/posisi', \App\Http\Controllers\PosisiController::class);

Route::resource('/karyawan', \App\Http\Controllers\KaryawanController::class);
Route::resource('/akunkaryawan', \App\Http\Controllers\AkunKaryawanController::class);
Route::resource('/absensi', \App\Http\Controllers\AbsensiController::class);
Route::resource('/cuti', \App\Http\Controllers\CutiController::class);
Route::resource('/idcard', \App\Http\Controllers\IdCardController::class);
Route::resource('/profile', \App\Http\Controllers\ProfileController::class);
Route::resource('/history', \App\Http\Controllers\HistoryController::class);
Route::resource('/lapabsensi', \App\Http\Controllers\LapAbsensiController::class);
Route::resource('/rekapabsen', \App\Http\Controllers\RekapAbsenController::class);

//Route::post('/absensi/absen', [AbsensiController::class,'absen'])->name('absensi.absen');
Route::resource('/absensikehadiran', \App\Http\Controllers\AbsensiKehadiranController::class);
//Route::get('/get-bagian/{id_perusahaan}', 'ListBagianController@getBagian');

Route::get('bagian/{id_perusahaan}', [BagianController::class, 'getPerusahaan']);

//REQUEST AJAX
Route::get('ajaxRequest', [AjaxController::class, 'ajaxRequest']);
Route::post('ajaxRequest', [AjaxController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');

Route::get('/dashboard', [PerusahaanController::class, 'dashboard'])->name('dashboard');

use App\Http\Controllers\ShiftController;

// Rute untuk Shift
Route::resource('shifts', ShiftController::class);

use App\Http\Controllers\ShiftKaryawanController;

// Rute untuk Shift Karyawan
Route::resource('shift_karyawan', ShiftKaryawanController::class);

use App\Http\Controllers\AbsensiReportController;
Route::get('/absensi-report', [AbsensiReportController::class, 'index'])->name('absensi.report');
Route::get('/absensi-detail/{id}', [AbsensiReportController::class, 'detail'])->name('absensi.detail');

Route::get('/profil-perusahaan', [PerusahaanController::class, 'edit_perusahaan'])->name('perusahaan.edit_perusahaan');
Route::post('/profil-perusahaan', [PerusahaanController::class, 'update_perusahaan'])->name('perusahaan.update_perusahaan');

use App\Http\Controllers\CutiAdminController;

Route::get('/cuti-admin', [CutiAdminController::class, 'index'])->name('cuti.index_admin');

use App\Http\Controllers\LemburController;

Route::prefix('lembur')->group(function () {
    Route::get('/', [LemburController::class, 'index'])->name('lembur.index');
    Route::get('/create', [LemburController::class, 'create'])->name('lembur.create');
    Route::post('/', [LemburController::class, 'store'])->name('lembur.store');
    Route::get('/{id}/edit', [LemburController::class, 'edit'])->name('lembur.edit');
    Route::put('/{id}', [LemburController::class, 'update'])->name('lembur.update');
    Route::delete('/{id}', [LemburController::class, 'destroy'])->name('lembur.destroy');
});

Route::post('/cuti/{id}/approve', [CutiAdminController::class, 'approve'])->name('cuti.approve');
Route::post('/cuti/{id}/reject', [CutiAdminController::class, 'reject'])->name('cuti.reject');
Route::get('/absensi-export', [AbsensiReportController::class, 'export'])->name('absensi.export');
Route::get('/lembur-export', [LemburController::class, 'export'])->name('lembur.export');

Route::get('/absensi-rekap', [AbsensiController::class, 'index_rekap'])->name('absensi.index_rekap');
Route::post('/absensi-rekap/update', [AbsensiController::class, 'update_rekap'])->name('absensi.update_rekap');
Route::post('/absensi/update-rekap', [AbsensiController::class, 'updateRekap'])->name('absensi.updateRekap');
