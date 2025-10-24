<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ProviderService;

class ProviderController extends Controller
{
    public function createProvider(Request $request, ProviderService $providerService): JsonResponse
    {
        try {
            $user = $providerService->createProvider($request);

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

    public function deleteProvider(Request $request, ProviderService $providerService): JsonResponse
    {
        try {
            $user = $providerService->deleteProvider($request->all());

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

    public function updateProvider($id, Request $request, ProviderService $providerService): JsonResponse
    {
        try {
            $user = $providerService->updateProvider($request, $id);

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


    public function getProvider(Request $request, ProviderService $providerService): JsonResponse
    {

        if (!$request->has('id') || empty($request->id)) {
            return response()->json([
                'status'  => false,
                'message' => 'id parameter is required',
                'code'    => 400
            ]);
        }

        try {
            $users = $providerService->getProvider($request->id);

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

    public function getAllProviders(ProviderService $providerService): JsonResponse
    {
        try {
            $users = $providerService->getAllProviders();

            if (!$users) {
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
