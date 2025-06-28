<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\idea;
class maincontroller extends Controller
{
    public function follow(user $user){
        $follower=auth()->user();

        $follower->following()->attach($user['id']);

        return redirect()->route('user.show',$user['id'])->with('success','followed successfully!');
    }

    public function unfollow(user $user){
        $follower=auth()->user();

        $follower->following()->detach($user['id']);

        return redirect()->route('user.show',$user['id'])->with('success','unfollowed successfully!');
    }

    public function index(){

        // $idea =new idea([ "idea" =>"test ghaith12","likes" =>62]);

        // $idea->save();

        $ideas=idea::with('user:id,name,image','comments.user:id,name,image')->withCount('likes')->orderBy('created_at','DESC');
        if(request()->has('search'))
        {
            $ideas=$ideas->search(request('search'));
        }

        return view('main',['ideas'=>$ideas->paginate(5)]);

    }

    public function like(idea $idea){
        $liked_user=auth()->user();
        $liked_user->likes()->attach($idea['id']);
        // $idea->likes()->attach(auth()->id());
        return redirect()->route('idea show',$idea['id'])->with('success','liked successfully!');
    }

  public function unlike(idea $idea){
    $liked_user=auth()->user();
    $liked_user->likes()->detach($idea['id']);
    return redirect()->route('idea show',$idea['id'])->with('success','liked successfully!');
    }
}
