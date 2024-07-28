<?php

use Illuminate\Support\Facades\Route;
use Atom\Core\Http\Controllers\AvatarController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::get('avatars', AvatarController::class)
        ->name('avatars.search');
});