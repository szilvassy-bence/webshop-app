<?php

use App\Http\Controllers\Admin\AuthenticatedAdminSessionController;
use App\Http\Controllers\Admin\RegisteredAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredAdminController::class, 'create'])
            ->name('admin.register.create');
        Route::post('/register', [RegisteredAdminController::class, 'store'])
            ->name('admin.register.store');
        Route::get('/login', [AuthenticatedAdminSessionController::class, 'create'])
            ->name('admin.login.create');
        Route::post('/login', [AuthenticatedAdminSessionController::class, 'store'])
            ->name('admin.login.store');
    });
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthenticatedAdminSessionController::class, 'destroy'])
            ->name('admin.logout');
    });
});
