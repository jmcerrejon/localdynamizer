<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Auth\LoginController;

Route::get('login', [ LoginController::class, 'showLoginForm' ])->name('admin.login.index');
Route::post('login', [ LoginController::class, 'login' ])->name('admin.login');
Route::get('logout', [ LoginController::class, 'logout' ])->name('admin.logout');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('home', [ App\Http\Controllers\Admin\HomeController::class, 'index' ])->name('admin.home');
    Route::get('files', Admin\FileManagerController::class)->name('admin.filemanager');
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::resource('dynamizers', Admin\DynamizerController::class)->except(['show']);
});
