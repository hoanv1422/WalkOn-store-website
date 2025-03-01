<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {

        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.index', compact('categories', 'colors'));
    }

    public function show()
    {
        $user = Auth::user();
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.index', compact('user', 'categories', 'colors'));
    }
}