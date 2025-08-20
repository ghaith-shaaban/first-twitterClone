<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\idea;
class Maincontroller extends Controller
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

        $ideas=idea::with('user:id,name,image','comments.user:id,name,image')->withCount('likes')->orderBy('created_at','DESC');
        if(request()->has('search'))
        {
            $ideas=$ideas->search(request('search'));
        }

        return view('main',['ideas'=>$ideas->paginate(5)]);

    }

    public function toggleLike(idea $idea){
        $liked_user=auth()->user();
        $liked_user->likes()->toggle($idea->id);

        return redirect()->route('idea show',$idea->id)->with('success','liked successfully!');
    }

}
