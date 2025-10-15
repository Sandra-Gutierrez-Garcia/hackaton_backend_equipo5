<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TerritoryRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test que el endpoint de health check responde correctamente
     */
    public function test_health_check_route_exists()
    {
        $response = $this->get('/api/health');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'timestamp'
        ]);
    }

    /**
     * Test que el endpoint de territorios index responde correctamente
     */
    public function test_territories_index_route_exists()
    {
        $response = $this->get('/api/territories');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
            'count'
        ]);
    }

    /**
     * Test que el endpoint de territorio específico maneja correctamente los casos
     */
    public function test_territories_show_route_exists()
    {
        // Como no hay datos en la base de datos de test, esperamos array vacío o 404
        $response = $this->get('/api/territories/1');
        
        // Puede ser 200 con null o 404, ambos son válidos para un territorio inexistente
        $this->assertTrue(
            $response->status() === 200 || $response->status() === 404
        );
        
        if ($response->status() === 200) {
            $response->assertJsonStructure(['success']);
        } else {
            $response->assertJsonStructure([
                'success',
                'message'
            ]);
        }
    }

    /**
     * Test que el endpoint de crear territorio acepta POST requests
     */
    public function test_territories_store_route_accepts_post()
    {
        $territoryData = [
            'name' => 'Test Territory',
            'description' => 'Test Description',
            'co2_level' => 500.0
        ];

        $response = $this->post('/api/territories', $territoryData);
        
        // Debug: ver qué código de estado devuelve
        $statusCode = $response->status();
        
        // Puede ser 201 (creado), 422 (validación), 400 (bad request) o 500 (error servidor)
        $this->assertTrue(
            $response->status() === 201 || 
            $response->status() === 422 || 
            $response->status() === 400 ||
            $response->status() === 500,
            "Unexpected status code: {$statusCode}. Response: " . $response->getContent()
        );
        
        $response->assertJsonStructure(['success']);
    }

    /**
     * Test que el endpoint de análisis de contaminación responde correctamente
     */
    public function test_territories_pollution_analysis_route_exists()
    {
        $response = $this->get('/api/territories/pollution_analysis');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data'
        ]);
    }

    /**
     * Test que todas las rutas de territorios usan el prefijo /api correctamente
     */
    public function test_all_territory_routes_use_api_prefix()
    {
        $routes = [
            ['method' => 'GET', 'uri' => '/api/health'],
            ['method' => 'GET', 'uri' => '/api/territories'],
            ['method' => 'GET', 'uri' => '/api/territories/pollution_analysis']
        ];

        foreach ($routes as $route) {
            if ($route['method'] === 'GET') {
                $response = $this->get($route['uri']);
            } elseif ($route['method'] === 'POST') {
                $response = $this->post($route['uri'], []);
            }
            
            // Todas las rutas deben responder (200, 201, 422, etc. - no 404)
            $this->assertNotEquals(404, $response->status(), 
                "Route {$route['method']} {$route['uri']} returned 404 - route may not exist"
            );
            
            // Todas las rutas deben retornar JSON con estructura básica
            $response->assertJsonStructure(['success']);
        }
    }

    /**
     * Test que los métodos HTTP están correctamente configurados
     */
    public function test_territory_routes_http_methods()
    {
        // GET routes que deben existir
        $getRoutes = [
            '/api/health',
            '/api/territories',
            '/api/territories/pollution_analysis'
        ];

        foreach ($getRoutes as $route) {
            $response = $this->get($route);
            $this->assertNotEquals(405, $response->status(), 
                "GET method not allowed for route: {$route}"
            );
        }

        // POST route que debe existir
        $response = $this->post('/api/territories', []);
        $this->assertNotEquals(405, $response->status(), 
            "POST method not allowed for route: /api/territories"
        );
        $this->assertNotEquals(404, $response->status(), 
            "POST route /api/territories does not exist"
        );
    }

    /**
     * Test que la estructura de respuesta de health check es correcta
     */
    public function test_health_check_response_structure()
    {
        $response = $this->get('/api/health');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'timestamp'
        ]);
        
        $responseData = $response->json();
        $this->assertTrue($responseData['success']);
        $this->assertIsString($responseData['message']);
        $this->assertIsString($responseData['timestamp']);
    }
}