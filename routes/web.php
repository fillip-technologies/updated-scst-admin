<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manegement\UserAccountController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Frontend Only)
|--------------------------------------------------------------------------
*/

// Login page default
Route::get('/', [HomeController::class, 'homePage'])->name('login');
Route::post('/system/login', [LoginController::class, 'SystemLogin'])->name('system.login');
// Signup
Route::view('/signup', 'auth.signup')->name('signup');

// Dashboard
/*
|--------------------------------------------------------------------------
| SCHOOL MODULES
|--------------------------------------------------------------------------
*/

// School Monitoring
// Route::get('/school-monitoring', [HomeController::class, 'schoolMonitoring'])
//     ->name('school.monitoring');

// School Management
Route::get('/school-management', function () {
    return view('modules.school.school-management.index');
})->name('school.management');

Route::get('/school-management/create', function () {
    return view('modules.school.school-management.create');
});

Route::get('/school-management/bulk-upload', function () {
    return view('modules.school.school-management.bulk-upload');
});

// // School Management Edit
// Route::view('/school-management/edit', 'modules.school-management.edit')
//     ->name('school-management.edit');

// // School Management View
// Route::view('/school-management/view', 'modules.school-management.show')
//     ->name('school-management.view');


/*
|--------------------------------------------------------------------------
| PERFORMANCE & RANKINGS
|--------------------------------------------------------------------------
*/

// Performance
// Route::view('/performance-analytics', 'modules.performance-management.index')
//     ->name('performance.analytics');

// // Ranking
// Route::view('/rankings', 'modules.rankings.index')
//     ->name('rankings');

// // Reports
// Route::view('/reports', 'modules.reports.index')
//     ->name('reports');

// // Approvals
// Route::view('/approvals', 'modules.approvals.index')
//     ->name('approvals');

// // Notifications
// Route::view('/notifications', 'modules.notifications.index')
//     ->name('notifications');


/*
|--------------------------------------------------------------------------
| USER MANAGEMENT
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| AUDIT & SYSTEM
|--------------------------------------------------------------------------
*/

// Audit Logs
// Route::view('/audit-logs', 'modules.audit-logs.index')
//     ->name('audit.logs');

// // System Settings
// Route::view('/system-settings', 'modules.system-settings.index')
//     ->name('system.settings');


/*
|--------------------------------------------------------------------------
| CHATBOT
|--------------------------------------------------------------------------
*/

Route::post('/chat', [ChatController::class, 'handle']);
