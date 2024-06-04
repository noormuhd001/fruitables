<?php

use App\Http\Controllers\Admin\customerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('admindashboard');


//product controller
Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');






//customercontroller
Route::get('/user',[customerController::class,'index'])->name('customer.index');
Route::post('/user/add',[customerController::class,'store'])->name('customer.store');


//ordercontroller
Route::get('/orders',[OrderController::class,'index'])->name('order.index');


//categorycontroller
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
route::post('/category/add',[CategoryController::class,'store'])->name('category.store');