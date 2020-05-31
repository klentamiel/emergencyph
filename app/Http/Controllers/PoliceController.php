<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PoliceController extends UserController
{
    public function registerPolice() {
        if (Auth::user()->user_type === 'police') {
            return view('user.register');
        } else {
            return redirect()->back();
        }    
    }

    public function registerSave(Request $request) {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        


        if ($validate){
            $user = new User;

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->user_type = 'police_officer';
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
