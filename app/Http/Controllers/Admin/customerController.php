<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\userManagement\userstoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class customerController extends Controller
{
    //

    public function index(){
        $users = User::where('role', 0 )->get();
        return view('admin.customer.index',['users'=>$users]);
    }

    public function edit($id){
        $user = user::findOrFail($id);
        return view('admin.customer.view',['user'=>$user]);        
    }

    public function store(userstoreRequest $request){
       
        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password =  bcrypt($request['password']);
        $user->save();
        return redirect()->route('customer.index')->with('success','product added successfully');

    }
    public function update(userstoreRequest $request){

        $id = $request->id;
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password =  bcrypt($request['password']);
        $user->save();
        return redirect()->route('customer.index')->with('success','product edited successfully');
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();        
        return redirect()->route('customer.index')->with('success','product deleted successfully');
    }
    
}
