<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsGestorMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user) {
            return $request->expectsJson()
                ? response()->json(['error' => 'not authenticated'], 401)
                : redirect('/login')->withErrors(['user not authenticated, please login to continue.']);
        }

        $typeUserId = (int) ($user->type_user_id ?? 0);
        $allowed = [1, 2]; 

        if (! in_array($typeUserId, $allowed, true)) {
            return $request->expectsJson()
                ? response()->json(['status' => false, 'message' => 'access denied'], 403)
                : abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
