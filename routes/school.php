<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\School\InfrastructureController;
use App\Http\Controllers\School\ManageSchoolController;
use App\Http\Controllers\School\NoticeController;
use App\Http\Controllers\School\StaffController;
use App\Http\Controllers\School\WebsiteCmsController;
use Illuminate\Support\Facades\Route;



Route::prefix('school')->middleware('school')->group(function () {
Route::post('create/hero/section/infrastructure',[InfrastructureController::class, 'Savehero'])->name('inf.save.hero');
Route::post('create/campus/section/infrastructure',[InfrastructureController::class, 'SaveCampus'])->name('inf.save.campus');
Route::post('create/acadmi/section/infrastructure',[InfrastructureController::class, 'SaveAcademic'])->name('inf.save.acadmi');
Route::post('create/leader/section/staff',[StaffController::class, 'SaveLeader'])->name('staff.save.leader');
Route::post('create/teache/section/staff',[StaffController::class, 'SaveTeacher'])->name('staff.save.teacher');
Route::post('create/notice/section/staff',[NoticeController::class, 'SaveNotice'])->name('notice.save');









    Route::get('homepagedata',[ManageSchoolController::class, 'getHomepagedata']);
    Route::view('/dashboard', 'modules.school.dashboard.index')->name('school.dashboard');
    Route::get('/logout', [LoginController::class, 'SchoolLogout'])->name('school.logout');
    Route::view('/attendance', 'modules.school.attendance.index')->name('school.attendance');
    Route::view('/academics', 'modules.school.academics.index')->name('school.academics');
    Route::view('/meal-reporting', 'modules.school.meal-reporting.index')->name('school.meal');
    Route::post('/create/faq/section', [ManageSchoolController::class, 'SaveFaqSection'])->name('faq.save');
     Route::post('/create/quiz/section', [ManageSchoolController::class, 'SaveQuizSection'])->name('quiz.save');
    Route::view('/reports', 'modules.school.reports.index')->name('school.reports');
     Route::post('/create/alumni/section', [ManageSchoolController::class, 'SaveAlumniSection'])->name('alumni.save');
    Route::view('/website-cms', 'modules.school.website-cms.index')->name('school.website-cms');
    Route::view('/website-cms/home', 'modules.school.website-cms.home.index')->name('school.website-cms.home');
    Route::post('/create/gallery/section', [ManageSchoolController::class, 'SaveGallerySection'])->name('gallery.save');
    Route::post('/create/hero/section', [ManageSchoolController::class, 'SaveHeroSection'])->name('hero.save');
    Route::post('/create/about/section', [ManageSchoolController::class, 'SaveAboutSection'])->name('about.save');
    Route::post('/create/school/ata/glance/section', [ManageSchoolController::class, 'SaveSchoolAtAGlance'])->name('glance.save');
    Route::post('/create/infrastructure/section', [ManageSchoolController::class, 'SaveInfrastructureSection'])->name('infrastructure.save');
    Route::post('/create/activities/section', [ManageSchoolController::class, 'SaveActivitiesSection'])->name('activites.save');
    Route::get('/website-cms/home/hero',[WebsiteCmsController::class,'cmshero'])->name('school.website-cms.home.hero');
    Route::get('/website-cms/home/gallery',[WebsiteCmsController::class,'cmsgallery'])->name('school.website-cms.home.gallery');
    Route::get('/website-cms/home/about', [WebsiteCmsController::class,'cmsabout'])->name('school.website-cms.home.about');
    Route::get('/website-cms/home/glance',[WebsiteCmsController::class,'cmsglance'])->name('school.website-cms.home.glance');
    Route::get('/website-cms/home/infrastructure',[WebsiteCmsController::class,'cmsinfrastructure'])->name('school.website-cms.home.infrastructure');
    Route::get('/website-cms/home/activities',[WebsiteCmsController::class,'cmsactivities'])->name('school.website-cms.home.activities');
    Route::get('/website-cms/home/quiz',[WebsiteCmsController::class,'cmsquiz'])->name('school.website-cms.home.quiz');
    Route::get('/website-cms/home/alumni',[WebsiteCmsController::class,'cmsalumni'])->name('school.website-cms.home.alumni');
    Route::get('/website-cms/home/faq', [WebsiteCmsController::class,'cmsfaq'])->name('school.website-cms.home.faq');
    Route::get('/website-cms/infrastructure', [WebsiteCmsController::class,'cmsinfrastructureindex'])->name('school.website-cms.infrastructure');
    Route::get('/website-cms/staff',[WebsiteCmsController::class,'cmsstaffindex'])->name('school.website-cms.staff');
    Route::get('/website-cms/notices',[WebsiteCmsController::class,'cmsnoticeindex'])->name('school.website-cms.notices');

    // RouteCms-Wedsite

});
