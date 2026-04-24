<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user() || ($role === 'admin' && !$request->user()->isAdmin())) {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        if ($role === 'staff' && !$request->user()->isStaff()) {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
