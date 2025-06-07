<?php

use App\Models\Kk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::get('/resident', [ApiController::class, 'getAllResident']);
Route::get('/resident/see/{id}', [ApiController::class, 'see']);
Route::get('/resident/search', [ApiController::class, 'search']);
Route::delete('/resident/{id}', [ApiController::class, 'delete']);

Route::post('/resident', [ApiController::class, 'store'])->name('store');
Route::post('/no_kk', [ApiController::class, 'search_kk']);
