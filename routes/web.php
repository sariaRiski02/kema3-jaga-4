<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DashboardController;

Route::get('/', [GuestController::class, 'index']);


Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/download-warga', [DashboardController::class, 'download_all'])->name('download-warga');
