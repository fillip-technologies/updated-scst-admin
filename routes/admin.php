<?php

use App\Http\Controllers\Admin\cms\DepartmentCmsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainNoticeController;
use App\Http\Controllers\Admin\MissionAspireController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\SchoolManageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mails\ManageMailController;
use App\Http\Controllers\School\ReportManageController;
use App\Http\Controllers\School\SearchManageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('/store/state/section', [DepartmentCmsController::class, 'add_states'])->name('add.states');
    Route::post('/store/schema', [DepartmentCmsController::class, 'add_schema'])->name('add.schemas');
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
    Route::get('/edit/notice/{id}', [MainNoticeController::class, 'NoticeEdit'])->name('admin.edit.notice');
    Route::get('/notice/delete/{id}', [MainNoticeController::class, 'NoticeDelete'])->name('admin.notice.delete');
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
    Route::get('/notifications', [HomeController::class, 'notifications'])->name('notifications');

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

    Route::post('/send/notification/mail', [ManageMailController::class, 'sentNotification'])->name('send.email');
    Route::post('/notificationsend', [ManageMailController::class, 'notificationsend'])->name('notification.send');

    Route::get('/notices', [HomeController::class, 'notices'])
        ->name('admin.notices.index');

    Route::get('/admin/notices/create', [HomeController::class, 'createNotice'])
        ->name('admin.notices.create');

    Route::get('/admin/notices/edit/{id}', [HomeController::class, 'editNotice'])
        ->name('admin.notices.edit');

    Route::get('/admin/notices/delete/{id}', [HomeController::class, 'deleteNotice'])
        ->name('admin.notices.delete');
    Route::post('/admin/notices/store', [HomeController::class, 'store'])
        ->name('admin.notices.store');

    //
    Route::get('/admin/stock/edit', [HomeController::class, 'editStock'])
        ->name('admin.stock.edit');

    Route::get('/filterMonotering', [MonitoringController::class, 'filterMonotering'])->name('filterMonotering');

    Route::post('/admin/stock/update', [HomeController::class, 'updateStock'])
        ->name('admin.stock.update');
    Route::get('/search/data', [SearchManageController::class, 'schoolSearch'])->name('search.school');
    Route::get('/details/montering/school/{id}', [MonitoringController::class, 'detailsMonitering'])->name('details.schools');

    Route::get('department/website-cms/home/leader', [HomeController::class, 'leader'])
        ->name('admin.department.cms.leader');

    Route::get('epartment/website-cms/home/leader/edit', [HomeController::class, 'editLeader'])
        ->name('admin.department.cms.leader.edit');

    Route::get('/department/website-cms/home/stats', [HomeController::class, 'stats'])
        ->name('admin.department.cms.stats');

    Route::get('/department/website-cms/home/stats/edit', [HomeController::class, 'editStats'])
        ->name('admin.department.cms.stats.edit');

    Route::get('/department/website-cms/home/schemes', [HomeController::class, 'schemes'])
        ->name('admin.department.cms.schemes');
    Route::get('/schema/edit/{id}', [DepartmentCmsController::class, 'editschema'])->name('edit.schema');
    Route::post('/update/schema/{id}', [DepartmentCmsController::class, 'updateschema'])->name('update.schema');

    Route::get('/department/website-cms/home/schemes/create', [HomeController::class, 'createScheme'])
        ->name('admin.department.cms.schemes.create');

    Route::get('/department/website-cms/home/schemes/edit', [HomeController::class, 'editSchemes'])
        ->name('admin.department.cms.schemes.edit');

    Route::get('/get/school/{value}', [SchoolManageController::class, 'getschools'])->name('get.schools');
    Route::post('/minister/data/store', [DepartmentCmsController::class, 'minister_add'])->name('minister.data.store');
    Route::post('/secretary/data/store', [DepartmentCmsController::class, 'secretary_add'])->name('secretary.data.store');
    Route::post('/iasofficer/data/store', [DepartmentCmsController::class, 'ias_officer_add'])->name('ias.data.store');

    // Imported Routes

    Route::get('mission/aspire',[MissionAspireController::class,'mission_aspire'])->name('mission.aspire');
    Route::post('/upload/mission/aspire',[MissionAspireController::class, 'uploadMissionAspire'])->name('upload.mission.aspire');
});
