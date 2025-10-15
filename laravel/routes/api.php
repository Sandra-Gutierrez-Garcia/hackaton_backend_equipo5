<?php

namespace App\Http\Routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerritoryController;

Route::group(['prefix' => 'api'], function(){
    Route::get('/territory', [TerritoryController::class, 'show']);
    Route::post('/territory', [TerritoryController::class, 'store']);
});
