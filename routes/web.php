<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [GuestController::class, 'index']);

Route::middleware(LoginMiddleware::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
    Route::get('/dashboard/export', [DashboardController::class, 'exportDashboard'])->name('dashboard.export');
    
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
    Route::get('/daftar-keluarga/export', [DashboardController::class, 'exportAllFamily'])->name('dashboard.export-all-family');
    Route::get('/keluarga/{family:family_number}', [FamilyController::class, 'show'])->name('dashboard.show-family');
    Route::get('/keluarga/{family:family_number}/export', [FamilyController::class, 'export'])->name('dashboard.export-family');
    Route::get('/keluarga/{family:family_number}/edit', [FamilyController::class, 'edit'])->name('dashboard.edit-family');
});

Route::get('/login', [GuestController::class, 'loginPage'])->name('login');
Route::post('/login', [GuestController::class, 'login']);
Route::get('/logout', [GuestController::class, 'logout'])->name('logout');
