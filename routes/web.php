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
Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('/product/update',[ProductController::class,'update'])->name('product.update');
Route::get('/product/{id}/delete',[ProductController::class,'delete'])->name('product.delete');

//customercontroller
Route::get('/user',[customerController::class,'index'])->name('customer.index');
Route::post('/user/add',[customerController::class,'store'])->name('customer.store');
Route::get('/product/edit/{id}',[customerController::class,'edit'])->name('customer.edit');
Route::post('/product/update',[CustomerController::class,'update'])->name('customer.update');
Route::get('/product/delete/{id}',[customerController::class,'delete'])->name('customer.delete');

//ordercontroller
Route::get('/orders',[OrderController::class,'index'])->name('order.index');


//categorycontroller
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::post('/category/add',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/update',[CategoryController::class,'update'])->name('category.update');
Route::get('/category/{id}/delete',[CategoryController::class,'delete'])->name('category.delete');