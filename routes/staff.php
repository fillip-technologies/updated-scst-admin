<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\School\Class\ClassController;
use App\Http\Controllers\School\ReportManageController;
use App\Http\Controllers\School\ResultManageController;
use App\Http\Controllers\School\SearchManageController;
use App\Http\Controllers\School\StudentManageController;
use App\Http\Controllers\School\WebsiteCmsController;
use App\Http\Controllers\SubjectManageController;
use Illuminate\Support\Facades\Route;

Route::prefix('staff')->middleware('staff')->group(function () {
    Route::view('/dashboard', 'modules.dashboard.index')->name('staff.dashboard');
    Route::get('/subjects', [HomeController::class, 'subjects'])
        ->name('staff.subjects');
    Route::get('/logout', [LoginController::class, 'AdminLogout'])->name('staff.logout');

    Route::post('/create/subject', [SubjectManageController::class, 'createSubject'])->name('staff.create.subject');
    Route::delete('/delete/subject/{id}', [SubjectManageController::class, 'deleteSubject'])->name('staff.delete.subject');
    Route::get('/attendance', [WebsiteCmsController::class, 'attandence'])->name('staff.school.attendance');
    Route::get('/student/schoolmanagement', [StudentManageController::class, 'getallStudent'])->name('staff.school.student');
    Route::get('/manage-result', [HomeController::class, 'manageResult'])
        ->name('staff.school.manage-result');
Route::get('/search/student',[SearchManageController::class,'studentSearch'])->name('staff.student.search');
    Route::post('/add/class', [ClassController::class, 'addClass'])->name('staff.add.class');
    Route::get('/edit/class/{id}', [ClassController::class, 'editclass'])->name('staff.edit.class');
    Route::post('/update/class/{id}', [ClassController::class, 'updateclass'])->name('staff.update.class');
    Route::delete('/delete/class/{id}', [ClassController::class, 'deleteclass'])->name('staff.delete.class');

    // class manage
    Route::post('/report/send', [ReportManageController::class, 'ReportUpload'])->name('staff.report.save');
    Route::get('/search/date/attendence', [SearchManageController::class, 'attendanceSerach'])->name('staff.search.attendance');

    Route::get('/classes/create', [HomeController::class, 'createClass'])
        ->name('staff.classes.create');
    Route::post('/add/class', [ClassController::class, 'addClass'])->name('staff.add.class');
    Route::get('/edit/class/{id}', [ClassController::class, 'editclass'])->name('staff.edit.class');
    Route::post('/update/class/{id}', [ClassController::class, 'updateclass'])->name('staff.update.class');
    Route::delete('/delete/class/{id}', [ClassController::class, 'deleteclass'])->name('staff.delete.class');
    Route::get('/attendance/classs/filter/', [ClassController::class, 'classFilter'])->name('staff.class.filter');
    Route::get('/student/classs/filter/', [StudentManageController::class, 'studentclassFilter'])->name('staff.student.class.filter');

    // Student manages
    Route::post('/student/addmition', [StudentManageController::class, 'createStudent'])->name('staff.addmition.student');
    Route::post('/student/update/{id}', [StudentManageController::class, 'studentUpdate'])->name('staff.student.update');
    Route::delete('/student/delete/{id}', [StudentManageController::class, 'studentDelete'])->name('staff.student.delete');
    Route::get('/student/export', [StudentManageController::class, 'exportStudent'])->name('staff.student.export');
    Route::post('/student/import', [StudentManageController::class, 'importStudent'])->name('staff.student.import');
    Route::get('/student/classs/filter/', [StudentManageController::class, 'studentclassFilter'])->name('staff.student.class.filter');
    Route::get('/student/schoolmanagement', [StudentManageController::class, 'getallStudent'])->name('staff.school.student');
    Route::get('/schoolmanagement/create', [StudentManageController::class, 'studentCreate'])->name('staff.school.stud.create');
    Route::get('/schoolmanagement/bulk-upload', [StudentManageController::class, 'bulkUploadStudent'])->name('staff.student.bulkupload');
    Route::get('/schoolmanagement/edit/{id}', [StudentManageController::class, 'studentEdit'])->name('staff.school.stud.edit');


    // Subject

    Route::get('/subjects', [HomeController::class, 'subjects'])
        ->name('staff.subjects');
    Route::post('/create/subject', [SubjectManageController::class, 'createSubject'])->name('staff.create.subject');
    Route::delete('/delete/subject/{id}', [SubjectManageController::class, 'deleteSubject'])->name('staff.delete.subject');

    Route::get('/result/show/data',[ResultManageController::class ,'getdata'])->name('staff.get.result');
    Route::post('/result/add',[ResultManageController::class, 'Resultstore'])->name('staff.result.store');
    Route::get('/list/reselt',[ResultManageController::class, 'ListResult'])->name('staff.result.list');
    Route::get('/get/filter/result',[ResultManageController::class, 'filterResult'])->name('filter.result');


});
