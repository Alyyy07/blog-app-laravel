<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index',['title'=>'Register','active'=>'register']);
    }

    public function store(){
        $validatedData = request()->validate([
            'name'=>'required|min:3|max:255',
            'username'=>'required|min:3|max:255|unique:users',
            'email'=>'required|email:dns|unique:users',
            'password'=>'required|min:8|max:255',
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/login')->with('success','Registration Successfull! Please Login');
    }
}
