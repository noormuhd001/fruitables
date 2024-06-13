<?php

use App\Http\Controllers\Admin\customerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\ShopController;
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
include('admin.php');

//user

Route::get('/home',[HomeController::class,'index'])->name('user.home');
Route::get('/shop',[HomeController::class,'shop'])->name('user.shop');
Route::get('/shop/product/{id}',[ShopController::class,'view'])->name('item.view');




//review

Route::post('/submit-review', [ReviewController::class, 'store'])->name('review.post');



//Login pages



Route::get('/loginpage',[AuthController::class,'loginpage'])->name('loginpage');
Route::get('/signuppage',[AuthController::class,'signuppage'])->name('signuppage');
Route::post('/signup',[AuthController::class,'signup'])->name('signup');
Route::post('/login',[AuthController::class,'login'])->name('login');