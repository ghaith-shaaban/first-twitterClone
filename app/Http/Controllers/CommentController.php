<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(idea $idea){
        // dd($idea);
        request()->validate(['comment'=>'required|min:2|max:240']);
        $comment=new comment();
        $comment->idea_id = $idea['id'];
        $comment->user_id =auth()->id();
        $comment->com=request()->get('comment');
        $comment->save();

        return redirect()->route('idea show',$idea['id'])->with('success','comment posted successfully!');

    }
}
