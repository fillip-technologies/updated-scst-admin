<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manegement\UserAccountController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'homePage'])->name('login');
Route::post('/system/login', [LoginController::class, 'SystemLogin'])->name('system.login');
// Signup
Route::view('/signup', 'auth.signup')->name('signup');
Route::view('/staff/login','auth.teacher')->name('teacher.singup');

Route::prefix('user-management')->group(function () {

    Route::redirect('/', '/user-management/users');

    // USERS
    Route::view('/users', 'modules.user-management.users.index')
        ->name('user.management.users');

    // ROLES
    Route::view('/roles', 'modules.user-management.roles.index')
        ->name('user.management.roles');

    // PERMISSIONS
    Route::view('/permissions', 'modules.user-management.permissions.index')
        ->name('user.management.permissions');

    // LOGS
    Route::view('/logs', 'modules.user-management.logs.index')
        ->name('user.management.logs');
});
Route::post('/chat', [ChatController::class, 'handle']);
