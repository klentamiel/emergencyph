<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends UserController
{
    public function registerStation() {
        if (Auth::user()->user_type === 'admin') {
            return view('admin.register');
        } else {
            return redirect()->back();
        }    
    }

    public function registerSave(Request $request) {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validate){
            $user = new User;

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->user_type = $request['user_type'];
            $user->password = Hash::make($request['password']);

            $user->save();
            $request->session()->flash('success', 'Registration Success!');
            return redirect()->back();    
        } else {
            $request->session()->flash('error', 'There was an Error!');
            return redirect()->route('user.register');
        }
    }
}
