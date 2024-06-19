<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Product;
use App\Models\Review;
use App\Services\Shopmanagement\ShopManagementService;

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
}
