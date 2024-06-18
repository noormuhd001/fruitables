<?php

namespace App\Http\Controllers;

use App\Http\Requests\userManagement\confirmpassword;
use App\Http\Requests\userManagement\userstoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\forgotpassword;

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
        $user->email_verified_at = now();
        $user->save();

        return response()->json(['data' => true, 'route' => route('loginpage'), 'message' => 'user registered successfull']);
    }


public function login(Request $request){

    try {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isActive) {
                if ($user->role == 0) {
                    return response()->json(['data' => true, 'route' => route('user.home')]);
                } else {
                    return response()->json(['data' => true, 'route' => route('admindashboard')]);
                }
            } else {
                Auth::logout();
                return response()->json(['message' => 'Your account is not active.'], 401);
            }
        }

        return response()->json(['message' => 'Invalid username or password.'], 401);
    } catch (\Exception $e) {
        report($e);
        return response()->json(['message' => 'Server error.'], 500);
    }
}

public function adminLogout(){
    Auth::logout();
    return view('auth.login');
}  public function forgotpassword()
{
    return view('auth.forgot');
}

public function email(Request $request)
{
    $email = $request->email;
    $user = User::where('email', $email)->first();

    if ($user) {
        dispatch(new ForgotPassword($user));
        return response()->json(['data' => true, 'route' => route('forgotpassword')]);
    } else {
        return response()->json(['data' => false, 'message' => 'User not found']);
    }
}

public function verify($email){
    
    $useremail = $email; 
    return view('auth.password-reset',['useremail'=>$useremail]);
}

public function submit(confirmpassword $request){

    $email = $request->useremail;

   $user = User::where('email',$email)->firstOrFail();
    $user->password = bcrypt($request['password']);
    $user->save();
    return response()->json(['data' => true, 'route' => route('loginpage')]);
}
}



