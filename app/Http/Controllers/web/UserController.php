<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function login(Request $request){
       return view('user.login');
    }

    function register(Request $request){
        return view('user.register');
    }

    function dashboard(Request $request){
        return view('user.dashboard');
    }

}
