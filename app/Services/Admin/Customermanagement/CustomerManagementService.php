<?php

namespace App\Services\Admin\Customermanagement;

use App\Models\categories;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CustomerManagementService
{

    public function store($data){
        $user = new User;
        $user->name = $data->name;
        $user->phone = $data->phone;
        $user->email = $data->email;
        $user->password =  bcrypt($data['password']);
        $user->save();

        return $user;
    }

    public function update($data){
        $id = $data->id;
        $user = User::findOrFail($id);
        $user->name = $data->name;
        $user->phone = $data->phone;
        $user->email = $data->email;
        $user->password =  bcrypt($data['password']);
        $user->save();

        return $user;
    }
}