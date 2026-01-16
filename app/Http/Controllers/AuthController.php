<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiResponse;
    public function __construct(protected LoginService $loginService) {}

    public function login(Request $request): JsonResponse
    {
        $this->loginService->login(
            $request->only('username', 'password'),
            $request->ip()
        );

        return $this->successResponse(
            data: [],
            message: 'Login realizado com sucesso'
        );
    }

    public function logout(): JsonResponse
    {
        $this->loginService->logout(request()->ip());

        return $this->successResponse(
            data: [],
            message: 'Logout realizado com sucesso'
        );
    }
}
