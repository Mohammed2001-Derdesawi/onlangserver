<?php

use Illuminate\Support\Facades\Route;
use Modules\Course\Entities\Attachment;
use Modules\User\Http\Controllers\CartController;
use Modules\User\Http\Controllers\UserController;
use Modules\Course\Http\Controllers\CourseController;
use Modules\Course\Http\Controllers\ReviewController;
use Modules\User\Http\Controllers\PlaylistController;
use Modules\Course\Http\Controllers\ArticleController;
use Modules\Course\Http\Controllers\LectureController;
use Modules\Course\Http\Controllers\OpinionController;
use Modules\Course\Http\Controllers\TeacherController;
use Modules\Course\Http\Controllers\VariousController;
use Modules\Course\Http\Controllers\LanguageController;
use Modules\Course\Http\Controllers\AttachmentController;
use Modules\Course\Http\Controllers\LikedVideosController;
use Modules\Course\Http\Controllers\VariousGroupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('admin')->prefix('admin/')->name('admin.')->group(function() {

    Route::post('/tinymic/upload/file',[AttachmentController::class,'tynymicUpload']);
    Route::prefix('languages/')->name('language.')->group(function() {

        Route::middleware('permission:إنشاء لغة')->group(function(){
            Route::get('/create',[LanguageController::class,'create'])->name('create');
            Route::post('/store',[LanguageController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل لغة')->group(function(){
            Route::get('/edit/{id}',[LanguageController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[LanguageController::class,'update'])->name('update');
        });

        Route::get('/',[LanguageController::class,'index'])->name('index')->middleware('permission:عرض لغة');
        Route::post('/delete/{id}',[LanguageController::class,'destroy'])->name('delete')->middleware('permission:حذف لغة');
    });
    Route::prefix('teachers/')->name('teacher.')->group(function() {

        Route::middleware('permission:إنشاء معلم')->group(function(){
            Route::get('/create',[TeacherController::class,'create'])->name('create');
            Route::post('/store',[TeacherController::class,'store'])->name('store');
        });

        Route::middleware('permission:تعديل معلم')->group(function(){
            Route::get('/edit/{id}',[TeacherController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[TeacherController::class,'update'])->name('update');
        });

        Route::get('/',[TeacherController::class,'index'])->name('index')->middleware('permission:عرض لغة');
        Route::post('/delete/{id}',[TeacherController::class,'destroy'])->name('delete')->middleware('permission:حذف لغة');
    });
    Route::prefix('courses/')->name('course.')->group(function() {

        Route::middleware('permission:إنشاء كورس')->group(function(){
            Route::get('/create',[CourseController::class,'create'])->name('create');
            Route::post('/store',[CourseController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل كورس')->group(function(){
            Route::get('/edit/{id}',[CourseController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[CourseController::class,'update'])->name('update');
        });
        Route::get('/',[CourseController::class,'index'])->name('index')->middleware('permission:عرض كورس');


        Route::post('/delete/{id}',[CourseController::class,'destroy'])->name('delete')->middleware('permission:حذف كورس');
        Route::get('/lectures/{id}',[LectureController::class,'getCourseLectures'])->name('lectures')->middleware('permission:عرض محاضرات كورس');
        Route::get('/upload/files/{id}',[CourseController::class,'uploadPage'])->name('upload.page')->middleware('permission:عرض ملف كورس');
        Route::post('/upload/file/{id}', [CourseController::class,'uploadFile'])->name('upload')->middleware('permission:رفع ملف كورس');
        Route::get('/attachment/download/{course}/{id}', [CourseController::class,'downloadAttachment'])->name('attachment.download');
        Route::post('/attachment/delete/{course}/{id}', [CourseController::class,'deleteAttachment'])->name('attachment.delete')->middleware('permission:حذف ملف كورس');
    });
    Route::prefix('lectures/')->name('lecture.')->group(function() {

        Route::middleware('permission:إنشاء محاضرة')->group(function(){
            Route::get('/create',[LectureController::class,'create'])->name('create');
            Route::post('/store',[LectureController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل محاضرة')->group(function(){
            Route::get('/edit/{id}',[LectureController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[LectureController::class,'update'])->name('update');
        });
        Route::get('/',[LectureController::class,'index'])->name('index')->middleware('permission:عرض محاضرة');


        Route::post('/delete/{id}',[LectureController::class,'destroy'])->name('delete')->middleware('permission:حذف محاضرة');
        Route::get('/upload/files/{id}',[LectureController::class,'uploadPage'])->name('upload.page')->middleware('permission:عرض ملف محاضرة');
        Route::post('/upload/file/{id}', [LectureController::class,'uploadFile'])->name('upload')->middleware('permission:رفع ملف محاضرة');
        Route::get('/attachment/download/{lecture}/{id}', [LectureController::class,'downloadAttachment'])->name('attachment.download');
        Route::post('/attachment/delete/{lecture}/{id}', [LectureController::class,'deleteAttachment'])->name('attachment.delete')->middleware('permission:حذف ملف محاضرة');
    });
    Route::prefix('articles/')->name('article.')->group(function() {

        Route::middleware('permission:إنشاء مقال')->group(function(){
            Route::get('/create',[ArticleController::class,'create'])->name('create');
            Route::post('/store',[ArticleController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل مقال')->group(function(){
            Route::get('/edit/{id}',[ArticleController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[ArticleController::class,'update'])->name('update');
        });
        Route::get('/',[ArticleController::class,'index'])->name('index')->middleware('permission:عرض مقال');


        Route::post('/delete/{id}',[ArticleController::class,'destroy'])->name('delete')->middleware('permission:حضف مقال');
        Route::get('/upload/files/{id}',[ArticleController::class,'uploadPage'])->name('upload.page')->middleware('permission:عرض ملف مقال');
        Route::post('/upload/file/{id}', [ArticleController::class,'uploadFile'])->name('upload')->middleware('permission:رفع ملف مقال');
        Route::get('/attachment/download/{article}/{id}', [ArticleController::class,'downloadAttachment'])->name('attachment.download');
        Route::post('/attachment/delete/{article}/{id}', [ArticleController::class,'deleteAttachment'])->name('attachment.delete')->middleware('permission:حذف ملف مقال');
    });
    Route::prefix('groups/')->name('group.')->group(function() {

        Route::middleware('permission:إنشاء البلاي ليست')->group(function(){
            Route::get('/create',[VariousGroupController::class,'create'])->name('create');
            Route::post('/store',[VariousGroupController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل البلاي ليست')->group(function(){
            Route::get('/edit/{id}',[VariousGroupController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[VariousGroupController::class,'update'])->name('update');
        });
        Route::get('/',[VariousGroupController::class,'index'])->name('index')->middleware('permission:عرض البلاي ليست');


        Route::post('/delete/{id}',[VariousGroupController::class,'destroy'])->name('delete')->middleware('permission:حذف البلاي ليست');

    });
    Route::prefix('variouses/')->name('various.')->group(function() {
        Route::middleware('permission:إنشاء منوعة')->group(function(){
            Route::get('/create',[VariousController::class,'create'])->name('create');
            Route::post('/store',[VariousController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل منوعة')->group(function(){
            Route::get('/edit/{id}',[VariousController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[VariousController::class,'update'])->name('update');
        });
        Route::get('/',[VariousController::class,'index'])->name('index')->middleware('permission:عرض منوعة');


        Route::post('/delete/{id}',[VariousController::class,'destroy'])->name('delete')->middleware('permission:حذف منوعة');
        Route::get('/upload/files/{id}',[VariousController::class,'uploadPage'])->name('upload.page')->middleware('permission:عرض ملف منوعة');
        Route::post('/upload/file/{id}', [VariousController::class,'uploadFile'])->name('upload')->middleware('permission:رفع ملف منوعة');
        Route::get('/attachment/download/{various}/{id}', [VariousController::class,'downloadAttachment'])->name('attachment.download');
        Route::post('/attachment/delete/{various}/{id}', [VariousController::class,'deleteAttachment'])->name('attachment.delete')->middleware('permission:حذف ملف منوعة');
    });
    Route::prefix('opinions/')->name('opinion.')->group(function() {
        Route::middleware('permission:إنشاء رأي')->group(function(){
            Route::get('/create',[OpinionController::class,'create'])->name('create');
        Route::post('/store',[OpinionController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل رأي')->group(function(){
            Route::get('/edit/{id}',[OpinionController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[OpinionController::class,'update'])->name('update');
        });

        Route::get('/',[OpinionController::class,'index'])->name('index')->middleware('permission:عرض الرأي');

        Route::post('/delete/{id}',[OpinionController::class,'destroy'])->name('delete')->middleware('permission:حذف الرأي');
    });
    Route::prefix('reviews')->name('review.')->group(function() {

        Route::get('/',[ReviewController::class,'index'])->name('index')->middleware('permission:عرض تقييم');
        Route::post('/delete/{id}',[ReviewController::class,'destroy'])->name('delete')->middleware('permission:حذف تقييم');

    });
});



Route::name('user.')->group(function() {

    Route::get('articles', [ArticleController::class , 'showAllArticles'])->name('allArticles'); // Route For Get All Articles
    Route::get('article/{slug}', [ArticleController::class , 'showArticle'])->name('showArticle'); //Route For Show specefic Article

    Route::get('allCourses', [LanguageController::class , 'showAllLanguages'])->name('allCourses'); // Route For Get All Langusges
    Route::get('allCourses/{slug}', [CourseController::class , 'showAllCourses'])->name('coursesList'); // Route For Get All Articles
    Route::get('course/{slug}', [CourseController::class , 'showcourseDetailsPage'])->name('courseDetails'); // Route For Get All Articles
    Route::post('course/like/video/{id}',  [CourseController::class ,'coursesLikedVideos'])->name('courses.liked.videos')->middleware('auth');

    Route::get('download/course/attachment/{courseId}/{attachmentId}',  [AttachmentController::class ,'downloadCourseAttachment'])->name('Download.course.attachment');
    Route::get('download/lecture/attachment{lectureId}/{attachmentId}',  [AttachmentController::class ,'downloadLectureAttachment'])->name('Download.lecture.attachment');
    Route::get('my/courses',  [CourseController::class ,'myCourses'])->name('myCourses')->middleware('auth');
    Route::post('lecture/notes', [CourseController::class, 'storeNote'])->name('lecture.notes.store');
    Route::get('/notes/session', [CourseController::class, 'getSessionNotes'])->name('notes.session');


     Route::get('lectures/{id}', [LectureController::class , 'showLectures'])->name('showLecture'); // Route For Get All lectures
     Route::post('lecture/like/video/{id}',  [LectureController::class ,'lecturesLikedVideos'])->name('lectures.liked.videos')->middleware('auth');

     Route::get('teachers/{slug}', [TeacherController::class , 'showTeacher'])->name('showTeacher'); // Route For Get All Teachers
     Route::get('teachers', [TeacherController::class , 'allteachers'])->name('teachers');


     Route::get('privateTeachers/{slug}', [TeacherController::class , 'showPrivateTeacher'])->name('showPrivateTeacher'); // Route For Get All Teachers
     Route::get('privateTeeachers', [TeacherController::class , 'allPrivateTeacher'])->name('privateTeachers');



     Route::get('Paid/Playlist',  [VariousGroupController::class ,'showAllPaidPlayLists'])->name('paidPlayList');
     Route::get('Free/Playlist',  [VariousGroupController::class ,'showAllFreePlayList'])->name('freePlayList');

     Route::post('/record-whatsapp',  [UserController::class ,'recordWhatsapp'])->name('recordWhatsapp');

 Route::get('Free/Videos/show/{id}',  [VariousController::class ,'showOneFreeVideo'])->name('freeVideoShow');
 
     Route::middleware('auth')->group(function(){
        Route::middleware('checksubscribed')->group(function(){

            Route::get('PlayList/Paid/Videos/{id}',  [VariousController::class ,'showAllPaidVideos'])->name('paidVideos');
            Route::get('Paid/Videos/show/{id}',  [VariousController::class ,'showOnePiadVideo'])->name('paidVideoShow');
            Route::get('playlist/get/user/where/video={video}',  [PlaylistController::class ,'getUserPlaylistFromVideo'])->name('get.user.playlist.from.video');

            Route::get('Playlist/videos/{playlistId}/{id}', [PlaylistController::class, 'showMyPlaylistOneVideo'])->name('show.playlist.video');

        });
        Route::post('like/video/{id}',  [VariousController::class ,'likedVideos'])->name('liked.videos');

        Route::get('my/LikedVideos',  [variousController::class ,'mylikedVideos'])->name('myliked');
        Route::post('add/watchlater',  [variousController::class ,'addWatchlaters'])->name('add.to.watchlater');
        Route::get('my/watchlater',  [variousController::class ,'myWatchLaterVideos'])->name('my.watchlater');
        Route::post('delete/Playlist/{id}',  [variousController::class ,'deleteFromMyWatchLater'])->name('delete.from.watchlater');

         Route::get('playlist/default/add/to/my/playlists/{id}',  [VariousGroupController::class ,'addAdminPlayListToMy'])->name('addAdminPlayListToMy');
         Route::get('PlayList/Free/Videos/{id}',  [VariousController::class ,'showAllFreeVideos'])->name('freeVideos');
        
         Route::get('download/various/attachment{variousId}/{attachmentId}',  [AttachmentController::class ,'downloadVariousAttachment'])->name('Download.various.attachment');

         Route::get('my/Playlist',  [PlaylistController::class ,'myPlaylists'])->name('my.playlist');

         Route::get('my/Playlist/videos/{id}',  [PlaylistController::class ,'ShowMyPlaylistsVideos'])->name('my.playlistVideos');
         Route::post('my/Playlist/update/{id}',  [PlaylistController::class ,'updatePlaylist'])->name('playlist.update');
         Route::post('my/Playlist/delete/{id}',  [PlaylistController::class ,'deletePlaylist'])->name('playlist.delete');
         Route::post('my/Playlist/video/delete/{playlistId}/{id}',  [PlaylistController::class ,'deleteVideoFromPlaylist'])->name('remove.from.playlist');

         Route::post('courseReviews/{id}', [ReviewController::class ,'courseReview'])->name('course.review');
         Route::post('articleReviews/{id}', [ReviewController::class ,'articleReview'])->name('article.review');
         Route::post('variousReviews/{id}', [ReviewController::class ,'variousReview'])->name('various.review');

     });




});


// Add to Cart Store Data
Route::post('cart/data/store/', [CartController::class, 'AddToCart']);
Route::post('cart/data/course/store/', [CartController::class, 'AddOneToCart']);

Route::get('cart/data/num', [CartController::class, 'cartnumber']);


// Get Data from mini cart



