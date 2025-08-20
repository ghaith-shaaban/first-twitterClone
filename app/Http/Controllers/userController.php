<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function show(User $user)
    {
        $ideas=$user->ideas()->paginate(5);
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

        return $this->show(auth()->user());
    }


}
