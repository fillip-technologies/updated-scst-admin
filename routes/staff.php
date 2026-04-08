<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
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

});
