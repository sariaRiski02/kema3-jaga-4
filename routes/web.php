<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
});
