<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\Shopmanagement\ShopManagementService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //

    private $shopmanagementservice;

    public function __construct(ShopManagementService $shopmanagementservice)
    {
        $this->shopmanagementservice = $shopmanagementservice;
    }

    public function view($id)
    {
        try {
            $data = $this->shopmanagementservice->getdata($id);
            return view('user.detail.index', $data);
        } catch (\Exception $e) {

            report($e);
            return abort(500);
        }
    }

    public function detailview($id){
        try {
            $data = $this->shopmanagementservice->getofferdata($id);
            return view('user.detail.offerview', $data);
        } catch (\Exception $e) {

            report($e);
            return abort(500);
        }
    }

    public function offerview()
    {
        try {
            $data = $this->shopmanagementservice->offerview();
            if ($data) {
                return view('user.home.offer', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function addtocart(Request $request){
        try {
            $message = $this->shopmanagementservice->addToCart($request->id,$request);
            if ($message) {
                return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    
}
