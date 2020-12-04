<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Auth\LoginController;

Route::get('admon/login', [ LoginController::class, 'showLoginForm' ])->name('admin.login.index');
Route::post('admon/login', [ LoginController::class, 'login' ])->name('admin.login');
Route::get('admon/logout', [ LoginController::class, 'logout' ])->name('admin.logout');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('admon/home', [ App\Http\Controllers\Admin\HomeController::class, 'index' ])->name('admin.home');

    Route::resources([
        'dynamizers' => \Admin\DynamizerController::class,
    ]);
});