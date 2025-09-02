<?php

namespace App\Http\Controllers;

use App\Models\idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
      $users_followed=Auth::user()->following()->pluck('user_id');

      if(request()->has('search'))
        {
            $query=idea::search(request('search'))->whereIn('user_id',$users_followed);
        }
        else
        {
        $query=idea::with('user:id,name,image','comments.user:id,name,image')->whereIn('user_id',$users_followed)->orderBy('created_at','DESC');
        }

        $ideas=$query->paginate(5);

        return view('main',compact('ideas'));

    }
}
