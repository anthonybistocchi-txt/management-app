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
        $wantsJson = $request->expectsJson() || $request->is('api/*');

        if (! Auth::check()) {
            if ($wantsJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'user not authenticated, please login to continue.',
                ], 401);
            }

            return redirect('/login')
                ->withErrors(['user not authenticated, please login to continue.']);
        }

        if (! Session::has('login_ip') || ! Session::has('login_at')) {
            Auth::logout();

            if ($wantsJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'session expired, please login again.',
                ], 401);
            }

            return redirect('/login')
                ->withErrors(['session expired, please login again.']);
        }

        return $next($request);
    }
}
