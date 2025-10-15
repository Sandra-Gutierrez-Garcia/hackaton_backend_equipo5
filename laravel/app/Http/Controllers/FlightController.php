<?php

namespace App\Http\Controllers;

use App\Models\FlightModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FlightController extends Controller
{
    /**
     * GET /api/flights - Obtener todos los vuelos
     */
    public function index(): JsonResponse
    {
        try {
            $flights = FlightModel::getAllFlights();
            
            return response()->json([
                'success' => true,
                'data' => $flights,
                'count' => $flights->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving flights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/flights/{id} - Obtener vuelo específico
     */
    public function show($id): JsonResponse
    {
        try {
            $flight = FlightModel::findFlightById($id);
            
            if (!$flight) {
                return response()->json([
                    'success' => false,
                    'message' => 'Flight not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $flight
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving flight',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/airports - Obtener todos los aeropuertos
     */
    public function getAirports(): JsonResponse
    {
        try {
            $airports = FlightModel::getAllAirports();
            
            return response()->json([
                'success' => true,
                'data' => $airports,
                'count' => $airports->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving airports',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/flights/airport/{id} - Vuelos por aeropuerto
     */
    public function getFlightsByAirport($id): JsonResponse
    {
        try {
            $flights = FlightModel::getFlightsByAirport($id);
            
            return response()->json([
                'success' => true,
                'data' => $flights,
                'count' => $flights->count(),
                'airport_id' => $id
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving flights by airport',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/flights/date/{date} - Vuelos por fecha
     */
    public function getFlightsByDate($date): JsonResponse
    {
        try {
            $flights = FlightModel::getFlightsByDate($date);
            
            return response()->json([
                'success' => true,
                'data' => $flights,
                'count' => $flights->count(),
                'date' => $date
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving flights by date',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/flights/type/{type} - Vuelos por tipo (entrada/salida)
     */
    public function getFlightsByType($type): JsonResponse
    {
        try {
            $flights = FlightModel::getFlightsByType($type);
            
            return response()->json([
                'success' => true,
                'data' => $flights,
                'count' => $flights->count(),
                'type' => $type
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving flights by type',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/flights/co2/airport/{id} - CO2 total por aeropuerto
     */
    public function getCO2ByAirport($id): JsonResponse
    {
        try {
            $totalCO2 = FlightModel::calculateCO2ByAirport($id);
            $flights = FlightModel::getFlightsByAirport($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'airport_id' => $id,
                    'total_co2_kg' => $totalCO2,
                    'total_co2_tons' => round($totalCO2 / 1000, 2),
                    'total_flights' => $flights->count(),
                    'average_co2_per_flight_kg' => $flights->count() > 0 ? 
                        round($totalCO2 / $flights->count(), 2) : 0
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error calculating CO2 by airport',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/flights/co2/highest - Vuelos con mayor emisión CO2
     */
    public function getHighestCO2Flights(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 10);
            $flights = FlightModel::getHighestCO2Flights($limit);
            
            return response()->json([
                'success' => true,
                'data' => $flights,
                'count' => $flights->count(),
                'limit' => $limit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving highest CO2 flights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * GET /api/flights/statistics - Estadísticas generales
     */
    public function getStatistics(): JsonResponse
    {
        try {
            $stats = FlightModel::getStatistics();
            $flights = FlightModel::getAllFlights();
            $airports = FlightModel::getAllAirports();
            
            // Calcular estadísticas adicionales
            $totalCO2 = $flights->sum('co2_estimado_kg');
            $avgPassengers = $flights->avg('pasajeros');
            
            return response()->json([
                'success' => true,
                'data' => [
                    'json_statistics' => $stats,
                    'calculated_statistics' => [
                        'total_flights' => $flights->count(),
                        'total_airports' => $airports->count(),
                        'total_co2_kg' => $totalCO2,
                        'total_co2_tons' => round($totalCO2 / 1000, 2),
                        'average_passengers_per_flight' => round($avgPassengers, 2),
                        'average_co2_per_flight_kg' => round($totalCO2 / $flights->count(), 2)
                    ]
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}