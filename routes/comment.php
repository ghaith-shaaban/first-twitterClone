
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;



Route::group(['prefix'=>'comment/','as'=>'comment.','middleware'=>['auth']],function () {

    Route::post('/{idea}/comment',[CommentController::class,'store'] )-> name('store');
    //idea wild card because you need the idea id to create a comment on it

    Route::delete('/{comment}',[CommentController::class,'destroy'] )-> name('destroy');

    Route::get('/{editedcomment}/edit',[CommentController::class,'edit'] )-> name('edit');

    Route::put('/{comment}',[CommentController::class,'update'] )-> name('update');
});
