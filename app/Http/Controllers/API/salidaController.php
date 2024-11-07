<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salida;
use Illuminate\Support\Facades\Validator;

class salidaController extends Controller
{
    public function index()
    {
        $salida = Salida::all();

        if($salida->isEmpty())
        {
            $data = [
                'message' => 'No se encontraron salidas',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'salida' => $salida,
            'status' => 200
        ];
    
        return response()->json($data, 200);    
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'producto_id' => 'required',
        'fecha_salida' => 'required',
        'motivo' => 'required',
        'cantidad' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $salida = Salida::create([
            'producto_id' => $request->prducto_id,
            'fecha_salida' => $request->fecha_salida,
            'motivo' => $request->motivo,
            'cantidad' => $request->cantidad
        ]);

        if(!$salida){
            $data = [
                'message' => 'Error al crear el registro',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'salida' => $salida,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
}
