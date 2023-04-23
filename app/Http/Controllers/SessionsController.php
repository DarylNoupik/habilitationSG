<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        
        $attributes = request()->validate([
            'login' => 'required',
            'password' => 'required'
        ]);
        
        $loginType = filter_var($attributes['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'matricule';
        
        if ($loginType == 'email') {
            $email = $attributes['login'];
            $user = User::where('email', $email)->first();
        } else {
            $matricule = $attributes['login'];
            $user = User::where('matricule', $matricule)->first();
        }
    
        if ($user && Hash::check($attributes['password'], $user->password)) {
            Auth::login($user);
            session()->regenerate();
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        } else {
            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
