<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('locations', API\LocationController::class);
// Route::get('stores/{postal_code}', [API\StoreController::class, '']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
