<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        /* $this->middleware('auth'); */
    }


   /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $request
     */
    protected function register(Request $request)
    {
        /* return $request['username']; */
        $userdata = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'user_type' => 'user',
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if($userdata){
            $result = [
                'error' => 0,
                'message' => 'success',
                'data' => $userdata
            ];
        }else{
            $result = [
                'error' => 1,
                'message' => 'Sorry, unable to register user now. Try again later'
            ];
        }

        return response()->json($result);
    }
}
