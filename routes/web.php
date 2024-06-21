<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\CartController;
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

Route::middleware(['auth'])->group(function () {
    include('admin.php');

    //user

    Route::get('/home', [HomeController::class, 'index'])->name('user.home');
    Route::get('/shop', [HomeController::class, 'shop'])->name('user.shop');
    Route::get('/logout', [HomeController::class, 'logout'])->name('user.logout');
    Route::get('/profile',[HomeController::class,'profile'])->name('user.profile');




    Route::get('/shop/product/{id}', [ShopController::class, 'view'])->name('item.view');
    Route::get('/shop/offer',[ShopController::class,'offerview'])->name('user.featuredproducts');
    Route::post('/shop/offer/addtocart',[ShopController::class,'addtocart'])->name('user.offeraddtocart');


    //review

    Route::post('/submit-review', [ReviewController::class, 'store'])->name('review.post');
    Route::get('/contact', [ReviewController::class, 'contact'])->name('user.contact');

    //cart


    Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('/addtocart', [CartController::class, 'addTocart'])->name('user.addtocart');
    Route::post('/cart/remove/{id}', [CartController::class, 'delete'])->name('cart.remove');
    Route::post('/cart/update/{id}', [CartController::class, 'updatequantity'])->name('cart.updateQuantity');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');

    //order

    Route::post('/order', [orderController::class, 'placeorder'])->name('order.place');
    Route::get('/orderstatus', [OrderController::class, 'orderstatus'])->name('order.status');
    Route::get('/orderstatus/{id}', [OrderController::class, 'orderview'])->name('order.detail');
});





Route::get('/', [AuthController::class, 'loginpage'])->name('loginpage');
Route::get('/signuppage', [AuthController::class, 'signuppage'])->name('signuppage');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/adminlogout', [AuthController::class, 'adminLogout'])->name('admin.logout');



Route::get('/forgotpassword', [AuthController::class, 'forgotpassword'])->name('forgotpassword');
Route::post('/forgot/mail', [AuthController::class, 'email'])->name('forgot.email');
Route::get('/verification/{email}', [AuthController::class, 'verify'])->name('email.verify');
Route::post('/confirmpassword/submit', [AuthController::class, 'submit'])->name('confirmpassword');
