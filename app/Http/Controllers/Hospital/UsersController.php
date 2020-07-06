<?php

namespace App\Http\Controllers\Hospital;

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
        $users = User::where('user_type', 'Ambulance')->get();
        if (Auth::user()->user_type === 'Hospital') {
            return view('hospital.manage')->withDetails($users);
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
                            ['user_type', 'Ambulance'],
                        ])->orWhere([
                            ['email','LIKE', '%' .$q. '%'],
                            ['user_type', 'Ambulance'],
                        ])->get();

            if(count($users) > 0){
                return view('hospital.manage')->withDetails($users)->withQuery($q);
            } else {
                return view('hospital.manage')->withMessage("No users found!"); 
            } 
        } else {
            $users = User::where('user_type', 'Ambulance')->get();
            return view('hospital.manage')->withDetails($users);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $ambulance)
    {
        if (Auth::user()->user_type === 'Hospital') {
            return view('hospital.edit')->with('user', $ambulance);
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
    public function update(Request $request, User $ambulance)
    {
        $validate = null;
        if ($ambulance['email'] === $request['email'] && $ambulance['username'] === $request['username']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5'],  
                'email' => ['required', 'email']  
            ]);
        } elseif ($ambulance['email'] === $request['email']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5', 'unique:users'],   
                'email' => ['required', 'email']  
            ]);
        } elseif ($ambulance['username'] === $request['username']) {
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
            $ambulance->name = $request['name'];
            $ambulance->username = $request['username'];
            $ambulance->email = $request['email'];

            $ambulance->save();

            $request->session()->flash('success', 'Success!');
            return redirect()->route('ambulances.index');
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
    public function destroy(User $ambulance)
    {
        $ambulance->delete();

        return redirect()->back();
    }
}
