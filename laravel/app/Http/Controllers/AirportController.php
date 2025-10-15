<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\AirportModel;

class AirportController extends Controller
{
    //
    public function index(): JsonResponse
    {
        try{
            $airport = AiportModel::getAllAirports();  
            return response()->json([
                'success' => true,
                'data' => $airport,
                'count' => $airport->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message'=>'Error retrieving airports',
                'error' => $e->getMessage(),
            ],500);
          }
    }
    public function show($id): jsonResponse
    {
        try{
             $airport = AirportModel::getAirportById($id);
             if(!$airport){
                return response()->json([
                    'success' => false,
                    'message' => 'Airport not found'
                ], 404);
             }
                return response()->json([
                    'success' => true,
                    'data' => $airport
                ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving airport',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
