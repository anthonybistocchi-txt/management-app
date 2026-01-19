<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\GetIdsUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function __construct(protected UserService $service) {}

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $user = $this->service->createUser($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'User created successfully',
        ], 201);
    }

    public function deleteUser(int $id): JsonResponse
    {
        $this->service->deleteUser($id);

        return response()->json([
            'status'  => true,
            'message' => 'User deleted successfully',
        ], 200);
    }

    public function updateUser(int $id, UpdateUserRequest $request): JsonResponse
    {
        $this->service->updateUser($id, $request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'User updated successfully',
        ], 200);
    }

    public function getUser(GetIdsUserRequest $request): JsonResponse
    {
        $users = $this->service->getUser($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Users retrieved successfully',
            'data'    => ['users' => $users]
        ], 200);
    }

    public function getAllUsers(): JsonResponse
    {
        $users = $this->service->getAllUsers();

        return response()->json([
            'status'  => true,
            'message' => 'Users retrieved successfully',
            'data'    => ['users' => $users]
        ], 200);
    }
}
