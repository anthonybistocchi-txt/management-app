<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAndGestorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if($user->type_user_id !== 1 && $user->type_user_id !== 2) {
            auth()->logout();
            return redirect('/login')->withErrors(['Your account is inactive. Please contact support.', 403]);
        }
        return $next($request);
    }
}
