<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\categorymanagent\categoryStoreRequest;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function index(){
        $category = categories::all();
        return view('admin.category.index',['category'=>$category]);
    }

    public function store(categoryStoreRequest $request){

        $category = new categories;
        $category->name= $request->name;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
            $category->photo = 'uploads/' . $fileName; // Add missing slash
        }
    $category->save();

   return redirect()->back()->with('success','Category added successfully!'); 
   }
}
