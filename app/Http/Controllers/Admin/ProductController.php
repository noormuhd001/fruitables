<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\productmanagement\productStoreRequest;
use App\Http\Requests\productmanagement\productUpdateRequest;
use App\Models\categories;
use App\Services\Admin\Productmanagement\ProductManagementService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    private $productmanagementservice;
    public function __construct(ProductManagementService $productManagementService)
    {
        $this->productmanagementservice = $productManagementService;
    }

    public function index()
    {
        try {
            $index = $this->productmanagementservice->index();
            if ($index) {
                return view('admin.product.index', $index);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function add()
    {
        try {
            $category = categories::all();
            return view('admin.product.add', ['category' => $category]);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function getProducts(Request $request)
    {
        try {
            if ($request->ajax()) {
                $products = Product::select('*');

                // Apply filter by category
                if ($request->has('category') && !empty($request->category)) {
                    $products->where('category', $request->category);
                }

                // Apply DataTables search and filter
                return DataTables::of($products)

                    ->addColumn('action', function ($product) {
                        return '<a href="' . route('product.edit', $product->id) . '" class="btn btn-primary btn-sm">Edit</a>
                            <a href="' . route('product.delete', $product->id) . '" class="btn btn-danger btn-sm">Delete</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }



    public function store(productStoreRequest $request)
    {
        // Save product to database
        try {
            $product = $this->productmanagementservice->store($request);
            if ($product) {
                return redirect()->back()->with('success', 'product added successfully!');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }


    public function edit($id)
    {
        try {
            $data = $this->productmanagementservice->edit($id);
            if ($data) {
                return view('admin.product.view', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function update(productUpdateRequest $request)
    {
        try {
            $product = $this->productmanagementservice->update($request);
            if ($product) {
                return redirect()->route('product.index')->with('success', 'product edited successfully');
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
            $delete = $this->productmanagementservice->delete($id);
            if ($delete) {
                return redirect()->back()->with('success', 'product deleted successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
