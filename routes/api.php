<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StoreController;

Route::get('locations', API\LocationController::class);
Route::get('categories', API\CategoryController::class);
Route::get('activities', API\ActivityController::class);
Route::get('stores/{id}', [ StoreController::class, 'show']);
Route::get('stores/location/{id}', [ StoreController::class, 'index']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});
