<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->roles->contains('role_name', $role)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');

    }
}
