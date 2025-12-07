<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\GetIdsUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function createUser(CreateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser($request->validated());
            
            return response()->json([
                'status'  => true,
                'message' => 'User created successfully',
                'data'    => $user,
                'code'    => 201
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error creating user',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }


    public function deleteUser(int $id): JsonResponse
    {
        try {
          
            $this->userService->deleteUser($id);

            return response()->json([
                'status'  => true,
                'message' => 'User deleted successfully',
                'code'    => 200
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error deleting user',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function updateUser(int $id, UpdateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->updateUser($id, $request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'User updated successfully',
                'data'    => $user,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error updating user',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }


    public function getUser(GetIdsUserRequest $request, UserService $userService): JsonResponse
    {
        try {
            $data  = $request->validated();
            $users = $userService->getUser($data['ids']);

        return response()->json([
            'status'  => true,
            'message' => 'success', // corrigido typo 'sucess'
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

    public function getAllUsers(UserService $userService): JsonResponse
    {
        try {
            $users = $userService->getAllUsers();

            if (empty($users)) {
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
}
