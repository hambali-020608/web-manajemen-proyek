<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekKaryawan
{
    public function handle(Request $request, Closure $next,...$guards)
    {
        if (!Auth::guard('tukangs')->check() && !Auth::guard('karyawans')->check() && !Auth::guard('kliens')->check()) {
            return redirect('/');
        }
    
        return $next($request);

        // return $next($request);
    }
}
