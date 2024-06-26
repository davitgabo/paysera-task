<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->middleware('auth:api');

        $this->cartService = $cartService;
    }

    public function index()
    {
        return response()->json(CartResource::collection(Auth::user()->carts));
    }

    public function add(StoreCartRequest $request)
    {
        $cart = $this->cartService->add($request->validated());

        return response()->json(CartResource::make($cart));
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        if ($this->cartService->update($request->validated(), $cart)) {
            return response()->json(['message' => 'Cart updated successfully.']);
        } else {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }
    }

    public function remove(Cart $cart)
    {
        if ($this->cartService->remove($cart)) {
            return response()->json(['message' => 'Cart removed successfully.']);
        } else {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }
    }
}
