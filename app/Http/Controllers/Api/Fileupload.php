<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Fileupload extends Controller
{
    function uploadFile(){
        $newImageName = time().'_'.rand(10,100).'.jpg';
        $destinationPath = public_path() . '/uploads/'.$newImageName;
        
        /* Input::file('file')->move($destinationPath,$newImageName); */
        move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath);
        $result = [
            'error' => 0,
            'message' => 'Successfully Uploaded',
            'data' => env('APP_URL').'/uploads/'.$newImageName
        ];
        return response()->json($result);
    }
}
