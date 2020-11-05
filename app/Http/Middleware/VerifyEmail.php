<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyEmail
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
        // Verify user's email, only user with verified email is allowed to continue the request
        if (Auth::user()->isEmailVerified()) {
            return $next($request);
        }
        abort(403);
    }
}
