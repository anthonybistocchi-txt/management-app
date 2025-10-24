<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function createUser(Request $request, UserService $userService): JsonResponse
    {
        try {
            $user = $userService->createUser($request);

            return response()->json([
                'status'     => true,
                'message'    => 'user create with successful',
                'data'       => $user,
                'code'       => 201
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'   => false,
                'message'  => 'invalid data',
                'errors'   => $e->getMessage(),
                'code'     => 422
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

    public function deleteUser(Request $request, UserService $userService): JsonResponse
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

    public function updateUser($id, Request $request, UserService $userService): JsonResponse
    {
        try {
            $user = $userService->updateUser($request, $id);

            return response()->json([
                'status'  => true,
                'message' => 'user updated with sucessful',
                'data'    => $user,
                'code'    => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'user not found',
                'code'    => 404
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'invalid data',
                'errors'  => $e->errors(), // Mostra os erros
                'code'    => 422
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


    public function getUser(Request $request, UserService $userService): JsonResponse
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
                    'message' => 'not found users',
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

    public function getAllUsers(UserService $userService): JsonResponse
    {
        try {
            $users = $userService->getAllUsers();

            if (!$users) {
                return response()->json([
                    'status'  => false,
                    'message' => 'not found users',
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
