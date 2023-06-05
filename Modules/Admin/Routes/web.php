<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\Auth\NewPasswordController;
use Modules\Admin\Http\Controllers\Auth\PasswordResetLinkController;
use Modules\Admin\Http\Controllers\Auth\AuthenticatedSessionController;
use Modules\Admin\Http\Controllers\SettingController;

Route::name('admin.')->prefix('admin')->group(function() {

    Route::middleware('guest:admin')->group(function(){
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
    });

     Route::middleware(['admin'])->group(function (){



       Route::middleware('permission:عرض لوحة التحكم')->group(function(){
        Route::get('/', [AdminController::class,'dashboard']);
        Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
       });

        Route::get('/courses/analyze', [AdminController::class,'analyzePage'])->name('analyze');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
        Route::get('/profile',[AdminController::class,'myProfile'])->name('myprofile');
        Route::post('/profile/update',[AdminController::class,'updatemyProfile'])->name('update.myprofile');

        Route::prefix('/admins')->name('admins.')->group(function(){

            Route::middleware('permission:تعديل مستخدم')->group(function(){
                Route::get('/edit/{id}',[AdminController::class,'edit'])->name('edit');
                Route::post('/update/{id}',[AdminController::class,'update'])->name('update');

            });
            Route::middleware('permission:إنشاء مستخدم')->group(function(){
                Route::get('/create',[AdminController::class,'create'])->name('create');
                Route::post('/store',[AdminController::class,'store'])->name('store');

            });

         Route::get('/',[AdminController::class,'index'])->name('index')->middleware('permission:عرض مستخدم');
         Route::post('/delete/{id}',[AdminController::class,'destroy'])->name('delete')->middleware('permission:حذف مستخدم');

        });
        Route::prefix('/roles')->name('role.')->group(function(){

        Route::middleware('permission:تعديل صلاحية')->group(function(){
            Route::get('/edit/{id}',[RoleController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[RoleController::class,'update'])->name('update');


        });
        Route::middleware('permission:إنشاء صلاحية')->group(function(){
            Route::get('/create',[RoleController::class,'create'])->name('create');
            Route::post('/store',[RoleController::class,'store'])->name('store');
        });


         Route::get('/',[RoleController::class,'index'])->name('index')->middleware('permission:عرض صلاحية');
         Route::post('/delete/{id}',[RoleController::class,'destroy'])->name('delete')->middleware('permission:حذف صلاحية');
        });

        Route::middleware('permission:جميع الصلاحيات super_admin')->prefix('/setting')->name('setting.')->group(function($q){
        Route::get('/home',[SettingController::class,'homePage'])->name('home');
        Route::post('/home/edit',[SettingController::class,'updatehomePage'])->name('home.update');
        Route::get('/aboutus',[SettingController::class,'aboutusPage'])->name('aboutus');
        Route::post('/aboutus/edit',[SettingController::class,'updateaboutUs'])->name('aboutus.update');
        Route::get('/monthly/subscribe/page',[SettingController::class,'monthlyPage'])->name('monthlypage');
        Route::post('/monthly/subscribe/update',[SettingController::class,'updatemonthlyPage'])->name('monthlypage.update');
        Route::get('/general/information/page',[SettingController::class,'generalInfoPage'])->name('general.info.page');
        Route::post('/general/information/update',[SettingController::class,'updategeneralInfoPage'])->name('general.info.update');
        });
     });
});
