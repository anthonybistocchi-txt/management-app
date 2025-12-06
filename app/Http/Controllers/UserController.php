<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Traits\ApiResponse;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use ApiResponse;

    public function createUser(CreateUserRequest $request, UserService $userService): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $user          = $userService->createUser($dataValidated);
            
            return $this->createdResponse($user, 'User created successfully');
        } catch (ValidationException $e) {
            return $this->validationErrorResponse('Invalid data', $e->getMessage());
        } catch (\Exception $e) {
            return $this->errorResponse('Error creating user', $e->getMessage());
        }
    }

    public function deleteUser($id, UserService $userService): JsonResponse
    {
        try {
            $user = $userService->deleteUser($id);

            if ($user) {
                return $this->successResponse(null, 'User deleted successfully');
            }

            return $this->notFoundResponse('User not found');
        } catch (\Exception $e) {
            return $this->errorResponse('Error deleting user', $e->getMessage());
        }
    }

    public function updateUser($id, UpdateUserRequest $request, UserService $userService): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $user = $userService->updateUser($id, $dataValidated);

            return $this->successResponse($user, 'User updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('User not found');
        } catch (ValidationException $e) {
            return $this->validationErrorResponse('Invalid data', $e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Error updating user', $e->getMessage());
        }
    }


    public function getUser(Request $request, UserService $userService): JsonResponse
    {

        if (!$request->has('id') || empty($request->id)) {
            return $this->errorResponse('ID parameter is required', null, 400);
        }

        try {
            $users = $userService->getUser($request->id);

            if ($users->isEmpty()) {
                return $this->notFoundResponse('Users not found');
            }

            return $this->successResponse($users);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving users', $e->getMessage());
        }
    }

    public function getAllUsers(UserService $userService): JsonResponse
    {
        try {
            $users = $userService->getAllUsers();

            if (empty($users)) {
                return $this->notFoundResponse('Users not found');
            }
            
            return $this->successResponse($users);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving users', $e->getMessage());
        }
    }
}

