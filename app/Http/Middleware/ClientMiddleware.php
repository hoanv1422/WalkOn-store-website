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
        // Kiểm tra xem request có phải là API không
        $isApiRequest = $request->expectsJson() || $request->is('api/*');

        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            if ($isApiRequest) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bạn chưa đăng nhập! Vui lòng đăng nhập để thực hiện chức năng này.'
                ], 401); 
            }
            return redirect('/login')->with('error', 'Bạn cần đăng nhập để truy cập.');
        }

        // Kiểm tra vai trò người dùng
        $user = Auth::user();
        if ($user->role === 'user' || $user->role === 'admin' || $user->role === 'shipper') {
            return $next($request);
        }

        // Nếu đã đăng nhập nhưng không có quyền
        if ($isApiRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn không có quyền truy cập tài nguyên này.'
            ], 403); // Mã 403 cho lỗi không có quyền
        }
        return abort(403, 'Bạn không có quyền truy cập trang này.');
    }
}
