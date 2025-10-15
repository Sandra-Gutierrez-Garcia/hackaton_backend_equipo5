<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FlightModel extends Model
{
    // No usar base de datos, trabajar solo con JSON
    public $timestamps = false;
    
    /**
     * Obtener todos los vuelos desde el JSON
     */
    public static function getAllFlights()
    {
        $jsonPath = base_path(env('FLIGHTS_JSON_PATH', 'flights.json'));
        
        if (!file_exists($jsonPath)) {
            return collect([]);
        }
        
        $data = json_decode(file_get_contents($jsonPath), true);
        return collect($data['vuelos'] ?? []);
    }
    
    /**
     * Obtener aeropuertos desde el JSON
     */
    public static function getAllAirports()
    {
        $jsonPath = base_path(env('FLIGHTS_JSON_PATH', 'flights.json'));
        
        if (!file_exists($jsonPath)) {
            return collect([]);
        }
        
        $data = json_decode(file_get_contents($jsonPath), true);
        return collect($data['aeropuertos'] ?? []);
    }
    
    /**
     * Obtener estadísticas desde el JSON
     */
    public static function getStatistics()
    {
        $jsonPath = base_path(env('FLIGHTS_JSON_PATH', 'flights.json'));
        
        if (!file_exists($jsonPath)) {
            return null;
        }
        
        $data = json_decode(file_get_contents($jsonPath), true);
        return $data['estadisticas'] ?? null;
    }
    
    /**
     * Buscar vuelo por ID
     */
    public static function findFlightById($id)
    {
        $flights = self::getAllFlights();
        return $flights->where('id_vuelo', $id)->first();
    }
    
    /**
     * Filtrar vuelos por aeropuerto
     */
    public static function getFlightsByAirport($aeropuertoId)
    {
        $flights = self::getAllFlights();
        return $flights->where('aeropuerto_id', $aeropuertoId);
    }
    
    /**
     * Filtrar vuelos por fecha
     */
    public static function getFlightsByDate($fecha)
    {
        $flights = self::getAllFlights();
        return $flights->where('fecha', $fecha);
    }
    
    /**
     * Filtrar vuelos por tipo (entrada/salida)
     */
    public static function getFlightsByType($tipo)
    {
        $flights = self::getAllFlights();
        return $flights->where('tipo', $tipo);
    }
    
    /**
     * Calcular CO2 total por aeropuerto
     */
    public static function calculateCO2ByAirport($aeropuertoId)
    {
        $flights = self::getFlightsByAirport($aeropuertoId);
        return $flights->sum('co2_estimado_kg');
    }
    
    /**
     * Obtener vuelos con mayor CO2
     */
    public static function getHighestCO2Flights($limit = 10)
    {
        $flights = self::getAllFlights();
        return $flights->sortByDesc('co2_estimado_kg')->take($limit);
    }
}