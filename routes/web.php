<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DashboardController;


Route::get('/', [GuestController::class, 'index']);

// Route::middleware([LoginMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tambah-data', [DashboardController::class, 'tambahData'])->name('tambah-data');
    Route::get('/data-warga', [DashboardController::class, 'listResident'])->name('list-resident');
    Route::get('/download-warga', [DashboardController::class, 'download_all'])->name('download-warga');
    Route::get('/logout', [GuestController::class, 'logout'])->name('logout');
// });
Route::get('/login', [GuestController::class, 'loginPage']);
Route::post('/login', [GuestController::class, 'login'])->name('login');
