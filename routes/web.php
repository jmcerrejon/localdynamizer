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

    Route::resources([
		'establecimientos' => StoreController::class,
	]);
});

Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');