<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepresentativeRequest;
use App\Models\Representative;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RepresentativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $representatives = Representative::all();

            return response()->json([
                'status' => 200,
                'message' => 'Requisição feita com sucesso.',
                'data' => $representatives,
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
    public function store(RepresentativeRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $representative = Representative::create($data);

            return response()->json([
                'status' => 201,
                'message' => 'Representante registrado com sucesso.',
                'data' => $representative,
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
    public function show(string $id)
    {
        try {
            $representative_id = Representative::find($id);

            if (!$representative_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Representante não encontrado.',
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Requisição feita com sucesso.',
                'data' => $representative_id
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
    public function update(RepresentativeRequest $request, string $id): JsonResponse
    {
        try {
            $data = $request->validated();

            $representative_id = Representative::find($id);

            if (!$representative_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Representante não encontrado.',
                ], 404);
            }

            $representative_id->update($data);

            return response()->json([
                'status' => 200,
                'message' => 'Representante atualizado com sucesso.',
                'data' => $representative_id
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
            $representative_id = Representative::find($id);

            if (!$representative_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Representante não encontrado.',
                ], 404);
            }

            $representative_id->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Representante deletado com sucesso.',
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
