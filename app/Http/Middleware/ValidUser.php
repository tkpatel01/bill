<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (Auth::check()) {
            $checkrole = $role;
            $currentUserRole = Auth::user()->role;

            if (in_array($currentUserRole, $checkrole)) {
                return $next($request);
            }
        } else {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }
}