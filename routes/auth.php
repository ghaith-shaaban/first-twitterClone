<?php

use App\Http\Controllers\authController;
use Illuminate\Routing\Route;

Route::get('/register',[authController::class,'register'])->name('register');

Route::post('/register',[authController::class,'store']);

Route::get('/login',[authController::class,'login'])->name('login');

Route::post('/login',[authController::class,'auth']);

Route::get('/logout',[authController::class,'logout'])->name('logout');

?>
