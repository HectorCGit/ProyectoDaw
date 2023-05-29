<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCompanyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->hasRole('company')) {

            return redirect()->route('homeCompany');
        }

abort(403);
    }
}
