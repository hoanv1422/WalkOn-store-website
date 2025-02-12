<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;

class SidebarController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $colors = Color::all();
        return view('client.layouts.sidebar.sidebar', compact('categories', 'colors'));
    }
}
