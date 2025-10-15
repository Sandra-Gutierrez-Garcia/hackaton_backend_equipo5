<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerritoryController;

// Health check endpoint for Render
Route::get('/health', [TerritoryController::class, 'health']);

// Rutas para territorios (sin autenticación)
Route::get('/territories', [TerritoryController::class, 'index']);
Route::get('/territories/{id}', [TerritoryController::class, 'show']);
Route::post('/territories', [TerritoryController::class, 'store']);

