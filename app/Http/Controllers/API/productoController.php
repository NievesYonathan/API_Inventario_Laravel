<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productoController extends Controller
{
    public function index()
    {
        $producto = Producto::all();

        if(!$producto)
        {
            $data = [
                'message' => 'No se encontraron productos',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'producto' => $producto,
            'status' => 200
        ];
    
        return response()->json($data, 200);    
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if(!$producto){
            $data = [
                'message' => 'Registro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'nombre' => 'required',
        'descripcion' => 'required',
        'precio' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
        ]);

        if(!$producto){
            $data = [
                'message' => 'Error al crear el registro',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'producto' => $producto,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if(!$producto){
            $data = [
                'message' => 'Registrto no encontrado',
                'status' => 404
            ]; 
            return response()->json($data, 404);
        }

        $producto->delete();

        $data = [
            'message' => 'Registrto eliminado',
            'status' => 200
        ]; 

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if(!$producto){
            $data = [
                'message' => 'Registrto no encontrado',
                'status' => 404
            ]; 
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;

        $producto->save();

        $data = [
            'message' => 'Registro actualizado',
            'producto' => $producto,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $producto = producto::find($id);

        if(!$producto){
            $data = [
                'message' => 'Registrto no encontrado',
                'status' => 404
            ]; 
            return response()->json($data, 404);
        }

        if ($request->has('nombre')){
            $producto->nombre = $request->nombre;
        }

        if ($request->has('descripcion')){
            $producto->descripcion = $request->descripcion;
        }

        if ($request->has('precio')){
            $producto->precio = $request->precio;
        }
      
        $producto->save();

        $data = [
            'message' => 'Registro actualizado',
            'producto' => $producto,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
