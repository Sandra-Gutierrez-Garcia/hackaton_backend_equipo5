<?php

use App\Http\Controllers\PlaneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerritoryController;

// Health check endpoint for Render
Route::get('/health', [TerritoryController::class, 'health']);

// Rutas para territorios (sin autenticación)
Route::get('/territories', [TerritoryController::class, 'index']);
Route::get('/territories/{id}', [TerritoryController::class, 'show']);
Route::post('/territories', [TerritoryController::class, 'store']);
Route::get('/territories/pollution_analysis', [TerritoryController::class, 'getPollutionAnalysis']);

Route::get('/planes', [PlaneController::class, 'index']);
Route::get('/planes/{id}', [PlaneController::class, 'show']);
Route::post('/planes', [PlaneController::class, 'store']);

