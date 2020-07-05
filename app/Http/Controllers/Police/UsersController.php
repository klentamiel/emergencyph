<?php

namespace App\Http\Controllers\Police;

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
        $users = User::where('user_type', 'Police Officer')->get();
        if (Auth::user()->user_type === 'Police Station') {
            return view('police.manage')->withDetails($users);
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
                            ['user_type', 'Police Officer'],
                        ])->orWhere([
                            ['email','LIKE', '%' .$q. '%'],
                            ['user_type', 'Police Officer'],
                        ])->get();

            if(count($users) > 0){
                return view('police.manage')->withDetails($users)->withQuery($q);
            } else {
                return view('police.manage')->withMessage("No users found!"); 
            } 
        } else {
            $users = User::where('user_type', 'Police Officer')->get();
            return view('police.manage')->withDetails($users);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $officer)
    {
        if (Auth::user()->user_type === 'Police Station') {
            return view('police.edit')->with('user', $officer);
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
    public function update(Request $request, User $officer)
    {
        $validate = null;
        if ($officer['email'] === $request['email'] && $officer['username'] === $request['username']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5'],  
                'email' => ['required', 'email']  
            ]);
        } elseif ($officer['email'] === $request['email']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5', 'unique:users'],   
                'email' => ['required', 'email']  
            ]);
        } elseif ($officer['username'] === $request['username']) {
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
            $officer->name = $request['name'];
            $officer->username = $request['username'];
            $officer->email = $request['email'];

            $officer->save();

            $request->session()->flash('success', 'Success!');
            return redirect()->route('officers.index');
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
    public function destroy(User $officer)
    {
        $officer->delete();

        return redirect()->back();
    }
}
