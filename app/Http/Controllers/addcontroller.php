<?php

namespace App\Http\Controllers;

use App\Http\Requests\createIdeaRequest;
use App\Models\idea;
use Illuminate\Http\Request;

class addcontroller extends Controller
{
    // public function destroy($id){
    //     $ideaDied=idea::where('id',$id)->firstorfail();
    //     $ideaDied->delete();
    //     return redirect()->route('main')->with('success','Idea deleted Successfully');
    // }

    public function sub(createIdeaRequest $request){
       $validated= $request->validated();
    //    ()->validate(['idea'=>'required|min:2|max:240']);
        // $idea =new idea(["idea" =>request()->get('cont','')]);
        // $idea->save();
        $validated['user_id']=auth()->id();
        // dd($validated);
        idea::create($validated);
       return redirect()->route('main')->with('success','Idea created Successfully');
    }

    public function destroy(idea $id){
        // if(auth()->id() !== $id->user_id){
        //     abort(404);
        // }
        // $this->authorize('idea.edit',$id);
        $this->authorize('delete',$id);

        $id->delete();
        return redirect()->route('main')->with('success','Idea deleted Successfully');
    }

    public function show(idea $id){

        return view('show_one',['idea'=>$id,'editing'=>false]);
    }

    public function edit(idea $id){
        // if(auth()->id() !== $id->user_id){
        //     abort(404);
        // }
        $this->authorize('update',$id);
        $editing=true;
        return view('show_one',['idea'=>$id,'editing'=>$editing]);
    }

    public function update(idea $id){
        // if(auth()->id() !== $id->user_id){
        //     abort(404);
        // }
        $this->authorize('update',$id);
        request()->validate(['cont'=>'required|min:2|max:240']);
        $id->idea= request()->get('cont','');
        $id->save();
        return redirect()->route('idea show',$id['id'])->with('success','Idea updated Successfully');
    }

}
