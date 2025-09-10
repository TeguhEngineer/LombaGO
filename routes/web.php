<?php

use App\Http\Controllers\CreateSoalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KerjakanSoalController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SetJuaraController;
use App\Http\Controllers\TglMulaiCoontroller;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/soal', function () {
//     return view('soal.index');
// });

// all role
Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/identitas', [HomeController::class, 'upload_identitas'])->name('upload.identitas');
Route::post('/profile', [HomeController::class, 'upload_profile'])->name('upload.profile');
Route::post('/update_profile', [HomeController::class, 'update_profile'])->name('update.profile');
Route::delete('/delete_profile', [HomeController::class, 'delete_profile'])->name('delete.profile');
Route::post('/password_reset', [HomeController::class, 'password_reset'])->name('reset.password');

Route::middleware(RoleMiddleware::class. ':user')->group(function () {
   Route::get('/soal', [KerjakanSoalController::class, 'index'])->name('soal'); 
   Route::post('/kerjakan', [KerjakanSoalController::class, 'mengerjakan'])->name('kerjakan'); 
   Route::post('/upload/{jawabanId}', [KerjakanSoalController::class, 'uploadJawaban'])->name('upload.jawaban'); 
});

// superadmin
Route::middleware(RoleMiddleware::class . ':superadmin')->group(function () {
    Route::resource('/peserta', PesertaController::class);
    Route::put('/resetpassword/{id}', [PesertaController::class, 'reset_password'])->name('password.reset');
    Route::resource('/create-soal', CreateSoalController::class);
    Route::post('/tgl_mulai', [TglMulaiCoontroller::class, 'tgl_mulai'])->name('tgl.mulai');
    Route::post('/tgl_mulai/{id}', [TglMulaiCoontroller::class, 'update_tgl_mulai'])->name('tgl.updateorcreate');
    Route::get('/jawaban', [JawabanController::class, 'index']);
    Route::get('/download-jawaban/{userId}', [JawabanController::class, 'download_jawaban_zip'])->name('download.jawaban');
    Route::post('/jawaban/reset', [JawabanController::class, 'resetJawaban'])->name('jawaban.reset');
    Route::resource('/set_juara', SetJuaraController::class);
    Route::resource('/informasi', InformasiController::class);
});
