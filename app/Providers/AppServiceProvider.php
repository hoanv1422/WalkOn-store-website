<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\website_information;
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
            $brands = Brand::where('is_active', true)->get();
            $footer = website_information::first();
            $view->with([
                'categories' => $categories,
                'brands' => $brands,
                'footer' => $footer
            ]);
        });

        View::composer('client.partials.footer', function ($view) {
            $categories = Category::where('is_active', true)->get();
            $brands = Brand::where('is_active', true)->get();
            $footer = website_information::first();
            $view->with([
                'categories' => $categories,
                'brands' => $brands,
                'footer' => $footer
            ]);
        });
    }
}