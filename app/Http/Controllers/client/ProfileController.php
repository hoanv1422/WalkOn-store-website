<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('orderItems')->get();
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.my-account', compact('user', 'orders', 'categories', 'colors'));
    }

    public function show()
    {
        $user = Auth::user();
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.index', compact('user', 'categories', 'colors'));
    }
}
