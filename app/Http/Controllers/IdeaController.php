<?php

namespace App\Http\Controllers;

use App\Http\Requests\createIdeaRequest;
use App\Models\idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IdeaController extends Controller
{
    use AuthorizesRequests;
    
    public function create(createIdeaRequest $request){

        $validated= $request->validated();

        idea::create([
            'idea'=>$validated['idea'],
            'user_id'=>Auth::id()
        ]);

       return redirect()->route('main')->with('success','Idea created successfully');
    }

    public function destroy(idea $idea){

        $this->authorize('delete',$idea);

        $idea->delete();
        return redirect()->route('main')->with('success','Idea deleted successfully');
    }

    public function show(idea $idea){

        return view('show_one',compact('idea'));
    }

    public function edit(idea $idea){

        $this->authorize('update',$idea);
        return view('show_one',compact('idea'));
    }

    public function update(idea $idea){

        $this->authorize('update',$idea);
        request()->validate(['cont'=>'required|min:2|max:240']);
        $idea->idea= request()->get('cont','');
        $idea->save();
        return redirect()->route('idea.show',$idea['id'])->with('success','Idea updated successfully');
    }

}
