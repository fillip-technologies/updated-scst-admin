<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SchoolManageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::view('/dashboard', 'modules.dashboard.index')->name('admin.dashboard');
    Route::get('/logout', [LoginController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/school-management', [HomeController::class, 'schoolManagement'])->name('admin.school.management');
    Route::get('/school-management/create', function () {return view('modules.school-management.create');});
    Route::post('/school/create', [SchoolManageController::class, 'AddSchool'])->name('save.school');
    Route::get('/edit/school/{id}', [SchoolManageController::class, 'EditSchool'])->name('edit.school');
    Route::get('/view/school/{id}', [SchoolManageController::class, 'ViewSchool'])->name('show.school');
    Route::post('/update/{id}/school', [SchoolManageController::class, 'UpdateSchool'])->name('update.school');
    Route::delete('/delete/{id}/school', [SchoolManageController::class, 'DeleteSchool'])->name('delete.school');
    Route::post('/update/school/{id}/status', [SchoolManageController::class, 'StatusUpdate'])->name('status.update');
    Route::get('school/export', [SchoolManageController::class, 'SchoolExport'])->name('export.school');

    Route::view('/performance-analytics', 'modules.performance-management.index')
        ->name('performance.analytics');

    // Ranking
    Route::view('/rankings', 'modules.rankings.index')
        ->name('rankings');

    // Reports
    Route::view('/reports', 'modules.reports.index')
        ->name('reports');
    Route::get('/reports/data', function () {
        $district = request('district', '');
        $schoolId = request('school_id', '');
        $reportType = request('report_type', '');

        return response()->json([
            'status' => true,
            'rows' => [
                [
                    'district' => $district ? ucwords(str_replace(['-', '_'], ' ', $district)) : 'Sample District',
                    'school' => $schoolId ?: 'Sample School',
                    'report_type' => $reportType ? ucwords(str_replace('_', ' ', $reportType)) : 'Sample Report',
                    'status' => 'On Track',
                    'updated_on' => now()->format('d M Y, h:i A'),
                ],
                [
                    'district' => $district ? ucwords(str_replace(['-', '_'], ' ', $district)) : 'Sample District',
                    'school' => $schoolId ?: 'Sample School',
                    'report_type' => $reportType ? ucwords(str_replace('_', ' ', $reportType)) : 'Sample Report',
                    'status' => 'Review Pending',
                    'updated_on' => now()->subDay()->format('d M Y, h:i A'),
                ],
                [
                    'district' => $district ? ucwords(str_replace(['-', '_'], ' ', $district)) : 'Sample District',
                    'school' => $schoolId ?: 'Sample School',
                    'report_type' => $reportType ? ucwords(str_replace('_', ' ', $reportType)) : 'Sample Report',
                    'status' => 'Verified',
                    'updated_on' => now()->subDays(2)->format('d M Y, h:i A'),
                ],
            ],
        ]);
    })->name('reports.data');

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
