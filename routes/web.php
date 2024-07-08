<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['admin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    // <--------- Profile ----------->
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])
        ->name('admin.profile.edit');
    Route::patch('/admin/profile', [AdminProfileController::class, 'update'])
        ->name('admin.profile.update');
    Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])
        ->name('admin.profile.destroy');
    // <--------- END Profile ----------->


    // <--------- Manage users ----------->
    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');
    // <--------- END Manage users ----------->




});

require __DIR__.'/auth.php';
require __DIR__.'/auth-admin.php';
