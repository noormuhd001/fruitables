<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\categorymanagent\categoryStoreRequest;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\categorymanagent\categoryupdateRequest;
use App\Services\Admin\Categorymanagement\CategoryManagementService;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    //
    private $categoryManagementService;
    public function __construct(CategoryManagementService $categoryManagementService)
    {
        $this->categoryManagementService = $categoryManagementService;
    }
    public function index()
    {
        try {
            $category = $this->categoryManagementService->index();
            if ($category) {
                return view('admin.category.index', ['category' => $category]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function store(categoryStoreRequest $request)
    {
        try {
            $store = $this->categoryManagementService->store($request);
            if ($store) {
                return redirect()->back()->with('success', 'Category added successfully!');
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
            $category = $this->categoryManagementService->edit($id);
            if ($category) {
                return view('admin.category.view', ['category' => $category]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }


    public function update(categoryupdateRequest $request)
    {
        try {
            $update = $this->categoryManagementService->update($request);
            if ($update) {
                return redirect()->route('category.index')->with('success', 'Category updated successfully!');
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
            $category = $this->categoryManagementService->delete($id);
            if ($category) {
                return redirect()->back()->with('success', 'product deleted successfully');
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

        if ($request->ajax()) {
            $category = categories::select('*');
            return DataTables::of($category)
            ->addColumn('action', function ($category) {
                return '<a href="' . route('category.edit', $category->id) . '" class="btn btn-primary btn-sm">Edit</a>
                        <a href="' . route('category.delete', $category->id) . '" class="btn btn-danger btn-sm">Delete</a>';
            })
            
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
