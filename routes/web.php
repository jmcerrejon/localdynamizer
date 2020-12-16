<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\{HomeController, ResourceController, StoreController, InvoiceController};

Route::view('/', 'landing');

Route::post('submit-landing-form', SubmitLandingFormController::class)->name('submit-landing-form');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [ HomeController::class, 'index' ])->name('home.index');
    Route::get('home/search', [ HomeController::class, 'search' ])->name('home.search');
    Route::get('recursos/hashtags', [ ResourceController::class, 'filterByHashtags'])->name('recursos.hashtags.search');

    Route::get('stores/datatables', [ StoreController::class, 'anyData' ])->name('stores.datatables');

    Route::get('invoices/datatables', [ InvoiceController::class, 'anyData'])->name('invoices.datatables');

    Route::get('recursos/descarga/{id}', [ ResourceController::class, 'download'])
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
