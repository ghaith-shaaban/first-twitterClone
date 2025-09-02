<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\NotificationController;

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

Route::get('/',[MainController::class,'index'] )-> name('main');

Route::post('/user/{user}/follow',[MainController::class,'follow'])->middleware('auth')->name('user.follow');

Route::post('/user/{user}/unfollow',[MainController::class,'unfollow'])->middleware('auth')->name('user.unfollow');

Route::post('/idea/{idea}/toggle-like',[MainController::class,'toggleLike'])->middleware('auth')->name('idea.toggle.like');

Route::get('/feed',FeedController::class )->middleware('auth')-> name('feed');

Route::get('/notification',NotificationController::class )->middleware('auth')-> name('notification');

Route::get('/profile',[UserController::class,'profile'])->middleware('auth')->name('profile');

// Route::resource('/user',UserController::class)->only('show');

Route::get('/user/{user}',[UserController::class,'show'])->name('user.show');

Route::resource('/user',UserController::class)->only('edit','update')->middleware('auth');


