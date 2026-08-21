<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DashboardController;


Route::get('/', [GuestController::class, 'index']);

// Route::middleware([LoginMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/tambah-data', [DashboardController::class, 'tambahData'])->name('add-resident');
    Route::post('/tambah-data', [DashboardController::class, 'storeData'])->name('store-resident');
    Route::get('/amibl-template', [DashboardController::class, 'downloadTemplate'])->name('download-template');
    Route::post('/import-data', [DashboardController::class, 'importData'])->name('import-data');
    

    Route::get('/update-data', [DashboardController::class, 'updateData'])->name('update-resident');
    Route::get('/data-warga', [DashboardController::class, 'listResident'])->name('list-resident');
    
    Route::get('/logout', [GuestController::class, 'logout'])->name('logout');
// });
Route::get('/login', [GuestController::class, 'loginPage']);
Route::post('/login', [GuestController::class, 'login'])->name('login');
