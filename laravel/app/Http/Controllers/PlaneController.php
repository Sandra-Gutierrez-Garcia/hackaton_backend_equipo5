<?php

namespace App\Http\Controllers;

use App\Models\PlaneModel;
use Exception;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    public function index(){
        try{
            $planes = PlaneModel::all();
            return response()->json([
                'success' => true,
                'data' => $planes,
                'count' => $planes->count()
            ], 200);
        } catch(Exception $e){
            return response()->json([
                'message' => 'Error retrieving planes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id){
        try{
            $plane = PlaneModel::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $plane,
            ]);

        } catch(Exception $e){
            return response()->json([
                'message' => 'Plane not found',
                'error' => $e->getMessage()
            ], 404);
        }

        return response()->json([
            'message' => 'Details of plane ' . $id
        ]);
    }

    public function store(Request $request){
        try{
            $validated = $request->validate([
                'model' => 'required|string|max:100',
                'capacity' => 'required|integer|min:1',
                'range' => 'required|integer|min:1',
                'airport_id' => 'required|integer|exists:airports,id'
            ]);

            $plane = Planemodel::create($validated);

            $request = response()->json([
                'success' => true,
                'data' => $plane
            ], 201);
        } catch (Exception $e){
            return response()->json([
                'message' => 'Error creating plane',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // n movimientos entrada/salida.
    //En la salida, el despegue gasta un porcentaje de combustible
    //Cuanto Co2 emite 1L o 1 de fuel_capacity
    //calcular el porcentaje de combustible gastado en el despegue, multiplicar por co2 emitido por litro
    //sumar todos los movimientos de salida. 

    //El resultado es la contaminación emitida por los despegues de aviones en un aeropuerto.
    //En el territorio se suma, su nivel de polucion base + co2 emitido por las salidas de los aviones
}

