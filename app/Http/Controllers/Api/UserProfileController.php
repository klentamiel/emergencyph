<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserProfile;

class UserProfileController extends Controller
{
    //


    protected function getProfile(Request $request){
        $profileDetails = UserProfile::find($request->id);
        $res = $profileDetails;

        if($res){
            $result = [
                'error' => 0,
                'message' => 'success',
                'data' => $res
            ];
        }else{
            $result = [
                'error' => 1,
                'message' => "danger"
            ];
        }

        return response()->json($result);
    }


    protected function savepersonalprofile(Request $request)
    {
        try {
            $userdata = UserProfile::where('user_id', $request['user_id'])->update([
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'nationality' => $request['nationality'],
                'country' => $request['country'],
                'birth_date' => $request['birth_date'],
                'birth_place' => $request['birth_place'],
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
                    'message' => 'Something went wrong!'
                ];
            }
        } catch (\Throwable $e) {
            $result = [
                'error' => 1,
                'message' => $e,
            ];
        }

        return response()->json($result);
    }


    protected function saveaddress(Request $request)
    {
        /* return $request['username']; */

        try {
            $userdata = UserProfile::where('user_id', $request['user_id'])->update([
                'permanent_address' => $request['permanent_address'],
                'pa_baranggay' => $request['pa_baranggay'],
                'pa_city' => $request['pa_city'],
                'pa_state' => $request['pa_state'],
                'pa_zipcode' => $request['pa_zipcode'],
                'current_address' => $request['current_address'],
                'ca_baranggay' => $request['ca_baranggay'],
                'ca_city' => $request['ca_city'],
                'ca_state' => $request['ca_state'],
                'ca_zipcode' => $request['ca_zipcode'],
                'ca_same_pa' => $request['ca_same_pa'],
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
                    'message' => 'Something went wrong!'
                ];
            }
        } catch (\Throwable $e) {
            //throw $th;
            $result = [
                'error' => 1,
                'message' => $e,
            ];
        }

        return response()->json($result);
    }
}
