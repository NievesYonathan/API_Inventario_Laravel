<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class informeController extends Controller
{
    public function index()
    {
        $informe = Informe::all();

        if($informe->isEmpty()){
            $data = [
                'message' => 'No se encontraron informes',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'informe' => $informe,
            'status' => 200
        ];
    
        return response()->json($data, 200);    
    }

    public function show($id)
    {
        $informe = Informe::find($id);

        if($informe->isEmpty()){
            $data = [
                'message' => 'No se encontro el informe',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'informe' => $informe,
            'status' => 200
        ];
    
        return response()->json($data, 200);    
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'entrada_id' => 'required',
            'salida_id' => 'required',
            'fecha_informe' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $informe = Informe::create([
            'entrada_id' => $request->entrada_id,
            'salida_id' => $request->salida_id,
            'fecha_informe' => $request->fecha_informe
        ]);

        if (!$informe){
            $data = [
                'message' => 'Error al crear el informe',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'informe' => $informe,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function destrtoy($id)
    {
        $informe = Informe::find($id);

        if (!$informe){
            $data = [
                'message' => 'Informe no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $informe->delete();

        $data = [
            'message' => 'Informe eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $informe = Informe::find($id);

        if(!$informe){
            $data = [
                'message' => 'Informe no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'entrada_id' => 'required',
            'salida_id' => 'required',
            'fecha_informe' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' =>'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $informe->entrada_id = $request->entrada_id;
        $informe->salida_id = $request->salida_id;
        $informe->fecha_informe = $request->fecha_informe;

        $informe->save();

        $data = [
            'message' => 'Informe actualizado',
            'informe' => $informe,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $informe = Informe::find($id);

        if(!$informe){
            $data = [
                'message' => 'Informe no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if($request->has('entrada_id')){
            $informe->entrada_id = $request->entrada_id;
        }

        if($request->has('entrada_id')){
            $informe->salida_id = $request->salida_id;
        }

        if($request->has('entrada_id')){
            $informe->fecha_informe = $request->fecha_informe;
        }

        $informe->save();

        $data = [
            'message' => 'Informe actualizado',
            'informe' => $informe,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
