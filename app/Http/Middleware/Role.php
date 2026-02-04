<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        //Split the string 'admin|branch-manager' into an array ['admin', 'branch-manager']
        $roles = explode('|', $role);
        if (!in_array($request->user()->role, $roles)) {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
