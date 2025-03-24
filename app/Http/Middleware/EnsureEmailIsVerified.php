<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->hasVerifiedEmail() && !$request->routeIs('verification.notice')) {
            return redirect()->route('verification.notice');
        }
        if ($user->hasVerifiedEmail() && $request->routeIs('verification.notice')) {
            return redirect('/');
        }
        return $next($request);
    }
}
