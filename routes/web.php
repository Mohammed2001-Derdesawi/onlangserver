<?php

use Modules\User\Entities\Playlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use Modules\User\Entities\Level;
use Modules\User\Http\Controllers\CartController;
use Illuminate\Support\Facades\Artisan;
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
Route::post('/contact_submit', [App\Http\Controllers\EmailController::class, 'submitContactForm'])->name('contact_submit');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Route::get('/test',function(){
//         Artisan::call('migrate:fresh --seed');
//           Artisan::call('schedule:work');
// });
// dd('done');
