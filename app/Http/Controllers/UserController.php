<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\GetAllUsersPaginated;
use App\Http\Requests\User\GetUserByIdRequest;
use App\Http\Requests\User\GetUserByIdsRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        dd($request->all());
        $this->service->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'User updated successfully',
        ], 200);
    }

    public function getByIds(GetUserByIdsRequest $request): JsonResponse
    {
        $users = $this->service->getByIds($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => 'Users retrieved successfully',
            'data'    => $users
        ], 200);
    }

    public function getById(GetUserByIdRequest $request): JsonResponse
    {
        $user = $this->service->getById($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => 'User retrieved successfully',
            'data'    => $user
        ], 200);
    }

    public function getAll(GetAllUsersPaginated $request): JsonResponse
    {
        $users = $this->service->getAll($request->validated());

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
