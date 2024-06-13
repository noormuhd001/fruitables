<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\offer\offerstorerequest;
use App\Http\Requests\offer\offerupdate;
use App\Models\offer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Offercontroller extends Controller
{
    //
    public function index()
    {
        $offer = offer::all();
        return view('admin.offers.index', ['offer' => $offer]);
    }

    public function getData(Request $request)
    {

        if ($request->ajax()) {
            $offer = offer::select('*');
            return DataTables::of($offer)
                ->addColumn('action', function ($offer) {
                    return '<a href="' . route('offer.edit', $offer->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Edit</a>
                            <a href="' . route('offer.delete', $offer->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function add()
    {
        return view('admin.offers.add');
    }



    public function store(offerstorerequest $request)
    {
        // Save product to database
        $offer = new offer();
        $offer->title = $request->title;
        $offer->discount = $request->discount;
        $offer->description = $request->description;
        $offer->offer_percentage = $request->percentage;
        $offer->stock = $request->stock;
       
        $offer->price = $request->price;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;

        // Handle file upload if you have a photo field
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
            $offer->photo = 'uploads/' . $fileName; // Add missing slash
        }
        $offer->photo = $request->photo;
        $offer->save();

        return redirect()->route('offer.index')->with('success', 'offer added successfully!');
    }


    public function edit($id)
    {
        $offer = offer::findOrFail($id);
        return view('admin.offers.view', ['offer' => $offer]);
    }

    public function delete($id)
    {
        $offer = offer::findOrFail($id);
        $offer->delete();
        return redirect()->back()->with('success','offer deleted successfully');
    }
    
    public function update(OfferUpdate $request)
    {
        $id = $request->id;
        $offer = Offer::findOrFail($id);
        $offer->title = $request->title;
        $offer->description = $request->description;
        $offer->price = $request->price;
        $offer->offer_percentage = $request->percentage; // Ensure 'percentage' is fillable in your model
        $offer->discount = $request->discount;
        $offer->stock = $request->stock;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
    
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
            $offer->photo = 'uploads/' . $fileName;
        }
    
        $offer->save();
    
        return redirect()->route('offer.index')->with('success', 'Offer updated successfully');
    }
    
}
