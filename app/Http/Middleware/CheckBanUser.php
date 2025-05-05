<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\alert;

class CheckBanUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Kiểm tra trạng thái cấm của người dùng
            if (Auth::user()->is_active == false) {
                Auth::logout();
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Tài khoản của bạn đã bị cấm.'
                    ], Response::HTTP_FORBIDDEN); // 403 Forbidden
                }
                return redirect()->route('login.form')->with('message', 'Tài khoản của bạn đã bị cấm.');
            }
        }

        return $next($request);
    }
}
