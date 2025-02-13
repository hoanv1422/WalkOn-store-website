<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Bạn cần đăng kí,đăng nhập tài khoản trước khi vào admin.');
        }
        return $next($request);
    }
}
