<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->user_type == 'admin'){        
            return view('admin');
        }
        elseif (Auth::user()->user_type == 'Police Station'){        
            return view('police');
        } 
        elseif (Auth::user()->user_type == 'Ambulance'){
            return view('hospital');
        } 
        elseif (Auth::user()->user_type == 'Fireman' ){
            return view('firestation');
        } else {
            return view('home');
        }
    }
}
