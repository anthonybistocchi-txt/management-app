<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected  $loginService;

   public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();
            
            $this->loginService->execute(
                $request->validated(),
                         $request->ip(),
                   $request->boolean('remember')
            );

            return response()->json([
                'status'  => true,
                'message' => 'user authenticated successfully',
                'code'    => 200,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'validation error',
                'errors'  => $e->errors(),
                'code'    => 422,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error',
                'errors'  => $e->getMessage(),
                'code'    => 500,
            ]);
        }
    }

    public function logout(): JsonResponse
    {
        $this->loginService->logout();

        return response()->json([
            'status'  => true,
            'message' => 'user logged out successfully',
            'code'    => 200,
        ]);
    }
}