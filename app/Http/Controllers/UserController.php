<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request, UserService $userService)
    {
        try {
            $data = $request->all();
            $user = $userService->createUser($data);

            return response()->json([
                'status'     => true,
                'message'    => 'user create with successful',
                'data'       => $user,
                'code'       => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => false,
                'message'    => 'error to create user',
                'error'      => $e->getMessage(),
                'code'       => 500
            ]);
        }
    }

    public function deleteUser(Request $request, UserService $userService)
    {
        try {
            $user = $userService->deleteUser($request->all());

            if ($user) {
                return response()->json([
                    'status'   => true,
                    'message'  => 'user delete with successful',
                    'code'     => 200
                ]);
            }

            return response()->json([
                'status'  => true,
                'error'   => 'error to delete user',
                'message' => 'user not found',
                'code'    => 404

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to delete user',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function updateUser($id, Request $request, UserService $userService)
    {
        try {

            $data = $request->all();

            $user = $userService->updateUser($id, $data);

            if (!$user) {
                return response()->json([
                    'status'   => true,
                    'message'  => 'user not found',
                    'code'     => 404

                ]);
            }
            return response()->json([
                'status'   => true,
                'message'  => 'user updated with successful',
                'code'     => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to update user',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function getUser(Request $request, UserService $userService)
    {
        if (!$request->has('id') || empty($request->id)) {
            return response()->json([
                'status'  => false,
                'message' => 'id parameter is required',
                'code'    => 400
            ]);
        }

        try {
            $users = $userService->getUser($request->id);

            if ($users->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'no users found',
                    'code'    => 404
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'sucess',
                'data'    => $users,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to get users',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }


    public function getAllUsers(UserService $userService)
    {
        try {
            $users = $userService->getAllUsers();

            if (!$users) {
                return response()->json([
                    'status'  => false,
                    'message' => 'users not found',
                    'code'    => 404

                ]);
            }
            return response()->json([
                'status'  => true,
                'message' => 'sucess',
                'data'    => $users,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to get users',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }
}
