<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Course\Http\Controllers\CourseController;
use Modules\Course\Http\Controllers\TeacherController;
use Modules\Course\Http\Controllers\VariousGroupController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('admin.')->prefix('admin/')->group(function (){
    Route::prefix('courses/')->name('api.course.')->group(function() {

        Route::get('/all',[CourseController::class,'getCourseApi'])->name('getAll');
    });
    Route::prefix('teachers/')->name('api.teacher.')->group(function() {

        Route::get('/all',[TeacherController::class,'getTeacherApi'])->name('getAll');
    });
    Route::prefix('groups/')->name('api.group.')->group(function() {

        Route::get('/all',[VariousGroupController::class,'getGroupsApi'])->name('getAll');
    });
});
