<?php

namespace App\Services\Auth;

use App\Models\User;

class AuthManagementService
{
    public function signup($data){
        $user = new User();
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
}