<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Atom\Core\Http\Controllers\LoginController;
use Atom\Core\Http\Controllers\BannedController;
use Atom\Core\Http\Controllers\LogoutController;
use Atom\Core\Http\Controllers\RegisterController;
use Atom\Core\Http\Controllers\ResetPasswordController;
use Atom\Core\Http\Controllers\ForgotPasswordController;

// @todo - Create Banned Middleware...

Route::middleware('web')->group(function () {
    Route::resource('login', LoginController::class)
        ->middleware('guest')
        ->only(['index', 'store']);

    Route::resource('forgot-password', ForgotPasswordController::class)
        ->middleware('guest')
        ->only(['index', 'store']);

    Route::resource('reset-password', ResetPasswordController::class)
        ->middleware('guest')
        ->only(['index', 'store']);

    Route::resource('register', RegisterController::class)
        ->middleware('guest')
        ->only(['index', 'store']);

    Route::get('banned', BannedController::class)
        ->middleware(Authenticate::using('sanctum'))
        ->name('banned');

    Route::get('logout', LogoutController::class)
        ->middleware(Authenticate::using('sanctum'))
        ->name('logout');
});
