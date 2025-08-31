<?php

namespace App\Http\Controllers;

use App\Mail\welcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\mail;

class AuthController extends Controller
{
    public function register(){

        return view('auth.register');
    }

    public function store(){
        $validated=  request()->validate(
            [
              'name'=>'required|min:3|max:30',
              'email'=>'required|email|unique:users,email',
              'password'=>'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ]
        );

        $user=User::create(['name'=>$validated['name'],
               'email'=>$validated['email'],
               'password'=>Hash::make($validated['password']) ]);

         return redirect()->route('main')->with('success','account created successfully!');
    }

    public function login(){

        return view('auth.login');
    }

    public function auth(){
        $validated=  request()->validate(
            [
              'email'=>'required|email',
              'password'=>'required|min:2'
            ]
        );
        if(Auth::attempt($validated))
        {
            request()->session()->regenerate();
            return redirect()->route('main')->with('success','login successfully!');
        }
        else
     return redirect()->route('login')->withErrors(['email'=>'no such email']);
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('main')->with('success','logged out successfully!');
    }
}
