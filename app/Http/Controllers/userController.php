<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateUserRequest;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function show(User $user)
    {

        if(request()->has('search'))
        {
            $query=Idea::search(request('search'))->where('user_id',$user->id);
        }
        else
        {
            $query=idea::with('user:id,name,image','comments.user:id,name,image')
            ->withCount('likes')->where('user_id',$user->id)->orderBy('created_at','DESC');
        }


        $ideas=$query->paginate(5);

        $editing=false;

        return view('user',compact('user','editing','ideas'));
    }


    public function edit(User $user)
    {
        $this->authorize('update',$user);
        $ideas=$user->ideas()->paginate(5);
        $editing=true;
        return view('user',compact('user','editing','ideas'));
    }


    public function update(updateUserRequest $request,User $user)
    {
        $this->authorize('update',$user);
        $validated = $request->validated();


        if($request['image']){

            $imagepath = $request->file('image')-> store('profile','public');
            $validated['image']=$imagepath;
            if($user['image']!=null){
            Storage::disk('public')->delete($user['image']);
        }
    }
        $user->update($validated);

        return redirect()->route('profile')->with('success','edit done successfully!');
    }

    public function profile(){

        return $this->show(Auth::user());
    }


}
