<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (! $user) {
            return $request->expectsJson()
                ? response()->json(['status' => false, 'message' => 'not authorized.'], 401)
                : redirect('/login');
        }

        $allowed = array_map('intval', $roles);

        if (! in_array((int) $user->type_user_id, $allowed, true)) {
            return $request->expectsJson()
                ? response()->json(['status' => false, 'message' => 'no permission.'], 403)
                : abort(403, 'no permission to access this page.');
        }

        return $next($request);
    }
}
