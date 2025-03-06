<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::id();
        $cart = Cart::where("user_id", $user)->first();

        if (!$cart) {
            return view('client.pages.checkout.index', [
                "cartItems" => [],
                "totalAmount" => 0
            ]);
        }

        $cartItems = CartItem::where("cart_id", $cart->id)->get();

        $totalAmount = $cartItems->sum(function ($item) {
            $unitPrice = $item->productVariant->price_sale && $item->productVariant->price_sale < $item->productVariant->price
                ? $item->productVariant->price_sale
                : $item->productVariant->price;

            return $unitPrice * $item->quantity;
        });

        return view('client.pages.checkout.index', compact("cartItems", "totalAmount"));
    }
}
