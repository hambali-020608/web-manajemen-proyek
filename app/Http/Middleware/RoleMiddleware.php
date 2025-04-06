<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $guard)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/')->withErrors(['msg' => 'Anda tidak memiliki akses.']);
        }

        return $next($request);
    }
}
