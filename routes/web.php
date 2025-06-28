<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\maincontroller;
use App\Http\Controllers\addcontroller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\userController;
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
use App\Http\Controllers\authController;
use App\Http\Controllers\feedController;

route::group(['middleware'=>'guest'],function(){
Route::get('/register',[authController::class,'register'])->name('register');

Route::post('/register',[authController::class,'store']);

Route::get('/login',[authController::class,'login'])->name('login');

Route::post('/login',[authController::class,'auth']);

});

Route::get('/logout',[authController::class,'logout'])->middleware('auth')->name('logout');






Route::group(['prefix'=>'admin/','as'=>'admin','middleware'=>['auth','can:admin']],function(){

Route::get('/',[adminController::class,'index'] );

Route::get('/users',[adminController::class,'showUsers'] )->name('.users');

Route::get('/ideas',[adminController::class,'showideas'] )->name('.ideas');

Route::get('/comments',[adminController::class,'showcomments'] )->name('.comments');

Route::delete('/comments/{comment}',[adminController::class,'destroy'] )->name('.comment.destroy');
});




Route::get('/feed',feedController::class )-> name('feed')->middleware('auth');

Route::get('/',[maincontroller::class,'index'] )-> name('main');

route::get('/profile',[userController::class,'profile'])->middleware('auth')->name('profile');

Route::post('/user/{user}/follow',[mainController::class,'follow'])->middleware('auth')->name('user.follow');

Route::post('/user/{user}/unfollow',[mainController::class,'unfollow'])->middleware('auth')->name('user.unfollow');

Route::post('/idea/{idea}/like',[mainController::class,'like'])->middleware('auth')->name('idea.like');

Route::post('/idea/{idea}/unlike',[mainController::class,'unlike'])->middleware('auth')->name('idea.unlike');

Route::resource('/user',userController::class)->only('show');

Route::resource('/user',userController::class)->only('edit','update')->middleware('auth');


// Route::put('/{user}',[userController::class,'update'] )->middleware('auth')-> name('user.update');
// Route::get('/{user}/edit',[userController::class,'edit'] )->middleware('auth')-> name('user.edit');
// Route::get('/{user}',[userController::class,'show'] )->middleware('auth')-> name('user.show');

Route::post('/submit',[addcontroller::class,'sub'] )-> name('submit');

Route::group(['prefix'=>'idea/','as'=>'idea ','middleware'=>['auth']],function () {

    Route::delete('/{id}',[addcontroller::class,'destroy'] )-> name('destroy');

    Route::get('/{id}/edit',[addcontroller::class,'edit'] )-> name('edit');

    Route::get('/{id}',[addcontroller::class,'show'] )-> name('show')->withoutMiddleware(['auth']);

    Route::put('/{id}',[addcontroller::class,'update'] )-> name('update');

    Route::post('/{idea}/comment',[CommentController::class,'store'] )-> name('comment store');

});

