<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('signin.index')->with('status', 'Vui lòng đăng nhập để vào trang quản trị.');
        }

        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('status', 'Bạn không có quyền truy cập trang admin.');
        }

        return $next($request);
    }
}
