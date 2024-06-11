<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\offer\offerstorerequest;
use App\Models\offer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Offercontroller extends Controller
{ 
    //
    Public function index(){
        $offer = offer::all();
        return view('admin.offers.index',['offer'=>$offer]);
    }

    public function getData(Request $request){

        if ($request->ajax()) {
            $products = offer::select('*');
            return DataTables::of($products)
                ->addColumn('action', function ($product) {
                    return '<a href="' . route('product.edit', $product->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Edit</a>
                            <a href="' . route('product.delete', $product->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function add(){
        return view('admin.offers.add');
    }


    
    public function store(offerstorerequest $request)
{
    // Save product to database
    $offer = new offer();
    $offer->name = $request->name;
    $offer->category = $request->category;
    $offer->basicdescription = $request->basic_description;
    $offer->fulldescription = $request->full_description;
    $offer->stock = $request->stock;
    $offer->price = $request->price;
    
    // Handle file upload if you have a photo field
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
        $offer->photo = 'uploads/' . $fileName; // Add missing slash
    }

    $offer->save();
    return redirect()->back()->with('success', 'offer added successfully!');   
 }

}
