<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function editProfile()
    {
        if (Auth::user()->user_type != 'user') {
            $user = User::find(Auth::user()->id);

            if ($user) {
                return view('user.edit')->withUser($user);
            } else {
                return redirect()->back();
            } 
        } else {
            return redirect()->back();
        } 
    }

    
    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user) {
            $validate = null;
            if (Auth::user()->email === $request['email'] && Auth::user()->username === $request['username']) {
                $validate = $request->validate([
                    'name' => ['required', 'min:5'],
                    'username' => ['required', 'min:5'],  
                    'email' => ['required', 'email']  
                ]);
            } elseif (Auth::user()->email === $request['email']) {
                $validate = $request->validate([
                    'name' => ['required', 'min:5'],
                    'username' => ['required', 'min:5', 'unique:users'],   
                    'email' => ['required', 'email']  
                ]);
            } elseif (Auth::user()->username === $request['username']) {
                $validate = $request->validate([
                    'name' => ['required', 'min:5'],
                    'username' => ['required', 'min:5'],   
                    'email' => ['required', 'email', 'unique:users']   
                ]);
            } else {
                $validate = $request->validate([
                    'name' => ['required', 'min:5'],
                    'username' => ['required', 'min:5', 'unique:users'],   
                    'email' => ['required', 'email', 'unique:users']   
                ]);
            }

            if ($validate) {
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->username = $request['username'];

                $user->save();

                $request->session()->flash('success', 'Success!');
                return redirect()->back();
            } else {
                return redirect()->back();
            }            
        } else {
            return redirect()->back();
        }
    }


    public function passwordEdit() {
        if (Auth::user()->user_type != 'user') {
            return view('user.password');
        } else {
            return redirect()->back();
        }
    }


    public function passwordUpdate(Request $request)
    {
        $validate = $request->validate([
            'oldPassword' => ['required', 'min:8'],
            'password' => ['required', 'min:8', 'confirmed']   
        ]);

        $user = User::find(Auth::user()->id);

        if ($user) {
            if (Hash::check($request['oldPassword'], $user->password) && $validate) {
                $user->password = Hash::make($request['password']);

                $user->save();
                $request->session()->flash('success', 'Success!');
                return redirect()->back();    
            } else {
                $request->session()->flash('error', 'Your current password does not match!');
                return redirect()->route('password.edit');
            }
        } 
    }

}