<?php

namespace App\Services\Auth;

use App\Models\order;
use App\Models\User;
use Illuminate\Support\Str;

class AuthManagementService
{
    public function signup($data){
        $user = new User();
        $user->verification = str::uuid()->toString();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->phone = $data->phone;
        $user->password =  bcrypt($data['password']);
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }

    public function submit($data){
        $email = $data->useremail;
        $user = User::where('email', $email)->firstOrFail();
        $user->password = bcrypt($data['password']);
        $user->save();

        return $user;
    }

    public function adminhome(){
        $ordercount = order::all()->count();
        $confirmed = order::where('status',1)->count();
        $shipped = order::where('status',2)->count();
     
        $delivered = order::where('status',4)->count();
       

        return [
         'ordercount' => $ordercount,
         'confirmed'=>$confirmed,
         'shipped'=>$shipped,
         'delivered'=>$delivered,
        ];
    }


    public function activate($id)
    {
        $user = User::where('verification', $id)->first();
        return $user;
    }
}