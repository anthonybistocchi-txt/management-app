<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('website.login.login');
    }

    public function login(LoginRequest $request, LoginService $service)
    {
        $credentials = $request->validated();

        try {
            $logged = $service->attempt($credentials);

            if ($logged) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Login successful',
                ], 200);
            }
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials.',
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'A server error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
