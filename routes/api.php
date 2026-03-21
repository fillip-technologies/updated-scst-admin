<?php

use App\Http\Controllers\Api\HomeSectionController;
use App\Http\Controllers\Api\SchoolApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/schools',[SchoolApiController::class,'index']);
Route::get('/school/home/{school_id}', [HomeSectionController::class, 'getHomeSchoolData']);
