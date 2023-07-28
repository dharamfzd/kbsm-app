<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;

// For Admin
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('student', StudentController::class);

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    // For User
    Route::group(['prefix'=>'/', 'middleware'=>'checkUser'],function(){
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::get('notification', [NotificationController::class, 'index'])->name('notification');
    });
    // For Admin
    Route::group(['prefix'=>'admin', 'middleware'=>'checkAdmin'],function(){
        Route::get('home', [HomeController::class, 'adminHome'])->name('admin-home');
        Route::prefix('users')->group(function () {
            Route::get('create', [UserController::class, 'create'])->name('add.user');
            Route::post('store', [UserController::class, 'store'])->name('user.store');
            Route::get('send-notification', [UserController::class, 'sendNotification'])->name('send.notification');
            Route::post('send-notification', [UserController::class, 'sendNotification'])->name('send.notification');
        });
    });
});
