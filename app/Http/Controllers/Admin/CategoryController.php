<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\categorymanagent\categoryStoreRequest;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\categorymanagent\categoryupdateRequest;
use Illuminate\Support\Facades\Storage;

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

   public function edit($id){
     $category = categories::findorfail($id);
     return view('admin.category.view',['category'=>$category]);

   }


   public function update(categoryupdateRequest $request) {
    $id = $request->id;
    $category = Categories::findOrFail($id);
    $category->name = $request->name;

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');
        
        // Optionally delete the old file
        if ($category->photo && Storage::disk('public')->exists($category->photo)) {
            Storage::disk('public')->delete($category->photo);
        }

        $category->photo = $filePath;
    }

    $category->save();
    return redirect()->route('category.index')->with('success', 'Category updated successfully!');
}

public function delete($id){
    $category = categories::findorfail($id);
    $category->delete();
    return redirect()->back()->with('success','product deleted successfully');
}

}
