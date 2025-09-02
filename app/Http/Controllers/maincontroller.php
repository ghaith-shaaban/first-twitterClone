<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\idea;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function follow(user $user){
        $follower=Auth::user();

        $follower->following()->attach($user['id']);

        return redirect()->route('user.show',$user['id'])->with('success','followed successfully!');
    }

    public function unfollow(user $user){
        $follower=Auth::user();

        $follower->following()->detach($user['id']);

        return redirect()->route('user.show',$user['id'])->with('success','unfollowed successfully!');
    }

    public function index(){

        if(request()->has('search'))
        {
            $query=idea::search(request('search'));
        }
        else
        {
            $query=idea::with('user:id,name,image','comments.user:id,name,image')
            ->withCount('likes')->orderBy('created_at','DESC');
        }

        $ideas=$query->paginate(5);

        return view('main',compact('ideas'));

    }

    public function toggleLike(idea $idea){
        $liked_user=Auth::user();
        $liked_user->likes()->toggle($idea->id);

        return redirect()->route('idea.show',$idea->id)->with('success','liked successfully!');
    }

}
