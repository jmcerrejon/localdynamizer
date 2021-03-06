<?php

use Illuminate\Support\Facades\{Auth, Route};

// Landing

Route::view('/', 'landing');
Route::post('submit-landing-form', SubmitLandingFormController::class)->name('submit-landing-form');
Route::get('get_location', GetLocationController::class)->name('get-location');

// Auth routes

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // Home

    Route::get('/home', [ App\Http\Controllers\HomeController::class, 'index' ])->name('home.index');
    Route::get('/home/search', [ App\Http\Controllers\HomeController::class, 'search' ])->name('home.search');
    Route::get('ficheros', FileManagerController::class)->name('filemanager');

    // Resources

    Route::group(['preffix' => 'recursos'], function () {
        Route::get('/hashtags', [ App\Http\Controllers\ResourceController::class, 'filterByHashtags'])->name('recursos.hashtags.search');
        Route::get('/descarga/{id}', [ App\Http\Controllers\ResourceController::class, 'download'])->name('recursos.download')->where('id', '[0-9]+');
    });

    Route::get('/stores/datatables', [ App\Http\Controllers\StoreController::class, 'anyData' ])->name('stores.datatables');
    Route::get('/invoices/datatables', [ App\Http\Controllers\InvoiceController::class, 'anyData'])->name('invoices.datatables');

    // Stores

    Route::group(['preffix' => 'establecimientos'], function () {
        Route::get('/{id}/horarios', [ App\Http\Controllers\StoreController::class, 'showOpening'])->name('establecimientos.show-opening')->where('id', '[0-9]+');
        Route::post('/{id}/horarios', [ App\Http\Controllers\StoreController::class, 'saveOpening'])->name('establecimientos.save-opening');
    });

    Route::resources([
        'establecimientos' => StoreController::class,
        'recursos' => ResourceController::class,
        'facturacion' => InvoiceController::class,
        'appointment' => AppointmentController::class,
    ]);
});

// Auto login on local environment

Route::get('/auto-login', function() {
    abort_unless(app()->environment('local'), 403);

    auth()->login(App\Models\User::first());

    return redirect()->to('/home');
})->name('dev-login)');

Route::view('/{any?}', 'landing')
    ->where('any', '^(?!api\/)[\/\w\.-]*');
