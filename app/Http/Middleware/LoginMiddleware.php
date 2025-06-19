<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (session('is_admin')) {
            return $next($request);
        }

        if ($request->cookie('remember_admin')) {
            session(['is_admin' => true]);
            return $next($request);
        }
        return redirect()->route('login');
    }
}
