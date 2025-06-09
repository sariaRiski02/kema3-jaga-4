<?php

use App\Models\Kk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::get('/resident', [ApiController::class, 'getAllResident']);
Route::put('/resident/{id}', [ApiController::class, 'update']);
Route::get('/resident/{id}', [ApiController::class, 'see']);
Route::get('/search', [ApiController::class, 'search']);
Route::delete('/resident/{id}', [ApiController::class, 'delete']);

Route::post('/resident', [ApiController::class, 'store'])->name('store');
Route::post('/no_kk', [ApiController::class, 'search_kk']);
Route::post('/import-excel', [App\Http\Controllers\ApiController::class, 'importExcel']);
Route::get('/template-warga', function () {
    return response()->download(public_path('template_warga.xlsx'));
});
Route::get('/template-warga-csv', function () {
    return response()->download(public_path('template_warga.csv'));
});

Route::get('/download', [ApiController::class, 'download_all']);
