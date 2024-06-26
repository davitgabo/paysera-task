<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function createOrder(): Order
    {
        $user = Auth::user();

        $carts = $user->carts()->with('product')->get();

        $totalAmount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            // Add other necessary fields here
        ]);

        $carts->each->delete();

        return $order;
    }
}
