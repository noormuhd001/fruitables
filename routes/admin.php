<?php

use App\Http\Controllers\Admin\adminprofilecontroller;
use App\Http\Controllers\Admin\customerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Offercontroller;
use App\Http\Controllers\AuthController;
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

Route::get('/adminpage',[AuthController::class,'adminhome'])->name('admindashboard'); 

 


//product controller
Route::get('products/list', [ProductController::class, 'getProducts'])->name('products.list');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/updates', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');

//customercontroller
Route::get('/customer', [customerController::class, 'index'])->name('customer.index');
Route::post('/customer/add', [customerController::class, 'store'])->name('customer.store');
Route::get('/customer/edit/{id}', [customerController::class, 'edit'])->name('customer.edit');
Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::get('/customer/delete/{id}', [customerController::class, 'delete'])->name('customer.delete');
Route::get('/customers/getdata',[customerController::class,'getData'])->name('customer.getdata');

//ordercontroller
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/getdata',[OrderController::class,'getData'])->name('order.getdata');
Route::get('/orders/view/{id}',[OrderController::class,'edit'])->name('order.view');
Route::get('/orders/adminorderview/{id}',[OrderController::class,'adminorderview'])->name('order.adminorderview');
Route::post('/orders/changestatus/{id}',[OrderController::class,'changestatus'])->name('order.changestatus');


//categorycontroller
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/add', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('/category/getdata',[CategoryController::class,'getData'])->name('category.getdata');

//Offercontroller

Route::get('/offers', [Offercontroller::class, 'index'])->name('offer.index');
Route::get('/offer/get', [Offercontroller::class, 'getData'])->name('offer.list');
Route::get('/offer/add', [Offercontroller::class, 'add'])->name('offer.add');
Route::post('/offer/create', [Offercontroller::class, 'create'])->name('offer.create');
Route::post('/offer/store', [OfferController::class, 'store'])->name('offer.store');
Route::get('/offer/{id}/edit', [offerController::class, 'edit'])->name('offer.edit');
Route::post('/offer/updates', [offerController::class, 'update'])->name('offer.update');
Route::get('/offer/{id}/delete', [offerController::class, 'delete'])->name('offer.delete');


//profilecontroller

Route::get('/aprofile',[adminprofilecontroller::class,'index'])->name('adminprofile.index');