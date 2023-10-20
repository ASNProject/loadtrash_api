<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credit;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_type' => 'nullable',
            'weight' => 'nullable',
            'credit' => 'nullable',
            'date_credit' => 'nullable',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->errors());
        } else {
            $credit = new Credit;
            $credit->id_user = $request->id_user;
            $credit->id_type = $request->id_type;
            $credit->weight = $request->weight;
            $credit->credit = $request->credit;
            $credit->date_credit = $request->date_credit;

            if ($credit->save()) {
                return response()->json('Credit berhasil disimpan');
            } else {
                return response()->json('Credit gagal ditambahkan');
            }
        }
    }

    public function index()
    {
        $credits = Credit::all();

        $data = [
            'message' => 'Get method credit',
            'data' => []
        ];

        foreach ($credits as $credit) {
            $data['data'][] = [
                'id_user' => $credit->id_user,
                'id_type' => $credit->id_type,
                'weight' => $credit->weight,
                'credit' => $credit->credit,
                'date_credit' => $credit->date_credit,
            ];
        }

        return response()->json($data);
    }

    public function detail($id_user)
    {
        $credit = Credit::where('id_user', $id_user)->first();

        if ($credit) {
            $data = [
                'message' => 'Get method credit',
                'data' => [
                    [
                        'id_user' => $credit->id_user,
                        'id_type' => $credit->id_type,
                        'weight' => $credit->weight,
                        'credit' => $credit->credit,
                        'date_credit' => $credit->date_credit,
                    ]
                ]
            ];

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
