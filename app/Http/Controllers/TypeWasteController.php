<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeWaste;
use Illuminate\Support\Facades\Validator;

class TypeWasteController extends Controller
{
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_type' => 'required',
            'type' => 'nullable',
            'price' => 'nullable',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->errors());
        } else {
            $typeWaste = new TypeWaste;
            $typeWaste->id_type = $request->id_type;
            $typeWaste->type = $request->type;
            $typeWaste->price = $request->price;

            if ($typeWaste->save()) {
                return response()->json('TypeWaste berhasil disimpan');
            } else {
                return response()->json('TypeWaste gagal ditambahkan');
            }
        }
    }

    public function index()
    {
        $typeWastes = TypeWaste::all();

        $data = [
            'message' => 'Get method type waste',
            'data' => []
        ];

        foreach ($typeWastes as $typeWaste) {
            $data['data'][] = [
                'id_type' => $typeWaste->id_type,
                'type' => $typeWaste->type,
                'price' => $typeWaste->price,
            ];
        }

        return response()->json($data);
    }

    public function detail($id_type)
    {
        $typeWaste = TypeWaste::where('id_type', $id_type)->first();

        if ($typeWaste) {
            $data = [
                'message' => 'Get method type waste',
                'data' => [
                    [
                        'id_type' => $typeWaste->id_type,
                        'type' => $typeWaste->type,
                        'price' => $typeWaste->price,
                    ]
                ]
            ];

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
