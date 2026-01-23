<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function create(CreateUserRequest $request): JsonResponse
    {
        $this->service->create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'User created successfully',
        ], 201);
    }

    public function delete(DeleteUserRequest $request): JsonResponse
    {
        $this->service->delete($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => 'User deleted successfully',
        ], 200);
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        $this->service->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'User updated successfully',
        ], 200);
    }

    public function get(GetUserRequest $request): JsonResponse
    {
        $users = $this->service->get($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => 'Users retrieved successfully',
            'data'    => $users
        ], 200);
    }

    public function getAll(): JsonResponse
    {
        $users = $this->service->getAll();

        return response()->json([
            'status'  => true,
            'message' => 'Users retrieved successfully',
            'data'    => $users
        ], 200);
    }

    public function getUserLogged(): JsonResponse
    {
        $user = $this->service->getUserLogged();

        return response()->json([
            'status'  => true,
            'message' => 'Logged user retrieved successfully',
            'data'    => $user
        ], 200);
    }
}
