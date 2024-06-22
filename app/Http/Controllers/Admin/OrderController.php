<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\orderstore;
use App\Models\cart;
use App\Models\order;
use App\Models\orderitem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Admin\Ordermanagement\OrderManagementService;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    //
    private $ordermanagementservice;

    public function __construct(OrderManagementService $orderManagementService)
    {
        $this->ordermanagementservice = $orderManagementService;
    }
    public function index()
    {
        try {
            $order = order::all();
            return view('admin.order.index', ['order' => $order]);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function getData(Request $request)
    {
        try {
            if ($request->ajax()) {
                $order = order::select('*')->latest();
                return DataTables::of($order)
                    ->addColumn('action', function ($order) {
                        return '<a href="' . route('order.adminorderview', $order->id) . '" class="btn btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function placeorder(orderstore $request)
    {
        try {
            $ordersuccess = $this->ordermanagementservice->placeorder($request);

            if ($ordersuccess) {
                return response()->json(['data' => true, 'route' => route('user.home')]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }        // Redirect or return a response as needed
    }


    public function orderstatus()
    {
        try {
            $orders = $this->ordermanagementservice->orderstatus();
            if ($orders) {
                return view('user.order.index', $orders);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function orderview($slug)
    {
        try {
            $data = $this->ordermanagementservice->orderview($slug);
            if ($data) {
                return view('user.order.view', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);;
        }
    }
    public function adminorderview($id)
    {
        try {
            $data = $this->ordermanagementservice->adminorderview($id);
            if ($data) {
                return view('admin.order.view', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);;
        }
    }

    public function changestatus(Request $request, $id)
    {
        try {
            $changestatus = $this->ordermanagementservice->changestatus($request, $id);
            if ($changestatus) {

                return redirect()->back()->with('success', 'Order status changed successfully ');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }



public function downloadInvoice($id)
{
    $order = Order::findOrFail($id);
    $orderItems = OrderItem::where('order_id', $id)->get();

    $pdf = Pdf::loadView('user.order.invoice', compact('order', 'orderItems'));

    return $pdf->download('invoice_' . $order->id . '.pdf');
}

}
