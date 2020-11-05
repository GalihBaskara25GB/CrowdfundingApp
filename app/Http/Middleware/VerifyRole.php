<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verify user's role, only admin is allowed to continue the request
        if (Auth::user()->isAdmin()) {
            return $next($request);
        }
        abort(403);
    }
}
