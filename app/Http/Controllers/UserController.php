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
    use ApiResponse;

    public function __construct(
        protected UserService $service
    ) {}

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $user = $this->service->createUser($request->validated());

        return $this->successResponse(
            data: ['user' => $user],
            message: 'User created successfully',
            code: 201
        );
    }

    public function deleteUser(int $id): JsonResponse
    {
        $this->service->deleteUser($id);

        return $this->successResponse(
            data: ['user' => $id],
            message: 'User deleted successfully'
        );
    }

    public function updateUser(int $id, UpdateUserRequest $request): JsonResponse
    {
        $user = $this->service->updateUser($id, $request->validated());

        return $this->successResponse(
            data: ['user' => $user],
            message: 'User updated successfully'
        );
    }

    public function getUser(GetIdsUserRequest $request): JsonResponse
    {
        $users = $this->service->getUser($request->validated());

        return $this->successResponse(
            data: ['users' => $users],
            message: 'Users retrieved successfully'
        );
    }

    public function getAllUsers(): JsonResponse
    {
        $users = $this->service->getAllUsers();

        return $this->successResponse(
            data: ['users' => $users],
            message: 'Users retrieved successfully'
        );
    }
}
