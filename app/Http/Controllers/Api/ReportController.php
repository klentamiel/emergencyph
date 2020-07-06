<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserReports;

class ReportController extends Controller
{
    protected function savereport(Request $request)
    {
        try {
            $userdata = UserReports::create([
                'user_id' => $request['user_id'],
                'location' => $request['location'],
                'report_type' => $request['report_type'],
                'message' => $request['message'],
                'status' => $request['status'],
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


    protected function updatereport(Request $request)
    {
        try {
            $userdata = UserReports::where('user_id', $request->id)->update([
                'picture' => $request['picture']
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
}
