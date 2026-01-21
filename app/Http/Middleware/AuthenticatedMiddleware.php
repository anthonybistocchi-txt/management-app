<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()) 
        {
            return redirect('/login')
            ->withErrors([
                'User not authenticated.' => 'Please log in to continue.'
            ]);
        }

        if(!Session::has('login_ip') || !Session::has('user_id')) 
        {
            Auth::logout();

            return redirect('/login')
            ->withErrors([
                'Session context missing.' => 'Please log in again to continue.'
            ]);
        }
        return $next($request);
    }
}
