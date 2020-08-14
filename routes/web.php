<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function() { return view('home'); })->name('home');

    Route::get('stores/datatables', 'StoreController@anyData')->name('stores.datatables');
    Route::get('resources/datatables', 'ResourceController@anyData')->name('resources.datatables');

    Route::resources([
		'establecimientos' => StoreController::class,
		'recursos' => ResourceController::class,
	]);
});

Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');