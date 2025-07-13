<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitiesRequest;
use App\Models\City;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $cities = City::all();

            return response()->json([
                'status' => 200,
                'message' => 'Requisição feita com sucesso.',
                'data' => $cities,
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
    public function store(CitiesRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $city = City::create($data);

            return response()->json([
                'status' => 201,
                'message' => 'Cidade registrada com sucesso.',
                'data' => $city,
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
            $city_id = City::find($id);

            if (!$city_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cidade não encontrada.',
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Requisição feita com sucesso.',
                'data' => $city_id,
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
    public function update(CitiesRequest $request, string $id): JsonResponse
    {
        try {
            $data = $request->validated();

            $city_id = City::find($id);

            if (!$city_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cidade não encontrada.',
                ], 404);
            }

            $city_id->update($data);

            return response()->json([
                'status' => 200,
                'message' => 'Cidade atualizada com sucesso.',
                'data' => $city_id,
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
    public function destroy(string $id): JsonResponse
    {
        try {
            $city_id = City::find($id);

            if (!$city_id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cidade não encontrada.',
                ], 404);
            }

            $city_id->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Cidade deletada com sucesso.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno do servidor.',
                'status' => 500,
            ], 500);
        }
    }
}
