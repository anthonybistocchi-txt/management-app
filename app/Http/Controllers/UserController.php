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
                'message'    => 'User create with successful',
                'data'       => $user,
                'statusCode' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => false,
                'message'    => 'Error to create user',
                'error'      => $e->getMessage(),
                'statusCode' => 500
            ]);
        }
    }

    public function deleteUser(Request $request, UserService $userService)
    {
        try {
            $user = $userService->deleteUser($request->all());

            if ($user) {
                return response()->json([
                    'status'     => true,
                    'message'    => 'User delete with successful',
                    'statusCode' => 200
                ]);
            }

            return response()->json([
                'status'     => true,
                'error'    => 'error to delete user',
                [
                    'message'    => 'User not exists',
                ],
                'statusCode' => 404

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => false,
                'message'    => 'Error to delete user',
                'error'      => $e->getMessage(),
                'statusCode' => 500
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
                    'status'     => true,
                    'message'    => 'User not exists',
                    'statusCode' => 404

                ]);
            }
            return response()->json([
                'status'     => true,
                'message'    => 'User updated with successful',
                'statusCode' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => false,
                'message'    => 'Error to update user',
                'error'      => $e->getMessage(),
                'statusCode' => 500
            ]);
        }
    }

    public function getUser($id, UserService $userService)
    {
        try {
            $user = $userService->getUser($id);

            if (!$user) {
                return response()->json([
                    'status'     => false,
                    'message'    => 'User not exists',
                    'statusCode' => 404

                ]);
            }
            return response()->json([
                'status'     => true,
                'data'       => $user,
                'statusCode' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => false,
                'message'    => 'Error to get user',
                'error'      => $e->getMessage(),
                'statusCode' => 500
            ]);
        }
    }

    public function getAllUsers(Request $request, UserService $userService)
    {
        try {
            $paginate = $request->get('paginate',10);
            $users = $userService->getAllUsers($paginate);
            return response()->json([
                'status'     => true,
                'data'       => $users,
                'statusCode' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => false,
                'message'    => 'Error to get users',
                'error'      => $e->getMessage(),
                'statusCode' => 500
            ]);
        }
    }
}
