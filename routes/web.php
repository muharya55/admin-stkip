<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BiroController;
use App\Http\Controllers\BukuPanduanController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrmawaController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilitiesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect('/home');
});
Route::middleware('auth')->group(
    function () {
        Route::resource('/home', HomeController::class);
        Route::resource('/artikel', ArtikelController::class)->except(['show']);
        Route::resource('/alumni', AlumniController::class)->except(['show']);
        Route::resource('/struktur-organisasi', StrukturOrganisasiController::class)->except(['show']);
        Route::resource('/galeri', GaleriController::class)->except(['show']);
        Route::resource('/biro', BiroController::class)->except(['show']);
        Route::resource('/prodi', ProdiController::class)->except(['show']);
        Route::resource('/fakultas', FakultasController::class)->except(['show']);
        Route::resource('/kalender-akademik', KalenderAkademikController::class)->except(['show']);
        Route::resource('/buku-panduan', BukuPanduanController::class)->except(['show']);
        Route::resource('/utilities', UtilitiesController::class)->except(['show']);
        Route::resource('/contact', ContactController::class)->except(['show']);
        Route::resource('/ormawa', OrmawaController::class)->except(['show']);
        Route::resource('/ukm', UkmController::class)->except(['show']);
        Route::resource('/download', DownloadController::class)->except(['show']);
        Route::resource('/user', UserController::class)->except(['show']);
        //aa
        // Route::get('documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
        // Route::get('/download/{filename}', [SiswaController::class, 'downloadFormatUpload']);
    }
);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
