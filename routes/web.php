<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::post('submit-landing-form', 'SubmitLandingFormController')->name('submit-landing-form');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('stores/datatables', 'StoreController@anyData')->name('stores.datatables');
    Route::get('invoices/datatables', 'InvoiceController@anyData')->name('invoices.datatables');

    Route::get('recursos/descarga/{id}', 'ResourceController@download')
        ->name('recursos.download')
        ->where('id', '[0-9]+');

    Route::resources([
        'establecimientos' => StoreController::class,
        'recursos' => ResourceController::class,
        'facturacion' => InvoiceController::class,
        'calendario' => AppointmentController::class,
    ]);
});

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');
