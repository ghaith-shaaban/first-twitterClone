<?php

namespace App\Http\Controllers;

use App\Models\idea;
use App\Models\User;
use Illuminate\Http\Request;

class feedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
      $users_followed=auth()->user()->following()->pluck('user_id');

        $ideas=idea::with('user:id,name,image','comments.user:id,name,image')->whereIn('user_id',$users_followed)->orderBy('created_at','DESC');
        if(request()->has('search'))
        {
            $ideas=$ideas->search(request('search'));
        }

        return view('main',['ideas'=>$ideas->paginate(5)]);

    }
}
