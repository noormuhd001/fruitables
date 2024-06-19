<?php

namespace App\Services\User\Cartmanagement;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartManagementService
{
    public function getCartItems()
    {
        $userId = Auth::id();
        return Cart::where('user_id', $userId)->get();
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $userId = Auth::id();

        $existingCart = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            $existingCart->quantity += 1;
            $existingCart->save();
        } else {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->user_id = $userId;
            $cart->name = $product->name;
            $cart->price = $product->price;
            $cart->photo = $product->photo;
            $cart->quantity = 1;
            $cart->save();
        }

        return 'Product added to cart successfully.';
    }

    public function updateCartQuantity($cartId, $quantity)
    {
        $cart = Cart::findOrFail($cartId);
        if ($cart) {
            $cart->quantity = $quantity;
            $cart->save();
            return ['success' => true, 'total' => $cart->price * $cart->quantity];
        }
        return ['success' => false, 'message' => 'Item not found in your cart.'];
    }

    public function removeCartItem($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        if ($cartItem) {
            $cartItem->delete();
            return ['success' => true];
        }
        return ['success' => false, 'message' => 'Item not found in your cart.'];
    }

    public function getCartCount()
    {
        $userId = Auth::id();
        return Cart::where('user_id', $userId)->count();
    }
}