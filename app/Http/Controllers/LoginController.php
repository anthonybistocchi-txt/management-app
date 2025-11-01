<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LoginService;

class LoginController extends Controller
{
    public function loginAttempt(Request $request, LoginService $loginService)
    {
        try {
            $status = $loginService->loginAttempt($request);

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
