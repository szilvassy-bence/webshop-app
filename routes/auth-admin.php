<?php

use App\Http\Controllers\Admin\RegisteredAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredAdminController::class, 'create'])
            ->name('admin.register.create');
        Route::post('register', [RegisteredAdminController::class, 'store'])
            ->name('admin.register.store');
    });

});
