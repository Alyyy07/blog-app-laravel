<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function index(){
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(){
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($credentials)){
            request()->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
