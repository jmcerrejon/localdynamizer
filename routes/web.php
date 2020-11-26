<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/','landing');

Route::post('submit-landing-form', SubmitLandingFormController::class)->name('submit-landing-form');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [ App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::get('home/search', [ App\Http\Controllers\HomeController::class, 'search'])->name('home.search');

    Route::get('stores/datatables', [ App\Http\Controllers\StoreController::class, 'anyData' ])->name('stores.datatables');

    Route::get('invoices/datatables', [ App\Http\Controllers\InvoiceController::class, 'anyData'])->name('invoices.datatables');

    Route::get('recursos/descarga/{id}', [ App\Http\Controllers\ResourceController::class, 'download'])
        ->name('recursos.download')
        ->where('id', '[0-9]+');

    Route::resources([
        'establecimientos' => StoreController::class,
        'recursos' => ResourceController::class,
        'facturacion' => InvoiceController::class,
        'appointment' => AppointmentController::class,
    ]);
});

Route::view('/{any?}', 'landing')
    ->where('any', '^(?!api\/)[\/\w\.-]*');
