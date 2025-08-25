<?php

namespace App\Http\Controllers;

use App\Http\Requests\createIdeaRequest;
use App\Models\idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function sub(createIdeaRequest $request){
       $validated= $request->validated();

        idea::create([
            'idea'=>$validated['idea'],
            'user_id'=>auth()->id()
        ]);
       return redirect()->route('main')->with('success','Idea created successfully');
    }

    public function destroy(idea $id){

        $this->authorize('delete',$id);

        $id->delete();
        return redirect()->route('main')->with('success','Idea deleted successfully');
    }

    public function show(idea $id){

        return view('show_one',['idea'=>$id,'editing'=>false]);
    }

    public function edit(idea $id){

        $this->authorize('update',$id);
        $editing=true;
        return view('show_one',['idea'=>$id,'editing'=>$editing]);
    }

    public function update(idea $id){

        $this->authorize('update',$id);
        request()->validate(['cont'=>'required|min:2|max:240']);
        $id->idea= request()->get('cont','');
        $id->save();
        return redirect()->route('idea show',$id['id'])->with('success','Idea updated successfully');
    }

}
