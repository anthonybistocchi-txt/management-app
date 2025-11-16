<?php

namespace App\Http\Controllers;

;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\LoginService;

class LoginController extends Controller
{
    public function loginAttempt(LoginService $loginService, LoginRequest $request): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $status        = $loginService->loginAttempt($dataValidated);

            if ($status) {
                return response()->json([
                    'status'  => true,
                    'message' => "login valid",
                    'code'    => 200
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => "password or email invalid",
                'code'    => 401
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "invalid datas",
                'error'   => $e->getMessage(),
                'code'    => 422
            ]);
        }
    }

    public function logout(Request $request, LoginService $loginService)
    {
        $loginService->logout($request);

        return response()->json([
            'status'  => true,
            'message' => "user logout",
            'code'    => 200
        ]);
    }
}
