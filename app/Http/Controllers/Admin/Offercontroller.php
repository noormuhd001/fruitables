<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\Offermanagement\OfferManagementService;
use App\Http\Controllers\Controller;
use App\Http\Requests\offer\offerstorerequest;
use App\Http\Requests\offer\offerupdate;
use App\Models\offer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Offercontroller extends Controller
{
    //
    private $offermanagementservice;

    public function __construct(OfferManagementService $offerManagementService)
    {
        $this->offermanagementservice = $offerManagementService;
    }
    public function index()
    {
        try {
            $offer = offer::all();
            if ($offer) {
                return view('admin.offers.index', ['offer' => $offer]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function getData(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function add()
    {
        return view('admin.offers.add');
    }



    public function store(offerstorerequest $request)
    {
        // Save product to database
        try {
            $store = $this->offermanagementservice->store($request);
            if ($store) {
                return redirect()->route('offer.index')->with('success', 'offer added successfully!');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $offer = offer::findOrFail($id);
            if ($offer) {
                return view('admin.offers.view', ['offer' => $offer]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function delete($id)
    {
        try {
            $offer = $this->offermanagementservice->delete($id);
            if ($offer) {
                return redirect()->back()->with('success', 'offer deleted successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function update(OfferUpdate $request)
    {
        try{
     $update = $this->offermanagementservice->update($request);
     if($update){

        return redirect()->route('offer.index')->with('success', 'Offer updated successfully');
    }else{
        return abort(404);
    }
}catch(\Exception $e){
    report($e);
    return abort(500);
}
}
}
