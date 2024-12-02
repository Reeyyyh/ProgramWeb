<?php

use App\Http\Controllers\Api\PembeliController;
use App\Http\Controllers\Api\TiketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('pembeli', PembeliController::class);
Route::apiResource('tiket', TiketController::class);