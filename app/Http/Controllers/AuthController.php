<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected LoginService $loginService) {}

    public function login(Request $request): JsonResponse
    {
        $this->loginService->login(
            $request->only('username', 'password'),
            $request->ip()
        );

        return response()->json([
            'status'  => true,
            'message' => 'Login successful.',
        ],200);
    }

    public function logout(): JsonResponse
    {
        $this->loginService->logout(request()->ip());

        return response()->json([
            'status'  => true,
            'message' => 'Logout successful.',
        ],200);
    }
}
