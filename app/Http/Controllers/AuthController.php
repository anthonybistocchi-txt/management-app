<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): JsonResponse
{
    try {
        $this->loginService->login(
            $request->validated(),
            $request->ip()
        );

        return response()->json([
            'status'  => true,
            'message' => 'user authenticated successfully',
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'status'  => false,
            'message' => 'validation error',
            'errors'  => $e->errors(),
        ], 422);


    } catch (ThrottleRequestsException $e) {
        return response()->json([
            'status'  => false,
            'message' => 'too many attempts',
        ], 429);

    } catch (\DomainException $e) {
        return response()->json([
            'status'  => false,                 // autenticação
            'message' => $e->getMessage(),
        ], 401);

    } catch (\Throwable $e) {
        return response()->json([
            'status'  => false,                                    
            'message' => 'unexpected server error',
        ], 500);
    }
}


    public function logout(): JsonResponse
    {
        try {
            $this->loginService->logout();

            return response()->json([
                'status'  => true,
                'message' => 'user logged out successfully',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error while processing logout',
            ], 500);
        }
    }
}
