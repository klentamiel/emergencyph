<?php

namespace App\Http\Controllers\Fire;

use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UsersController extends UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', 'Fireman')->get();
        if (Auth::user()->user_type === 'Fire Station') {
            return view('fire.manage')->withDetails($users);
        } else {
            return redirect()->back();
        }
    }

    public function search (Request $request)
    {
        $q = $request->input('q');
        if($q != ""){       
            $users = User::where([
                            ['name','LIKE', '%' .$q. '%'],
                            ['user_type', 'Fire Man'],
                        ])->orWhere([
                            ['email','LIKE', '%' .$q. '%'],
                            ['user_type', 'Fire Man'],
                        ])->get();

            if(count($users) > 0){
                return view('fire.manage')->withDetails($users)->withQuery($q);
            } else {
                return view('fire.manage')->withMessage("No users found!"); 
            } 
        } else {
            $users = User::where('user_type', 'Fireman')->get();
            return view('fire.manage')->withDetails($users);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $fireman)
    {
        if (Auth::user()->user_type === 'Fire Station') {
            return view('fire.edit')->with('user', $fireman);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $fireman)
    {
        $validate = null;
        if ($fireman['email'] === $request['email'] && $fireman['username'] === $request['username']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5'],  
                'email' => ['required', 'email']  
            ]);
        } elseif ($fireman['email'] === $request['email']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5', 'unique:users'],   
                'email' => ['required', 'email']  
            ]);
        } elseif ($fireman['username'] === $request['username']) {
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
            $fireman->name = $request['name'];
            $fireman->username = $request['username'];
            $fireman->email = $request['email'];

            $fireman->save();

            $request->session()->flash('success', 'Success!');
            return redirect()->route('firemans.index');
        } else {
            return redirect()->back();
        }            
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $fireman)
    {
        $fireman->delete();

        return redirect()->back();
    }
}
