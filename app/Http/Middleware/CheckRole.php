<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->away('https://sso.unuja.ac.id');
        }

        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        return redirect()->route('beranda')->with('error', 'Akses tidak diizinkan');
    }
}
