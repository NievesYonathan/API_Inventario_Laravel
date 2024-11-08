<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class entradaController extends Controller
{
    public function index()
    {
        $entrada = Entrada::all();

        if(!$entrada)
        {
            $data = [
                'message' => 'No se encontraron entradas',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'entrada' => $entrada,
            'status' => 200
        ];
    
        return response()->json($data, 200);    
    }

    public function show($id)
    {
        $entrada = Entrada::find($id);

        if(!$entrada){
            $data = [
                'message' => 'Registro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'entrada' => $entrada,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'producto_id' => 'required',
        'fecha_entrada' => 'required',
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

        $entrada = Entrada::create([
            'producto_id' => $request->producto_id,
            'fecha_entrada' => $request->fecha_entrada,
            'cantidad' => $request->cantidad,
        ]);

        if(!$entrada){
            $data = [
                'message' => 'Error al crear el registro',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'entrada' => $entrada,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function destroy($id)
    {
        $entrada = Entrada::find($id);

        if(!$entrada){
            $data = [
                'message' => 'Registrto no encontrado',
                'status' => 404
            ]; 
            return response()->json($data, 404);
        }

        $entrada->delete();

        $data = [
            'message' => 'Registrto eliminado',
            'status' => 200
        ]; 

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $entrada = Entrada::find($id);

        if(!$entrada){
            $data = [
                'message' => 'Registrto no encontrado',
                'status' => 404
            ]; 
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'producto_id' => 'required',
            'fecha_entrada' => 'required',
            'cantidad' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $entrada->producto_id = $request->producto_id;
        $entrada->fecha_entrada = $request->fecha_entrada;
        $entrada->cantidad = $request->cantidad;

        $entrada->save();

        $data = [
            'message' => 'Registro actualizado',
            'entrada' => $entrada,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $entrada = Entrada::find($id);

        if(!$entrada){
            $data = [
                'message' => 'Registrto no encontrado',
                'status' => 404
            ]; 
            return response()->json($data, 404);
        }

        if ($request->has('producto_id')){
            $entrada->producto_id = $request->producto_id;
        }

        if ($request->has('fecha_entrada')){
            $entrada->fecha_entrada = $request->fecha_entrada;
        }

        if ($request->has('cantidad')){
            $entrada->cantidad = $request->cantidad;
        }
      
        $entrada->save();

        $data = [
            'message' => 'Registro actualizado',
            'entrada' => $entrada,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
