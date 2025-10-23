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
                'message' => 'user not exist',
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
                    'message'  => 'user not exists',
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

    public function getUser($id, UserService $userService)
    {
        try {
            $user = $userService->getUser($id);

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'user not exists',
                    'code'    => 404

                ]);
            }
            return response()->json([
                'status'  => true,
                'message' => 'sucess',
                'data'    => $user,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to get user',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function getAllUsers(Request $request, UserService $userService)
    {
        try {
            $users = $userService->getAllUsers();

            if (!$users) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Users not exists',
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
