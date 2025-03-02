<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('client.partials.header', function ($view) {
            $categories = Category::where('is_active', true)->get();
            $cartCount = 0;
            $subTotal = 0;
            $cartItems = collect(); 

            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();

                if ($cart) {
                    $allCartItems = CartItem::where('cart_id', $cart->id)->get();
                    $cartCount = $allCartItems->count();
                    $subTotal = $allCartItems->sum('price');

                    $cartItems = CartItem::where('cart_id', $cart->id)
                        ->orderBy('created_at', 'desc')
                        ->take(2)
                        ->get();
                }
            }

            $view->with([
                'categories' => $categories,
                'cartCount' => $cartCount,
                'subTotal' => $subTotal,
                'cartItems' => $cartItems,
            ]);
        });
    }
}
