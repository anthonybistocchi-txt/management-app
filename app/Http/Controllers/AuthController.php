<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private const ADMIN  = 1;
    private const GESTOR = 2;

    public function __construct(protected LoginService $loginService) {}

    public function login(Request $request): JsonResponse
    {
        $this->loginService->login(
            $request->only('username', 'password'),
            $request->ip()
        );

        $typeUserId  = (int) Auth::user()->type_user_id;
        
        $redirectUrl = in_array($typeUserId, [self::ADMIN, self::GESTOR], true)
            ? '/index/dashboard'
            : '/index/stock-out';

        return response()->json([
            'status'       => true,
            'message'      => 'Login successful.',
            'redirect_url' => $redirectUrl,
        ]);
    }

    public function logout(): JsonResponse
    {
        $this->loginService->logout(request()->ip());

        return response()->json([
            'status'  => true,
            'message' => 'Logout successful.',
        ]);
    }
}
