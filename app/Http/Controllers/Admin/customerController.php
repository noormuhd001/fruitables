<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class customerController extends Controller
{
    //

    public function index(){

        $users = User::all();
        return view('admin.customer.index',['users'=>$users]);
    }
    
}
