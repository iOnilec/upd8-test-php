<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientsRequest;
use App\Models\Client;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $clients = Client::all();

            return response()->json([
                'status' => 200,
                'message' => 'Requisição feita com sucesso.',
                'data' => $clients,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno do servidor.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientsRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $client = Client::create($data);

            return response()->json([
                'status' => 201,
                'message' => 'Cliente registrado com sucesso.',
                'data' => $client,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno do servidor.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {

            $client_id = Client::find($id);

            if (!$client_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cliente não encontrado.'
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Requisição feita com sucesso.',
                'data' => $client_id
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno do servidor.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientsRequest $request, string $id): JsonResponse
    {
        try {
            $data = $request->validated();

            $client_id = Client::find($id);

            if (!$client_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cliente não encontrado.'
                ], 404);
            }

            $client_id->update($data);

            return response()->json([
                'status' => 200,
                'message' => 'Cliente atualizado com sucesso.',
                'data' => $client_id,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno do servidor.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client_id = Client::find($id);

            if (!$client_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cliente não encontrado.'
                ], 404);
            }

            $client_id->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Cliente deletado com sucesso.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno do servidor.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }
}
