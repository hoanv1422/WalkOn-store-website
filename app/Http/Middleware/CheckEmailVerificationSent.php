<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerificationSent
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('email_verification_sent')) {
            return redirect('/email/verify')->with('error', 'Bạn chưa gửi yêu cầu xác thực email.');
        }
        return $next($request);
    }
}
