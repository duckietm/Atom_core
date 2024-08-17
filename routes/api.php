<?php

use Illuminate\Support\Facades\Route;
use Atom\Core\Http\Controllers\AvatarController;
use Atom\Core\Http\Controllers\RegisterController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::get('avatars', AvatarController::class)
        ->name('avatars.search');

    Route::post('register/validation', [RegisterController::class, 'validation'])
        ->middleware('guest')
        ->name('register.validation');
});
