<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->roles;

            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }
        Auth::logout();
        return redirect()->route('login');
    }
}
