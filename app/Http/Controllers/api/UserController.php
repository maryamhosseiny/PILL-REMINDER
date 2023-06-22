<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function login(Request $request){
        $email = $request->post('email');
        $password = $request->post('password');
        $user = User::where('email',$email)->first();
        if ($user && Hash::check($password, $user->password)) {
            $token = JWT::encode($user->toArray(), config('jwt.key'),'HS256');
            return [
                'success'=>true,
                'message'=>'welcome',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user->toArray(),
                ]
            ];
        }
        else
        {
            return [
                'success'=>false,
                'message'=>'username or password is incorrect',
                'data'=>[]
            ];
        }

    }

    function register(Request $request){
        $name = $request->post('name');
        $email = $request->post('email');
        $password = $request->post('password');
        $password_repeat = $request->post('password_repeat');

        //check validations
        if($name==null || strlen(trim($name)) ==0)
        {
            return [
                'success'=>false,
                'message'=>'please enter valid name',
                'data'=>[]
            ];
        }

        if($email==null || strlen(trim($email)) ==0)
        {
            return [
                'success'=>false,
                'message'=>'please enter valid email',
                'data'=>[]
            ];
        }
        $exist = User::where('email',$email)->first();
        if($exist)
        {
            return [
                'success'=>false,
                'message'=>'a user by this email has registered',
                'data'=>[]
            ];
        }

        if($password==null || strlen(trim($password)) ==0 || strlen($password) <6 )
        {
            return [
                'success'=>false,
                'message'=>'please enter valid password',
                'data'=>[]
            ];
        }
        if($password != $password_repeat)
        {
            return [
                'success'=>false,
                'message'=>'password_repeat is not equal to password',
                'data'=>[]
            ];
        }
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
        $token = JWT::encode($user->toArray(), config('jwt.key'),'HS256');
        return [
          'success'=>true,
          'message'=>'done',
          'data'=>[
              'user'=>$user,
              'token'=>$token,
          ]
        ];
    }

}
