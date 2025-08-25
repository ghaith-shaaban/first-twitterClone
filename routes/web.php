<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;

route::group(['middleware'=>'guest'],function(){
Route::get('/register',[AuthController::class,'register'])->name('register');

Route::post('/register',[AuthController::class,'store']);

Route::get('/login',[AuthController::class,'login'])->name('login');

Route::post('/login',[AuthController::class,'auth']);

});

Route::get('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');






Route::group(['prefix'=>'admin/','as'=>'admin','middleware'=>['auth','can:admin']],function(){

Route::get('/',[AdminController::class,'index'] );

Route::get('/users',[AdminController::class,'showUsers'] )->name('.users');

Route::get('/ideas',[AdminController::class,'showideas'] )->name('.ideas');

Route::get('/comments',[AdminController::class,'showcomments'] )->name('.comments');

Route::delete('/comments/{comment}',[AdminController::class,'destroy'] )->name('.comment.destroy');
});




Route::get('/feed',FeedController::class )-> name('feed')->middleware('auth');

Route::get('/',[MainController::class,'index'] )-> name('main');

route::get('/profile',[UserController::class,'profile'])->middleware('auth')->name('profile');

Route::post('/user/{user}/follow',[MainController::class,'follow'])->middleware('auth')->name('user.follow');

Route::post('/user/{user}/unfollow',[MainController::class,'unfollow'])->middleware('auth')->name('user.unfollow');

Route::post('/idea/{idea}/toggle-like',[MainController::class,'toggleLike'])->middleware('auth')->name('idea.toggle.like');

Route::resource('/user',UserController::class)->only('show');

Route::resource('/user',UserController::class)->only('edit','update')->middleware('auth');


Route::post('/submit',[IdeaController::class,'sub'] )-> name('submit');

Route::group(['prefix'=>'idea/','as'=>'idea.','middleware'=>['auth']],function () {

    Route::delete('/{id}',[IdeaController::class,'destroy'] )-> name('destroy');

    Route::get('/{id}/edit',[IdeaController::class,'edit'] )-> name('edit');

    Route::get('/{id}',[IdeaController::class,'show'] )-> name('show')->withoutMiddleware(['auth']);

    Route::put('/{id}',[IdeaController::class,'update'] )-> name('update');

    Route::post('/{idea}/comment',[CommentController::class,'store'] )-> name('comment.store');

});

