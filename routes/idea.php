<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;



Route::group(['prefix'=>'idea/','as'=>'idea.','middleware'=>['auth']],function () {

    Route::post('/create',[IdeaController::class,'create'] )-> name('create');

    Route::delete('/{idea}',[IdeaController::class,'destroy'] )-> name('destroy');

    Route::get('/{idea}/edit',[IdeaController::class,'edit'] )-> name('edit');

    Route::get('/{idea}',[IdeaController::class,'show'] )->withoutMiddleware(['auth'])-> name('show');

    Route::put('/{idea}',[IdeaController::class,'update'] )-> name('update');

});
