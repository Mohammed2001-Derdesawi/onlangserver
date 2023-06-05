<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Api\AdminApiMessagesController;

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

Route::name('admin.')->prefix('/admin')->group(function () {
    Route::prefix('messages')->name('message.')->group(function() {
        Route::get('/get/users',[AdminApiMessagesController::class,'getUsers'])->name('get.users');
        Route::post('/users/send/messages',[AdminApiMessagesController::class,'store'])->name('users.send');
        // group messages
        Route::prefix('/groups')->name('group.')->group(function(){
            Route::get('/',[AdminApiMessagesController::class,'getGroups'])->name('index');
            Route::post('/store',[AdminApiMessagesController::class,'storeGroup'])->name('store');
            Route::post('/delete/{id}',[AdminApiMessagesController::class,'deleteGroup'])->name('delete');
            Route::post('/update/{id}',[AdminApiMessagesController::class,'updateGroup'])->name('update');
            Route::post('/users/add/',[AdminApiMessagesController::class,'addUsersToroup'])->name('user.add');
            Route::post('/users/delete/',[AdminApiMessagesController::class,'deleteUsersFromGroup'])->name('user.delete');
        });
        // end group messages

        // start users messages

        Route::prefix('/users')->name('user.')->group(function(){
            Route::get('get/to/admin/{id}',[AdminApiMessagesController::class,'getReceivedMessagesToAdmin'])->name('get.to.admin');
            Route::get('/chat/{user}/with/admin/{admin}',[AdminApiMessagesController::class,'getMessagesBetween'])->name('chat.between.admin');
            Route::post('/chat/send/to/user/from/admin',[AdminApiMessagesController::class,'SendMessageToUser'])->name('chat.between.admin');
            Route::post('/chat/mark/as/read',[AdminApiMessagesController::class,'MarkAsRead'])->name('chat.between.admin');

        });

        // end users messages

    });
});
