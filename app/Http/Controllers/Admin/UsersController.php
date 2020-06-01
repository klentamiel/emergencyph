<?php

namespace App\Http\Controllers\Admin;

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
        $users = User::all();
        if (Auth::user()->user_type === 'admin') {
            return view('admin.index')->with('users', $users);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->user_type === 'admin') {
            return view('admin.edit')->with('user', $user);
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
    public function update(Request $request, User $user)
    {


        $validate = null;
        if ($user['email'] === $request['email']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'email' => ['required', 'email']  
            ]);
        } else {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'email' => ['required', 'email', 'unique:users']   
            ]);
        }

        if ($validate) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->user_type = $request['user_type'];

            $user->save();

            $request->session()->flash('success', 'Success!');
            return redirect()->back();
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
    public function destroy(User $user)
    {
        //
    }
}
