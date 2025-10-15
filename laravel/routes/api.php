<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\AirportController;

// Rutas para territorios (sin autenticación)
Route::get('/territories', [TerritoryController::class, 'index']);
Route::get('/territories/{id}', [TerritoryController::class, 'show']);
Route::post('/territories', [TerritoryController::class, 'store']);

// rutas AiportController

Route::get('/airports', [AirportController::class, 'index']);
Route::get('/airports/{id}', [AirportController::class, 'show']);
