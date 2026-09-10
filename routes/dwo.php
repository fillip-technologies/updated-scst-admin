<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SchoolManageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\School\ReportManageController;
use Illuminate\Support\Facades\Route;





Route::prefix('dwo')->middleware(['dwo'])->group(function(){
Route::get('/logout/dwo',[LoginController::class, 'DWOLogout'])->name('dwo.logout');
 Route::view('/dashboard', 'modules.dashboard.index')->name('dwo.dashboard');
     Route::get('/get/school/{value}', [SchoolManageController::class, 'getschools'])->name('get.schools');

   Route::get('/school-monitoring', [HomeController::class, 'monitoring'])
        ->name('dwo.monitoring');
            Route::get('/reports', [HomeController::class, 'allreport'])->name('dwo.report');
                Route::get('/getall/report', [ReportManageController::class, 'showallReport'])->name('dwo.show.all.report');


});
