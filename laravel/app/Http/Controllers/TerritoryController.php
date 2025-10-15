<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TerritoryModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TerritoryController extends Controller
{
    /**
     * GET /api/health - Health check endpoint for Render
     */
    public function health(): JsonResponse
    {
        try {
            // Verificar conexión a base de datos
            DB::connection()->getPdo();
            $territoryCount = TerritoryModel::count();
            
            return response()->json([
                'status' => 'OK',
                'message' => 'API is running',
                'database' => 'Connected (SQLite)',
                'territories_count' => $territoryCount,
                'timestamp' => now()->toISOString(),
                'app_name' => config('app.name'),
                'app_env' => config('app.env')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Database connection failed',
                'error' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }
    /**
     * GET /api/health - Health check endpoint for Render
     */
    /* public function health(): JsonResponse
    {
        try {
            // Verificar conexión a base de datos
            DB::connection()->getPdo();
            $territoryCount = TerritoryModel::count();
            
            return response()->json([
                'status' => 'OK',
                'message' => 'API is running',
                'database' => 'Connected (SQLite)',
                'territories_count' => $territoryCount,
                'timestamp' => now()->toISOString(),
                'app_name' => config('app.name'),
                'app_env' => config('app.env')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Database connection failed',
                'error' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    } */

    /**
     * GET /api/territories - Obtener todos los territorios
     */
    public function index(): JsonResponse
    {
        try {
            $territories = TerritoryModel::all();
            return response()->json([
                'success' => true,
                'data' => $territories,
                'count' => $territories->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving territories'
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $territory = TerritoryModel::find($id);
            
            if (!$territory) {
                return response()->json([
                    'success' => false,
                    'message' => 'Territory not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $territory
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving territory'
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'citizens' => 'required|integer|min:0',
                'pollution_level' => 'required|numeric|min:0|max:100',
                'airport_id' => 'nullable|integer'
            ]);

            $territory = TerritoryModel::create($validated);

            return response()->json([
                'success' => true,
                'data' => $territory,
                'message' => 'Territory created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating territory'
            ], 500);
        }
    }

    /* public function getPollutionAnalysis(): JsonResponse{
        try{
            $territories = TerritoryModel::all();
            
        }
    } */
}
