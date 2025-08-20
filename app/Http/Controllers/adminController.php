<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\idea;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index(){
    $totalusers=User::count();
    $totalideas=idea::count();
    $totalcomments=comment::count();
    return view('admin.main',compact('totalusers','totalideas','totalcomments'));
  }

  public function showUsers(){
    $allusers=User::latest()->paginate(20);
    return view('admin.showUsers',compact('allusers'));
  }

  public function showideas(){
    $allideas=idea::latest()->paginate(10);
    return view('admin.showideas',compact('allideas'));
  }

  public function showcomments(){
    $allcomments=comment::latest()->paginate(10);
    return view('admin.showcomments',compact('allcomments'));
  }

  public function destroy(comment $comment){
    $this->authorize('delete',$comment);
    $comment->delete();
    return redirect()->route('admin.comments');
  }
}
