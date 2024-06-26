<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function add($data)
    {
        return Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $data['product_id']],
            ['quantity' => $data['quantity']]
        );

    }

    public function update($data, $cart)
    {
        if ($cart->user_id != Auth::id()) {
            return false;
        }
        $cart->update($data);

        return true;
    }

    public function remove($cart)
    {
        if ($cart->user_id != Auth::id()) {
            return false;
        }
        $cart->delete();
        return true;
    }
}
