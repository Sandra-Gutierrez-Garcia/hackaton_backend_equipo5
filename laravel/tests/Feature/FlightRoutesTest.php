<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightRoutesTest extends TestCase
{
    /**
     * Test que el endpoint de vuelos responde correctamente
     */
    public function test_flights_index_route_exists_and_returns_json()
    {
        $response = $this->get('/api/flights');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count'
        ]);
    }

    /**
     * Test que el endpoint de vuelo específico responde correctamente
     */
    public function test_flights_show_route_exists()
    {
        // Probar con el primer vuelo que sabemos que existe: IB3201
        $response = $this->get('/api/flights/IB3201');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id_vuelo',
                'aerolinea',
                'tipo',
                'aeropuerto_id',
                'fecha',
                'hora',
                'estado',
                'pasajeros',
                'co2_estimado_kg'
            ]
        ]);
    }

    /**
     * Test que el endpoint de vuelo específico con ID numérico responde correctamente
     */
    public function test_flights_show_route_with_numeric_id()
    {
        // Probar con índice numérico (primer vuelo)
        $response = $this->get('/api/flights/1');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id_vuelo',
                'aerolinea',
                'tipo',
                'aeropuerto_id'
            ]
        ]);
    }

    /**
     * Test que el endpoint de vuelo inexistente retorna 404
     */
    public function test_flights_show_route_returns_404_for_nonexistent_flight()
    {
        $response = $this->get('/api/flights/INEXISTENTE999');
        
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'success',
            'message'
        ]);
    }

    /**
     * Test que el endpoint de aeropuertos responde correctamente
     */
    public function test_airports_route_exists_and_returns_json()
    {
        $response = $this->get('/api/airports');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count'
        ]);
    }

    /**
     * Test que el endpoint de vuelos por aeropuerto responde correctamente
     */
    public function test_flights_by_airport_route_exists()
    {
        // Probar con aeropuerto ID 1 (Madrid-Barajas)
        $response = $this->get('/api/flights/airport/1');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count',
            'airport_id'
        ]);
    }

    /**
     * Test que el endpoint de vuelos por fecha responde correctamente
     */
    public function test_flights_by_date_route_exists()
    {
        $response = $this->get('/api/flights/date/2025-10-15');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count',
            'date'
        ]);
    }

    /**
     * Test que el endpoint de vuelos por tipo responde correctamente
     */
    public function test_flights_by_type_route_exists()
    {
        $response = $this->get('/api/flights/type/salida');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count',
            'type'
        ]);
    }

    /**
     * Test que el endpoint de CO2 por aeropuerto responde correctamente
     */
    public function test_flights_co2_by_airport_route_exists()
    {
        $response = $this->get('/api/flights/co2/airport/1');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'airport_id',
                'total_co2_kg',
                'total_co2_tons',
                'total_flights',
                'average_co2_per_flight_kg'
            ]
        ]);
    }

    /**
     * Test que el endpoint de vuelos con mayor CO2 responde correctamente
     */
    public function test_flights_highest_co2_route_exists()
    {
        $response = $this->get('/api/flights/co2/highest');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count',
            'limit'
        ]);
    }

    /**
     * Test que el endpoint de vuelos con mayor CO2 con límite responde correctamente
     */
    public function test_flights_highest_co2_route_with_limit()
    {
        $response = $this->get('/api/flights/co2/highest?limit=5');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count',
            'limit'
        ]);
        
        $response->assertJson([
            'limit' => 5
        ]);
    }

    /**
     * Test que el endpoint de estadísticas responde correctamente
     */
    public function test_flights_statistics_route_exists()
    {
        $response = $this->get('/api/flights/statistics');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'json_statistics',
                'calculated_statistics' => [
                    'total_flights',
                    'total_airports',
                    'total_co2_kg',
                    'total_co2_tons',
                    'average_passengers_per_flight',
                    'average_co2_per_flight_kg'
                ]
            ]
        ]);
    }

    /**
     * Test que todas las rutas de vuelos usan el prefijo /api correctamente
     */
    public function test_all_flight_routes_use_api_prefix()
    {
        $routes = [
            '/api/flights',
            '/api/airports',
            '/api/flights/airport/1',
            '/api/flights/date/2025-10-15',
            '/api/flights/type/salida',
            '/api/flights/co2/airport/1',
            '/api/flights/co2/highest',
            '/api/flights/statistics'
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            
            // Todas las rutas deben responder con 200 (éxito)
            $response->assertStatus(200);
            
            // Todas las rutas deben retornar JSON con estructura básica
            $response->assertJsonStructure(['success']);
        }
    }
}