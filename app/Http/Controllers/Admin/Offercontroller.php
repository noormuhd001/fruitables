<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
