<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use App\Models\Salida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class informeController extends Controller
{
    public function index()
    {
        $informes = Informe::with(['entrada', 'salida'])->get();

        if (!$informes) {
            $data = [
                'message' => 'No se encontraron informes',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'informe' => $informes->map(function ($informe) {
                return [
                    'id' => $informe->id,
                    'entrada_id' => $informe->entrada ? [
                        'id' => $informe->entrada->id,
                        'producto' => $informe->entrada->producto ? [
                            'id' => $informe->entrada->producto->id,
                            'nombre' => $informe->entrada->producto->nombre,
                            'descripcion' => $informe->entrada->producto->descripcion,
                            'precio' => $informe->entrada->producto->precio,
                            'created_at' => $informe->entrada->producto->created_at,
                            'updated_at' => $informe->entrada->producto->updated_at,
                        ] : null,
                        'fecha_entrada' => $informe->entrada->fecha_entrada,
                        'cantidad' => $informe->entrada->cantidad,
                        'created_at' => $informe->entrada->created_at,
                        'updated_at' => $informe->entrada->updated_at,
                    ] : null,
                    'salida_id' => $informe->salida ? [
                        'id' => $informe->salida->id,
                        'producto' => $informe->salida->producto ? [
                            'id' => $informe->salida->producto->id,
                            'nombre' => $informe->salida->producto->nombre,
                            'descripcion' => $informe->salida->producto->descripcion,
                            'precio' => $informe->salida->producto->precio,
                            'created_at' => $informe->salida->producto->created_at,
                            'updated_at' => $informe->salida->producto->updated_at,
                        ] : null,
                        'fecha_salida' => $informe->salida->fecha_salida,
                        'motivo' => $informe->salida->motivo,
                        'cantidad' => $informe->salida->cantidad,
                        'created_at' => $informe->salida->created_at,
                        'updated_at' => $informe->salida->updated_at,
                    ] : null,
                    'fecha_informe' => $informe->fecha_informe,
                    'created_at' => $informe->created_at,
                    'updated_at' => $informe->updated_at,
                ];
            }),
            'status' => 200
        ];

        // $data = [
        //     'informe' => $informes->map(function ($informe) {
        //         return [
        //             'id' => $informe->id,
        //             'entrada_id' => $informe->entrada_id,
        //             'salida_id' => $informe->salida ? [
        //                 'id' => $informe->salida->id,
        //                 'producto_id' => $informe->salida->producto_id,
        //                 'fecha_salida' => $informe->salida->fecha_salida,
        //                 'motivo' => $informe->salida->motivo,
        //                 'cantidad' => $informe->salida->cantidad,
        //                 'created_at' => $informe->salida->created_at,
        //                 'updated_at' => $informe->salida->updated_at,
        //             ] : null,
        //             'fecha_informe' => $informe->fecha_informe,
        //             'created_at' => $informe->created_at,
        //             'updated_at' => $informe->updated_at,
        //         ];
        //     }),
        //     'status' => 200
        // ];    
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $informe = Informe::find($id);

        if (!$informe) {
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

        if ($validator->fails()) {
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

        if (!$informe) {
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

    public function destroy($id)
    {
        $informe = Informe::find($id);

        if (!$informe) {
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

        if (!$informe) {
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

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
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

        if (!$informe) {
            $data = [
                'message' => 'Informe no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if ($request->has('entrada_id')) {
            $informe->entrada_id = $request->entrada_id;
        }

        if ($request->has('salida_id')) {
            $informe->salida_id = $request->salida_id;
        }

        if ($request->has('fecha_informe')) {
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
