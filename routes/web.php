<?php

use App\Http\Middleware\Authenticate;
use Atom\Core\Http\Controllers\BannedController;
use Atom\Core\Http\Controllers\BetaCodeController;
use Atom\Core\Http\Controllers\ForgotPasswordController;
use Atom\Core\Http\Controllers\LoginController;
use Atom\Core\Http\Controllers\LogoutController;
use Atom\Core\Http\Controllers\ProxyController;
use Atom\Core\Http\Controllers\RegisterController;
use Atom\Core\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('login', [LoginController::class, 'index'])
        ->middleware('guest')
        ->name('login');

    Route::post('beta-codes/login', BetaCodeController::class)
        ->middleware('guest')
        ->name('beta-codes.login');

    Route::post('auth/login', [LoginController::class, 'store'])
        ->name('login.store');

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

    Route::get('proxy', ProxyController::class)
        ->middleware(Authenticate::using('sanctum'))
        ->name('proxy');

    Route::get('logout', LogoutController::class)
        ->middleware(Authenticate::using('sanctum'))
        ->name('logout');
});
