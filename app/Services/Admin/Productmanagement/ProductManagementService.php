<?php

namespace App\Services\Admin\Productmanagement;

use App\Models\categories;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductManagementService
{
    public function index()
    {
        $product = Product::all();
        $categories = categories::all();
        return [
            'product' => $product,
            'categories' => $categories,
        ];
    }
    public function store($data)
    {
        $product = new Product();
        $product->name = $data->name;
        $product->category = $data->category;
        $product->basicdescription = $data->basic_description;
        $product->fulldescription = $data->full_description;
        $product->stock = $data->stock;
        $product->price = $data->price;
        $product->SKU = str::uuid(); // Ensure 'Str' is correctly imported
        $product->slug = str::slug($product->SKU . ' ' . $product->category . ' ' . now());

        // Handle file upload if you have a photo field
        if ($data->hasFile('photo')) {
            $file = $data->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
            $product->photo = 'uploads/' . $fileName; // Add missing slash
        }

        $product->save();
        return $product;
    }
    public function edit($id)
    {
        $product = Product::findorfail($id);
        $category = categories::all();

        return [
            'product' => $product,
            'category' => $category,
        ];
    }
    public function update($data)
    {
        $id = $data->id;
        $product = Product::findorfail($id);
        $product->name = $data->name;
        $product->price = $data->price;
        $product->category = $data->category;
        $product->basicdescription = $data->basic_description;
        $product->fulldescription = $data->full_description;
        $product->stock = $data->stock;
        $product->save();

        return $product;
    }

    public function delete($id)
    {
        $product = product::findorfail($id);
        $product->delete();

        return $product;
    }
}
