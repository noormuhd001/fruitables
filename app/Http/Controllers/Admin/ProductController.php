<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\productmanagement\productStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductController extends Controller
{
 

    public function index(){
        $product = Product::all();
        return view('admin.product.index',['product'=>$product]);
    }

    public function store(productStoreRequest $request)
{
    // Save product to database
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price; // Add price if you have it in your form
    $product->category = $request->category;
    $product->basicdescription = $request->basic_description;
    $product->fulldescription = $request->full_description;
    $product->stock = $request->stock;
    $product->price = $request->price;
    $product->SKU = Str::uuid(); // Ensure 'Str' is correctly imported

    // Handle file upload if you have a photo field
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
        $product->photo = 'uploads/' . $fileName; // Add missing slash
    }

    $product->save();

    return redirect()->back()->with('success', 'Product added successfully!');
}

}
