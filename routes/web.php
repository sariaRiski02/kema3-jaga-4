<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DashboardController;


Route::get('/', [GuestController::class, 'index']);

// Route::middleware([LoginMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
    
    // ResidentController
    Route::get('/daftar-warga', [DashboardController::class, 'listResident'])->name('dashboard.list-resident');
    Route::get('/warga/{resident:nik}/', [DashboardController::class, 'showResident'])->name('dashboard.show-resident');
    Route::get('/export-warga/{resident:nik}', [DashboardController::class, 'exportResident'])->name('dashboard.export-resident');
    Route::get('/tambah-warga', [DashboardController::class, 'addResident'])->name('dashboard.add-resident');
    Route::post('/tambah-warga', [DashboardController::class, 'storeResident'])->name('dashboard.store-resident');
    Route::get('/update-warga/{resident:nik}', [DashboardController::class, 'editResident'])->name('dashboard.edit-resident');
    Route::put('/update-warga/{resident:nik}', [DashboardController::class, 'updateResident'])->name('dashboard.update-resident');
    Route::get('/daftar-warga/export', [DashboardController::class, 'exportAllResident'])->name('dashboard.export-all-resident');
    Route::delete('/delete-warga/{resident:nik}', [DashboardController::class, 'deleteResident'])->name('dashboard.delete-resident');
    
    Route::delete('/dashboard/residents/bulk-delete', [DashboardController::class, 'bulkDestroy'])
        ->name('dashboard.bulk-delete-resident');
    


    Route::get('/import-resident', [DashboardController::class, 'importResident'])->name('dashboard.import-resident');
    Route::post('/import-resident', [DashboardController::class, 'storeImportResident'])->name('dashboard.store-import-resident');
    Route::get('/download-template', [DashboardController::class, 'downloadTemplate'])->name('dashboard.download-template');
    
    Route::get('/tambah-keluarga', [DashboardController::class, 'addFamily'])->name('dashboard.add-family');
    Route::get('/daftar-keluarga', [DashboardController::class, 'listFamily'])->name('dashboard.list-family');
    
    Route::get('/logout', [GuestController::class, 'logout'])->name('logout');

    
// });
Route::get('/login', [GuestController::class, 'loginPage']);
Route::post('/login', [GuestController::class, 'login'])->name('login');
