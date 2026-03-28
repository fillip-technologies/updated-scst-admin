<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SchoolManageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\School\ReportManageController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::view('/dashboard', 'modules.dashboard.index')->name('admin.dashboard');
    Route::get('/logout', [LoginController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/school-management', [HomeController::class, 'schoolManagement'])->name('admin.school.management');
    Route::get('/school-management/create', function () {
        return view('modules.school-management.create');
    });
    Route::post('/school/create', [SchoolManageController::class, 'AddSchool'])->name('save.school');
    Route::get('/edit/school/{id}', [SchoolManageController::class, 'EditSchool'])->name('edit.school');
    Route::get('/view/school/{id}', [SchoolManageController::class, 'ViewSchool'])->name('show.school');
    Route::post('/update/{id}/school', [SchoolManageController::class, 'UpdateSchool'])->name('update.school');
    Route::delete('/delete/{id}/school', [SchoolManageController::class, 'DeleteSchool'])->name('delete.school');
    Route::post('/update/school/{id}/status', [SchoolManageController::class, 'StatusUpdate'])->name('status.update');
    Route::get('school/export', [SchoolManageController::class, 'SchoolExport'])->name('export.school');
    Route::post('/getall/report',[ReportManageController::class, 'showallReport'])->name('show.all.report');

    Route::view('/performance-analytics', 'modules.performance-management.index')
        ->name('performance.analytics');

    // Ranking
    Route::view('/rankings', 'modules.rankings.index')
        ->name('rankings');

    // Reports
    Route::get('/reports',[HomeController::class,'allreport'])->name('report');
    Route::get('/reports/data', [HomeController::class, 'getReportsData'])
        ->name('reports.data');

    // Approvals
    Route::view('/approvals', 'modules.approvals.index')
        ->name('approvals');

    // Notifications
    Route::view('/notifications', 'modules.notifications.index')
        ->name('notifications');

    Route::view('/audit-logs', 'modules.audit-logs.index')
        ->name('audit.logs');

    // System Settings
    Route::view('/system-settings', 'modules.system-settings.index')
        ->name('system.settings');
    Route::get('/school-monitoring', [HomeController::class, 'monitoring'])
        ->name('school.monitoring');
    Route::post('/send-notice', [HomeController::class, 'sendNotice'])
        ->name('school.monitoring.send-notice');
});
