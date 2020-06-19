<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserProfile;

class LoginController extends Controller
{
    /**
     * Login
     *
     * @param  array  $request
     */
    protected function login(Request $request)
    {
        $creds = $request->only(['username','password']);
        $token = auth()->attempt($creds);

        if(!$token){
            $result = [
                'error' => 1,
                'message' => 'Invalid username/Password'
            ];
        }else{

            $userdata = User::where('username', $request->username)->first();

            if($userdata){
                $userdata->profile = UserProfile::where('user_id', $userdata->id)->first();

                $result = [
                    'error' => 0,
                    'userdata' => $userdata,
                    'message' => 'success'
                ];
            }else{
                $result = [
                    'error' => 1,
                    'message' => 'error'
                ];
            }
        }
        return response()->json($result);
    }
}
