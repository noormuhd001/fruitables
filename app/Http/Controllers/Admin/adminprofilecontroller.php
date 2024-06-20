<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Adminprofilemanagement\AdminprofileManagementService;
use Illuminate\Http\Request;

class adminprofilecontroller extends Controller
{
    //
    private $adminprofilemanagementservice;

    public function __construct(AdminprofileManagementService $adminprofileManagementService)
    {
        $this->adminprofilemanagementservice = $adminprofileManagementService;
    }
    public function index()
    {
        try {
            $data = $this->adminprofilemanagementservice->index();
            if ($data) {
                return view('admin.profile.index', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
