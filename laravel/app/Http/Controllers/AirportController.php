<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AirportController extends Controller
{
    //
    public function index(){
        try{
            return response()->json([
                'message' => 'list of airports',
                'data' => Airport::all()
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'message' => 'Error retrieving airports',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id){

        try{
            $aiport = Aiport::find($id);
            if(!$aiport){
                return response()->json([
                    'message' => 'Airport not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Airport found',
                'data' => $aiport
            ],200);

        } catch(\Exception $e){
            return response()->json([
                'message' => 'Error retrieving airports',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
