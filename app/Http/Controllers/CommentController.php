<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\idea;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use AuthorizesRequests;
    public function store(idea $idea){
        // try{
            request()->validate(['comment'=>'required|min:2|max:240']);
            $comment=new comment();
            $comment->idea_id = $idea['id'];
            $comment->user_id =Auth::id();
            $comment->content=request()->get('comment');
            $comment->save();

            return redirect()->route('idea.show',$idea['id'])->with('success','comment posted successfully!');
        // }
        // catch(Exception $e)
        // {return back()->withErrors(['comment'=>'failed to post comment']); }
    }

    public function destroy(comment $comment){

        $this->authorize('delete',$comment);

        $comment->delete();
        return redirect()->route('idea.show',$comment->idea->id)->with('success','comment deleted successfully');
    }

    public function edit(comment $editedcomment){
          $this->authorize('update',$editedcomment);
          $idea=$editedcomment->idea;
        return view('show_one',compact(['idea','editedcomment']));
    }

     public function update(comment $comment){

        $this->authorize('update',$comment);
        $validated=request()->validate(['content'=>'required|min:2|max:240']);
        $comment->update($validated);
        return redirect()->route('idea.show',$comment->idea->id)->with('success','comment updated successfully');
    }
}
