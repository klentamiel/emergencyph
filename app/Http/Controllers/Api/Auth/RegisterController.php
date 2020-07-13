<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
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

        try {
            $userdata = User::create([
                'username' => $request['username'],
                'user_type' => 'user',
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'complete_profile' => 'no'
            ]);
    
            if($userdata){

                $res = UserProfile::create([
                    'user_id' => $userdata['id'],
                ]);

                $userprofile = UserProfile::find($res['id']);
                $userdata['userprofile'] = $userprofile;

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
        } catch (\Throwable $e) {

            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                $message = 'Email or Username already existing';
            }else{
                $message = $e;
            }
            //throw $th;
            $result = [
                'error' => 1,
                'message' => $message,
            ];
        }

        return response()->json($result);
    }
}
