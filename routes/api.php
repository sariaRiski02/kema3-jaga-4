<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/resident', [ApiController::class, 'getAllResident']);
Route::delete('/resident/{id}', [ApiController::class, 'delete']);
