<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\Cartmanagement\CartManagementService;

class CartController extends Controller
{
    private $cartManagementService;

    public function __construct(CartManagementService $cartManagementService)
    {
        $this->cartManagementService = $cartManagementService;
    }

    public function index()
    {
        try {

            $cart = $this->cartManagementService->getCartItems();
            if ($cart) {
                return view('user.cart.index', ['cart' => $cart]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $message = $this->cartManagementService->addToCart($request->id,$request);
            if ($message) {
                return redirect()->back()->with('success', $message);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        try {
            $response = $this->cartManagementService->updateCartQuantity($id, $request->quantity);
            if ($response) {
                return response()->json($response);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function remove($id)
    {
        try {
            $response = $this->cartManagementService->removeCartItem($id);
            if ($response) {
                return response()->json($response);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function getCartCount()
    {
        try {
            $count = $this->cartManagementService->getCartCount();
            if ($count) {
                return response()->json(['count' => $count]);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function checkout()
    {
        try {
            $cart = $this->cartManagementService->getCartItems();
            if ($cart) {
                return view('user.cart.checkout', ['cart' => $cart]);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
