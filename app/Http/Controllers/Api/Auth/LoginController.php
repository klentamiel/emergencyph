<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
                if($userdata->user_type === 'user'){
                    if($userdata->verified === 'yes'){
                        $userdata->profile = UserProfile::where('user_id', $userdata->id)->first();
    
                        $result = [
                            'error' => 0,
                            'userdata' => $userdata,
                            'message' => 'success'
                        ];
                    }else{
                        $result = [
                            'error' => 1,
                            'message' => 'Your account is not yet verified'
                        ];
                    }
                }else{
                    $result = [
                        'error' => 1,
                        'message' => 'Invalid Access'
                    ];
                }
            }else{
                $result = [
                    'error' => 1,
                    'message' => 'error'
                ];
            }
        }
        return response()->json($result);
    }

    protected function changepassword(Request $request){
        
        $userdata = User::where('id', $request->user_id)->first();
        /* var_dump($request->get('currentpassword')); */
        if($userdata){
            if (!(Hash::check($request->get('currentpassword'), $userdata->password))) {
                // The passwords matches
                $result = [
                    'error' => 1,
                    'message' => 'Your current password does not matches with the password you provided. Please try again.'
                ];
                return response()->json($result);
            }
            if($request->get('confirmpassword')  != $request->get('password')){
                $result = [
                    'error' => 1,
                    'message' => 'New password and confirm password not match.'
                ];
                return response()->json($result);
            }
            if(strcmp($request->get('currentpassword'), $request->get('password')) == 0){
                //Current password and new password are same
                $result = [
                    'error' => 1,
                    'message' => 'New Password cannot be same as your current password. Please choose a different password.'
                ];
                return response()->json($result);
            }
    
            //Change Password
            $userdata->password =  Hash::make($request->get('password'));
            $userdata->save();
    
            $result = [
                'error' => 0,
                'message' => 'Password Successfully change!'
            ];
        }
        return response()->json($result);
    }
}
