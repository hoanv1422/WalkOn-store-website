<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {

            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->route('signin.index')->with('status', 'Vui lòng đăng nhập để truy cập trang quản trị.');
            }

            return redirect()->route('login')->with('status', 'Bạn cần đăng nhập để tiếp tục.');
        }

        return $next($request);
    }
}
