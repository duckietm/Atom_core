<?php

use Atom\Core\Http\Controllers\AvatarController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api')->group(function () {
    Route::get('avatars', AvatarController::class)
        ->name('avatars.search');
});
