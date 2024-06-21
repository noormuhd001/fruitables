<?php

namespace App\Http\Controllers;

use App\Http\Requests\userManagement\confirmpassword;
use App\Http\Requests\userManagement\userstoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\forgotpassword;
use App\Jobs\sendmailjob;
use App\Services\Auth\AuthManagementService;

class AuthController extends Controller
{
    //
    private $authmanagementservice;

    public function __construct(AuthManagementService $authManagementService)
    {
        $this->authmanagementservice = $authManagementService;
    }

    public function loginpage()
    {
        return view('auth.login');
    }

    public function adminhome()
    {
        try {
            $data = $this->authmanagementservice->adminhome();
            if ($data) {
                return view('welcome', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function signuppage()
    {
        return view('auth.signup');
    }

    public function signup(userstoreRequest $request)
    {
        try {
            $user = $this->authmanagementservice->signup($request);
            if ($user) {
                dispatch(new sendmailjob($user));
                return response()->json(['data' => true, 'route' => route('loginpage'), 'message' => 'user registered successfull']);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }


    public function login(Request $request)
    {

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

    public function adminLogout()
    {
        Auth::logout();
        return view('auth.login');
    }
    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function email(Request $request)
    {
        try {
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if ($user) {
                dispatch(new ForgotPassword($user));
                return response()->json(['data' => true, 'route' => route('forgotpassword')]);
            } else {
                return response()->json(['data' => false, 'message' => 'User not found']);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function verify($email)
    {
        try {
            $useremail = $email;
            return view('auth.password-reset', ['useremail' => $useremail]);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function submit(confirmpassword $request)
    {
        try {
            $user = $this->authmanagementservice->submit($request);
            if ($user) {
                return response()->json(['data' => true, 'route' => route('loginpage')]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function activate($id)
    {
        try {
            $user = $this->authmanagementservice->activate($id);
            if ($user) {
                $user->isActive = 1;
                $user->verification = null;
                $user->save();
                return view('mail.success', ['user' => $user]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
