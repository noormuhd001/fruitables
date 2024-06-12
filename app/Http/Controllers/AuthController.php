<?php

namespace App\Http\Controllers;

use App\Http\Requests\userManagement\userstoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function loginpage(){
        return view('auth.login');
    }
    public function signuppage(){
        return view('auth.signup');
    }

    public function signup(userstoreRequest $request){
       
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password =  bcrypt($request['password']);
        $user->save();

        return response()->json(['data' => true, 'route' => route('loginpage'), 'message' => 'user registered successfull']);
    }
}
