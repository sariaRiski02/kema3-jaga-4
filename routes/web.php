<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index']);


Route::get('/dashboard', [DashboardController::class, 'index']);
