<?php

use App\Http\Controllers\PlaneController;
use App\Http\Controllers\FlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerritoryController;

// Health check endpoint for Render
Route::get('/health', [TerritoryController::class, 'health']);

// Rutas para territorios (sin autenticación)
Route::get('/territories', [TerritoryController::class, 'index']);
Route::get('/territories/pollution_analysis', [TerritoryController::class, 'getPollutionAnalysis']);
Route::get('/territories/{id}', [TerritoryController::class, 'show']);
Route::post('/territories', [TerritoryController::class, 'store']);

// Rutas para aviones
Route::get('/planes', [PlaneController::class, 'index']);
Route::get('/planes/{id}', [PlaneController::class, 'show']);
Route::post('/planes', [PlaneController::class, 'store']);

// Rutas para vuelos (desde JSON)
Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/statistics', [FlightController::class, 'getStatistics']);
Route::get('/flights/airport/{id}', [FlightController::class, 'getFlightsByAirport']);
Route::get('/flights/date/{date}', [FlightController::class, 'getFlightsByDate']);
Route::get('/flights/type/{type}', [FlightController::class, 'getFlightsByType']);
Route::get('/flights/co2/airport/{id}', [FlightController::class, 'getCO2ByAirport']);
Route::get('/flights/co2/highest', [FlightController::class, 'getHighestCO2Flights']);
Route::get('/flights/{id}', [FlightController::class, 'show']);
Route::get('/airports', [FlightController::class, 'getAirports']);

