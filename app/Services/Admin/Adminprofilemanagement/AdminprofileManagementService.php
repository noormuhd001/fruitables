<?php

namespace App\Services\Admin\Adminprofilemanagement;

use App\Models\categories;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminprofileManagementService
{

    public function index(){
        $id = auth()->id();
        $user = User::findOrFail($id);

        return [
            'user' => $user
        ];

    }
}