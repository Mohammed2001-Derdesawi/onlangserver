<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Modules\User\Http\Controllers\CartController;
use Modules\User\Http\Controllers\UserController;

use Modules\User\Http\Controllers\LevelController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\User\Http\Controllers\MessageController;
use Modules\User\Http\Controllers\PaymentController;
use Modules\Course\Http\Controllers\ReviewController;
use Modules\User\Http\Controllers\CampaignController;
use Modules\User\Http\Controllers\PlaylistController;
use Modules\User\Http\Controllers\WithdrawController;


use Modules\Course\Http\Controllers\ArticleController;
use Modules\User\Http\Controllers\AffiliateController;
use Modules\User\Http\Controllers\StatisticController;
use App\Http\Controllers\Auth\ChangePasswordController;
use Modules\User\Http\Controllers\NotificationController;
use Modules\User\Http\Controllers\SubscriptionController;
use Modules\User\Http\Controllers\AdminMessagesController;
use Modules\User\Http\Controllers\AdminNotificationController;

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
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function() {

    Route::prefix('students')->name('student.')->group(function () {
        Route::middleware('permission:إنشاء طالب')->group(function(){
            Route::get('/create', [UserController::class,'create'])->name('create');
            Route::post('/store', [UserController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل طالب')->group(function(){
            Route::get('/edit/{id}', [UserController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [UserController::class,'update'])->name('update');
        });
        Route::get('/', [UserController::class,'index'])->name('index')->middleware('permission:عرض طالب');


        Route::post('/delete/{id}', [UserController::class,'destroy'])->name('delete')->middleware('permission:حذف طالب');
    });
    Route::prefix('messages')->name('message.')->group(function () {
        Route::middleware('permission:إنشاء الرسائل')->group(function(){
            Route::get('/inbox', [AdminMessagesController::class,'index'])->name('index');
        });
        Route::middleware('permission:عرض الرسائل')->group(function(){
            Route::get('/chat', [AdminMessagesController::class,'chat'])->name('chat');
        });
        Route::middleware('permission:إرسال الرسائل')->group(function(){
            Route::get('/outside', [AdminMessagesController::class,'outsideMessages'])->name('outside');
            Route::post('/outside/send/emails', [AdminMessagesController::class,'outsideMessagesSent'])->name('outside.email.sent');        });

    });
    Route::prefix('campaigns')->name('campaign.')->group(function () {
        Route::middleware('permission:إنشاء نظام التربح')->group(function(){
            Route::get('/create', [CampaignController::class,'create'])->name('create');
        Route::post('/store', [CampaignController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل نظام التربح')->group(function(){
            Route::get('/edit/{id}', [CampaignController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [CampaignController::class,'update'])->name('update');
        });

        Route::get('/', [CampaignController::class,'index'])->name('index')->middleware('permission:عرض نظام التربح');
        Route::post('/delete/{id}', [CampaignController::class,'destroy'])->name('delete')->middleware('permission:حذف نظام التربح');
    });
    Route::prefix('levels')->name('level.')->group(function () {
        Route::middleware('permission:إنشاء مستوى')->group(function(){
            Route::get('/create', [LevelController::class,'create'])->name('create');
            Route::post('/store', [LevelController::class,'store'])->name('store');
        });
        Route::middleware('permission:تعديل مستوى')->group(function(){
            Route::get('/edit/{id}', [LevelController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [LevelController::class,'update'])->name('update');
        });

        Route::get('/', [LevelController::class,'index'])->name('index')->middleware('permission:عرض مستوى');
        Route::post('/delete/{id}', [LevelController::class,'destroy'])->name('delete')->middleware('permission:حذف مستوى');
    });
    Route::middleware('permission:إحصائيات نظام التربح')->prefix('statistics')->name('statistic.')->group(function () {
        Route::get('/', [StatisticController::class,'usersStatistics'])->name('users');
        Route::get('/user/{id}', [StatisticController::class,'userStatisticToAdmin'])->name('user');

    });

});
// Route::middleware('admin')->name('admin.')->prefix('admin')->group(function() {

//     Route::name('settings.')->prefix('/settings')->group(function() {
//     Route::get('/other/payments', [AdminController::class,'otherPaymentSettings'])->name('other_payments.index');
//     Route::post('/other/payments/edit', [AdminController::class,'updateOtherPaymentSettings'])->name('other_payments.edit');
//     Route::get('/aboutus', [AdminController::class,'aboutUsSetting'])->name('aboutus.index');
//     Route::post('/aboutus/edit', [AdminController::class,'updateAboutUsSetting'])->name('aboutus.edit');
//     Route::get('/contactus', [AdminController::class,'contactUSSetting'])->name('contactus.index');
//     Route::post('/contactus/edit', [AdminController::class,'updateContactUsSetting'])->name('contactus.edit');
//     Route::get('/variouses', [AdminController::class,'variousesSetting'])->name('variouses.index');
//     Route::post('/variouses/edit', [AdminController::class,'updateVariousesSetting'])->name('variouses.edit');

//     Route::get('/google/ads', [AdminController::class,'googelAdsSetting'])->name('google.ads');
//     Route::post('/google/ads/edit', [AdminController::class,'updategoogelAdsSetting'])->name('google.ads.edit');

//         // Settings routess
//     });


// });


    Route::middleware('LimitLoginDevices')->group(function () {
    Route::get('/', [UserController::class , 'mainPage'])->name('home'); //Main Page route

    Route::view('contactUs', 'user::User.contactUs')->name('contactUs');
    Route::get('aboutUs', [UserController::class , 'aboutUs'])->name('aboutUs');


    Route::post('submitReview/{id}', [ReviewController::class ,'submitReview'])->name('submit.review');

   Route::prefix('/affiliates')->name('affiliate.')->group(function(){
    Route::middleware(['auth' , 'verified'])->group(function (){
        Route::post('/subscribes', [AffiliateController::class , 'subscribes'])->name('subscribes');
        Route::get('my/statistics/', [StatisticController::class , 'userStatisticToUser'])->name('my.statistics');
        Route::get('wallet/withdrawals/', [WithdrawController::class , 'withdrawPage'])->name('wallet.withdrawpage');
        Route::post('wallet/withdrawal/money', [WithdrawController::class , 'withdrawal'])->name('wallet.withdrawal');
        Route::any('wallet/withdrawal/confirm/account', [WithdrawController::class , 'confirmCompleteBoardingAccount'])->name('wallet.withdrawal.confrim.onboarding');
        Route::get('wallet/withdrawal/create/account',[WithdrawController::class,'createExpressAccount'])->name('wallet.withdrawal.create_account');
        Route::get('wallet/withdrawal/complete/account',[WithdrawController::class,'redirectToCompleteOnBoarding'])->name('wallet.withdrawal.complete_account');
        Route::get('wallet/withdrawal/login/to/account',[WithdrawController::class,'loginToExpressDashboard'])->name('wallet.withdrawal.login_account');
    });
    
    Route::get('/', [AffiliateController::class , 'affiliates'])->name('all.details');
    Route::get('/campaign/details/{slug}', [AffiliateController::class , 'compaignDetails'])->name('campaign.details');
   });



    Route::get('Payments/private', [PaymentController::class,'privatePayment'])->name('private.payment');
    Route::post('otherPayment', [PaymentController::class,'otherPayment'])->name('other.payment');
    Route::get('otherPayment/Confirm', [PaymentController::class,'otherPaymentConfirm'])->name('other.payment.confirm');


    Route::middleware('auth')->group(function () {
        Route::get('profile', [UserController::class,'profile'])->name('profile');
        Route::post('profile/update', [UserController::class ,'profileUpdate'])->name('profile.update');
        Route::get('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

        Route::get('show/myProfile', [UserController::class ,'profileShow'])->name('profile.show');
        Route::get('checkout', [CartController::class,'checkout_details'])->name('checkout.details');



        Route::get('my-subscription/info', [SubscriptionController::class, 'subscriptionInfo'])->name('subscription.Info');

        Route::post('payment', [PaymentController::class, 'payment'])->name('stripe.payment')->middleware('auth');
        Route::any('confirm/payment/{email}', [PaymentController::class, 'confirmPayment'])->name('confirm.payment')->middleware('auth');
        Route::post('variousPayment', [PaymentController::class, 'various_payment'])->name('various.payment')->middleware('auth');
        Route::any('variousPayment/payment/confirm', [PaymentController::class, 'variousPaymentConfirm'])->name('various.payment.confirm')->middleware('auth');
        Route::get('paidVideos/subscription', [SubscriptionController::class, 'variousPaymentSubscription'])->name('various.payment.subscription')->middleware('auth');
        Route::post('variouses/subscribtion', [SubscriptionController::class, 'processPlan'])->name('processPlan');
        Route::post('varioues/subscribtion/cancel', [PaymentController::class, 'cancelSubscription'])->name('variouses.subscriptions.cancel');
        Route::get('varioues/unsubscribtion', [PaymentController::class, 'unSubscribed'])->name('variouses.unsubscribtion');


        Route::name('user.')->group(function () {
            Route::prefix('playlists')->name('playlist.')->group(function () {
                Route::post('store/admin/Playlist/', [PlaylistController::class, 'addAdminPlayListToMy'])->name('store.admin');
                Route::post('store/video/to/playlist', [PlaylistController::class, 'SaveVideoToPlaylist'])->name('video.save.to');
                Route::post('store/', [PlaylistController::class, 'StorePlaylist'])->name('store');
            });
            Route::prefix('/messages')->name('message.')->group(function (){
                Route::get('/',[MessageController::class,'messagesPage'])->name('index');
                Route::post('/send/to/onlanguage',[MessageController::class,'sendMessageToAdmin'])->name('send.to.onlanguages');
            });
            Route::prefix('/notifications')->name('notification.')->group(function (){

                Route::get('/',[NotificationController::class,'mynotifications'])->name('all');
                Route::get('/mark/as/read/notify={id}',[NotificationController::class,'markAsRead'])->name('markasread');
            });

        });



    });

    Route::get('cart', [CartController::class,'cartDetails'])->name('cart.details');
    Route::post('remove/cart/{id}', [CartController::class,'removeCart'])->name('cart.remove');
   });

