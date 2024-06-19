<?php

namespace App\Services\Admin\Categorymanagement;

use App\Models\categories;
use Illuminate\Support\Facades\Storage;

class CategoryManagementService
{

public function index(){
    $category = categories::all();
    return $category;
}

public function store($data){

    $category = new categories;
    $category->name = $data->name;

    if ($data->hasFile('photo')) {
        $file = $data->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
        $category->photo = 'uploads/' . $fileName; // Add missing slash
    }
    $category->save();
    return $category;
}

public function edit($id){

    $category = categories::findorfail($id);
    return $category;
}

public function update($request){

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
    return $category;
}

public function delete($id){
    $category = categories::findorfail($id);
    $category->delete();

    return $category;
}
}