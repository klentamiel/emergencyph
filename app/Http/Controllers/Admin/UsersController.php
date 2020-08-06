<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
            return view('admin.manage')->withDetails($users);
        } else {
            return redirect()->back();
        }
    }

    public function pendingVerifications() {
        $users = User::where([
            ['verified', 'no'],
            ['user_type', 'user'],
        ])->get();
        if (Auth::user()->user_type === 'admin') {
            return view('admin.verify')->withDetails($users);
        } else {
            return redirect()->back();
        }
    }

    public function viewProfile(User $user) {
        if (Auth::user()->user_type === 'admin') {
            $profile = DB::table('user_profiles')->where('user_id', $user->id)->get();
            return view('admin.profile')->withProfile($profile);
        } else {
            return redirect()->back();
        }
    }

    public function allow(Request $request) {
        if (isset($_POST['allow'])){
            $profile = DB::table('users')->where('id', $request['id'])->update(['verified' => 'yes']);
        } else {
            $profile = DB::table('users')->where('id', $request['id'])->update(['verified' => 'invalid']);
        }
        return redirect()->route('admin.pending');
    }

    public function search (Request $request)
    {
        $q = $request->input('q');
        if($q != ""){       
            $users = User::where('name','LIKE', '%' .$q. '%')
                            ->orWhere('email', 'LIKE', '%' .$q. '%')
                            ->get();
            if(count($users) > 0){
                return view('admin.manage')->withDetails($users);
            } else {
                return view('admin.manage')->withMessage("No users found!"); 
            } 
        } else {
            $users = User::all();
            return view('admin.manage')->withDetails($users);
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
        if ($user['email'] === $request['email'] && $user['username'] === $request['username']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5'],  
                'email' => ['required', 'email']  
            ]);
        } elseif ($user['email'] === $request['email']) {
            $validate = $request->validate([
                'name' => ['required', 'min:5'],
                'username' => ['required', 'min:5', 'unique:users'],   
                'email' => ['required', 'email']  
            ]);
        } elseif ($user['username'] === $request['username']) {
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
            $user->username = $request['username'];
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
        $user->delete();

        return redirect()->back();
    }
}
