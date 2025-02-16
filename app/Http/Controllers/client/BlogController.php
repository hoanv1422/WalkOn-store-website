<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('client.pages.blog.index');
    }

    public function index2()
    {
        return view('client.pages.blog-detail.index');
    }
}
