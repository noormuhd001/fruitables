<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\User\Homemanagement\HomeManagementService;

class HomeController extends Controller
{
    //
    private $homeManagementService;

    public function __construct(HomeManagementService $homeManagementService)
    {
        $this->homeManagementService = $homeManagementService;
    }

    public function index()
    {
        try {
            $data = $this->homeManagementService->index();
            if ($data) {
                return view('user.home.index', $data);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function shop()
    {
        try {
            $data = $this->homeManagementService->shop();
            if ($data) {
                return view('user.home.shop', $data);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }
}
