<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordResetRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('password_reset_requested')) {
            return redirect('/forgot-password')->withErrors(['error' => 'Bạn cần yêu cầu đặt lại mật khẩu trước.']);
        }
        return $next($request);
    }
}
