<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\School\Class\ClassController;
use App\Http\Controllers\School\InfrastructureController;
use App\Http\Controllers\School\ManageSchoolController;
use App\Http\Controllers\School\ManageSchoolUpdateController;
use App\Http\Controllers\School\NoticeController;
use App\Http\Controllers\School\ReportManageController;
use App\Http\Controllers\School\StaffController;
use App\Http\Controllers\School\StudentManageController;
use App\Http\Controllers\School\WebsiteCmsController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;


Route::prefix('school')->middleware('school')->group(function () {
    Route::post('create/hero/section/infrastructure', [InfrastructureController::class, 'Savehero'])->name('inf.save.hero');
    Route::post('create/campus/section/infrastructure', [InfrastructureController::class, 'SaveCampus'])->name('inf.save.campus');
    Route::post('create/acadmi/section/infrastructure', [InfrastructureController::class, 'SaveAcademic'])->name('inf.save.acadmi');
    Route::post('create/leader/section/staff', [StaffController::class, 'SaveLeader'])->name('staff.save.leader');
    Route::post('create/teache/section/staff', [StaffController::class, 'SaveTeacher'])->name('staff.save.teacher');
    Route::post('create/notice/section/staff', [NoticeController::class, 'SaveNotice'])->name('notice.save');

    Route::get('/homepagedata', [ManageSchoolController::class, 'getHomepagedata']);
    Route::get('/dashboard', [WebsiteCmsController::class, 'schoolDashboard'])->name('school.dashboard');
    Route::get('/logout', [LoginController::class, 'SchoolLogout'])->name('school.logout');
    Route::get('/attendance', [WebsiteCmsController::class, 'attandence'])->name('school.attendance');
    Route::get('/academics', [WebsiteCmsController::class, 'academics'])->name('school.academics');
    Route::get('/meal-reporting', [WebsiteCmsController::class, 'mealreporting'])->name('school.meal');
    Route::get('/infra-info', [HomeController::class, 'infraInfo'])->name('school.infra.info');

    Route::post('/infra-info/store', [ReportManageController::class, 'infrReportSave'])->name('infra.store');
    Route::get('/infra/edit/{id}', [HomeController::class, 'editInfraInfo'])
    ->name('school.infra.edit');
    Route::post('/infra-info/update/{id}', [ReportManageController::class, 'infrReportUpdate'])->name('school.infra.update');
    Route::post('/create/faq/section', [ManageSchoolController::class, 'SaveFaqSection'])->name('faq.save');
    Route::get('/create/createInfrastructure',[HomeController::class, 'createInfrastructure'])->name('school.infra.create');
    Route::post('/create/quiz/section', [ManageSchoolController::class, 'SaveQuizSection'])->name('quiz.save');
    Route::get('/reports', [WebsiteCmsController::class, 'reports'])->name('school.reports');

    Route::get('/website-cms', [WebsiteCmsController::class, 'cmsIndex'])->name('school.website-cms');
    Route::get('/website-cms/home', [WebsiteCmsController::class, 'cmsHome'])->name('school.website-cms.home');
    Route::post('/create/gallery/section', [ManageSchoolController::class, 'SaveGallerySection'])->name('gallery.save');
    Route::post('/create/hero/section', [ManageSchoolController::class, 'SaveHeroSection'])->name('hero.save');
    Route::post('/update/hero/section', [ManageSchoolUpdateController::class, 'UpdateHeroSection'])->name('hero.update');
    Route::post('/create/about/section', [ManageSchoolController::class, 'SaveAboutSection'])->name('about.save');
    Route::post('/update/about/section', [ManageSchoolUpdateController::class, 'UpdateAboutSection'])->name('about.update');
    Route::post('/create/school/ata/glance/section', [ManageSchoolController::class, 'SaveSchoolAtAGlance'])->name('glance.save');
    Route::post('/update/school/ata/glance/section', [ManageSchoolUpdateController::class, 'UpdateSchoolAtAGlance'])->name('glance.update');
    Route::post('/create/infrastructure/section', [ManageSchoolController::class, 'SaveInfrastructureSection'])->name('infrastructure.save');
    Route::post('/update/infrastructure/section', [ManageSchoolUpdateController::class, 'UpdateInfrastructureSection'])->name('infrastructure.update');

    Route::post('/create/activities/section', [ManageSchoolController::class, 'SaveActivitiesSection'])->name('activites.save');
    Route::post('/update/activities/section', [ManageSchoolUpdateController::class, 'UpdateActivitiesSection'])->name('activites.update');
    Route::post('/delete/activities/section', [ManageSchoolUpdateController::class, 'DeleteActivity'])->name('activites.delete');
    Route::get('/website-cms/home/hero', [WebsiteCmsController::class, 'cmshero'])->name('school.website-cms.home.hero');
    Route::get('/website-cms/home/gallery', [WebsiteCmsController::class, 'cmsgallery'])->name('school.website-cms.home.gallery');
    Route::get('/website-cms/home/about', [WebsiteCmsController::class, 'cmsabout'])->name('school.website-cms.home.about');
    Route::get('/website-cms/home/glance', [WebsiteCmsController::class, 'cmsglance'])->name('school.website-cms.home.glance');
    Route::get('/website-cms/home/infrastructure', [WebsiteCmsController::class, 'cmsinfrastructure'])->name('school.website-cms.home.infrastructure');
    Route::get('/website-cms/home/activities', [WebsiteCmsController::class, 'cmsactivities'])->name('school.website-cms.home.activities');
    Route::get('/website-cms/home/quiz', [WebsiteCmsController::class, 'cmsquiz'])->name('school.website-cms.home.quiz');
    Route::get('/website-cms/home/alumni', [WebsiteCmsController::class, 'cmsalumni'])->name('school.website-cms.home.alumni');
    Route::get('/website-cms/home/faq', [WebsiteCmsController::class, 'cmsfaq'])->name('school.website-cms.home.faq');
    Route::get('/website-cms/infrastructure', [WebsiteCmsController::class, 'cmsinfrastructureindex'])->name('school.website-cms.infrastructure');
    Route::get('/website-cms/staff', [WebsiteCmsController::class, 'cmsstaffindex'])->name('school.website-cms.staff');
    Route::get('/website-cms/notices', [WebsiteCmsController::class, 'cmsnoticeindex'])->name('school.website-cms.notices');
    Route::post('/get/quize/edit/section', [ManageSchoolUpdateController::class, 'editQuize'])->name('quize.edit');
    Route::post('/alumni/update/section', [ManageSchoolUpdateController::class, 'UpdateAlumniSection'])->name('alumni.update');
    Route::post('/create/alumni/section', [ManageSchoolController::class, 'SaveAlumniSection'])->name('alumni.save');
    Route::delete('/delete/alumni/section', [ManageSchoolUpdateController::class, 'DeleteAlumniSection'])->name('alumni.delete');
    Route::post('/attendance/update', [ClassController::class, 'updateattendance'])->name('attendance.status.update');
    Route::post('/student/addmition', [StudentManageController::class, 'createStudent'])->name('addmition.student');
    Route::post('/report/send', [ReportManageController::class, 'ReportUpload'])->name('report.save');
    Route::post('/meals/report',[ReportManageController::class, 'mealReport'])->name('meal.report');
    // RouteCms-Wedsite
    Route::post('/update/school/faq',[ManageSchoolUpdateController::class, 'UpdateFaqSection'])->name('faq.update');
     Route::delete('/update/school/faq/delete/index',[ManageSchoolUpdateController::class, 'DeleteFaqSection'])->name('faq.delete.index');
    Route::get('/attendance/classs/filter/', [ClassController::class, 'classFilter'])->name('class.filter');
      Route::get('/student/classs/filter/', [StudentManageController::class, 'studentclassFilter'])->name('student.class.filter');
    Route::get('/student/schoolmanagement', [StudentManageController::class, 'getallStudent'])->name('school.student');
    Route::get('/schoolmanagement/create', [StudentManageController::class, 'studentCreate'])->name('school.stud.create');
    Route::get('/schoolmanagement/bulk-upload', [StudentManageController::class, 'bulkUploadStudent'])->name('student.bulkupload');
    Route::get('/schoolmanagement/edit/{id}', [StudentManageController::class, 'studentEdit'])->name('school.stud.edit');
    Route::post('/student/update/{id}',[StudentManageController::class, 'studentUpdate'])->name('student.update');
    Route::delete('/student/delete/{id}',[StudentManageController::class, 'studentDelete'])->name('student.delete');
    Route::get('/student/export',[StudentManageController::class, 'exportStudent'])->name('student.export');
    Route::post('/student/import',[StudentManageController::class, 'importStudent'])->name('student.import');
});
