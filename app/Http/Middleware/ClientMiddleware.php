<?php

namespace App\Http\Middleware;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Bạn cần đăng nhập để truy cập.');
        }

        $user = Auth::user();
        if ($user->role === 'user' || $user->role === 'admin') {
            return $next($request);
        }

        // Nếu đã đăng nhập nhưng không có quyền, trả về lỗi 403
        return abort(403, 'Bạn không có quyền truy cập trang này.');
    }
}
