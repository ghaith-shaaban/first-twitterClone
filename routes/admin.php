<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::group(['prefix'=>'admin/','as'=>'admin','middleware'=>['auth','can:admin']],function(){

Route::get('/',[AdminController::class,'index'] );

Route::get('/users',[AdminController::class,'showUsers'] )->name('.users');

Route::get('/ideas',[AdminController::class,'showideas'] )->name('.ideas');

Route::get('/comments',[AdminController::class,'showcomments'] )->name('.comments');

Route::delete('/comments/{comment}',[AdminController::class,'destroy'] )->name('.comment.destroy');
});
