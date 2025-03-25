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
        // dd($request->all());
        $cartItemIds = explode(',', $request->cartItems);
        $cartItems = CartItem::query()->whereIn('id', $cartItemIds)->get();
        $totalPrice = $request->totalPrice;
        $couponCode = $request->couponCodeForOrder;
        $shippingFee = $request->shippingFee;
        $discountAmount = $request->discountAmount;
        $finalPrice = $request->finalPrice;

        return view('client.pages.checkout.index', compact("cartItems", "couponCode", "totalPrice", "shippingFee", "discountAmount", "finalPrice"));
    }
}
