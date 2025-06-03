<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/resident', [ApiController::class, 'getAllResident']);
Route::get('/resident/see/{id}', [ApiController::class, 'see']);
Route::get('/resident/search', [ApiController::class, 'search']);
Route::delete('/resident/{id}', [ApiController::class, 'delete']);
