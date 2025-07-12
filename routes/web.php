<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BiroController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\StrukturOrganisasiController; 
use Illuminate\Support\Facades\Auth;

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
        Route::resource('/artikel', ArtikelController::class);
        Route::resource('/alumni', AlumniController::class);
        Route::resource('/struktur-organisasi', StrukturOrganisasiController::class);
        Route::resource('/galeri', GaleriController::class);
        Route::resource('/biro', BiroController::class);
        // Route::get('/download/{filename}', [SiswaController::class, 'downloadFormatUpload']);
    }
);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
