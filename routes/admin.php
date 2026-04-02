<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainNoticeController;
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
    Route::get('/getall/report', [ReportManageController::class, 'showallReport'])->name('show.all.report');

    Route::post('/notice/create', [MainNoticeController::class, 'NoticeCreate'])->name('admin.notice.save');
    Route::post('/notice/update/{id}', [MainNoticeController::class, 'NoticeUpdate'])->name('admin.notice.update');
    Route::get('/all/motice', [MainNoticeController::class, 'NoticeEdit'])->name('admin.notices');
    Route::delete('/notice/delete/{id}', [MainNoticeController::class, 'NoticeDelete'])->name('admin.notice.delete');
    Route::get('/notice/export', [MainNoticeController::class, 'NoticeExport'])->name('admin.notice.export');
    Route::post('/notice/import', [MainNoticeController::class, 'NoticeImport'])->name('admin.notice.import');

    Route::view('/performance-analytics', 'modules.performance-management.index')
        ->name('performance.analytics');

    // Ranking
    Route::view('/rankings', 'modules.rankings.index')
        ->name('rankings');

    // Reports
    Route::get('/reports', [HomeController::class, 'allreport'])->name('report');
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

    // 

    Route::get('/admin/notices', [HomeController::class, 'notices'])
        ->name('admin.notices.index');

    Route::get('/admin/notices/create', [HomeController::class, 'createNotice'])
        ->name('admin.notices.create');

    Route::get('/admin/notices/edit/{id}', [HomeController::class, 'editNotice'])
        ->name('admin.notices.edit');

    Route::get('/admin/notices/delete/{id}', [HomeController::class, 'deleteNotice'])
        ->name('admin.notices.delete');
    Route::post('/admin/notices/store', [HomeController::class, 'store'])
        ->name('admin.notices.store');
});
