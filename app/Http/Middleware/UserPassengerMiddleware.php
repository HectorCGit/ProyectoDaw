<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserPassengerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->hasRole('passenger')) {
            return $next($request);
        }
        abort(403);
    }
}
