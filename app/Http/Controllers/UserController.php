<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\Request as ClientRequest;
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
                'message'  => 'invalid datas',
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

    public function deleteUser($id, UserService $userService): JsonResponse
    {
        try {
            $user = $userService->deleteUser($id);

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
            $user = $userService->updateUser($id, $request);

            return response()->json([
                'status'  => true,
                'message' => 'Usuário atualizado com sucesso!',
                'data'    => $user,
                'code'    => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Usuário não encontrado.',
                'code'    => 404
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Dados inválidos.',
                'errors'  => $e->errors(), // Mostra os erros
                'code'    => 422
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Erro ao atualizar usuário',
                'error'   => $e->getMessage(),
                'code'    => 500
            ], 500);
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

    public function getAllUsers(UserService $userService): JsonResponse
    {
        try {
            $users = $userService->getAllUsers();

            if (empty($users)) {
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
