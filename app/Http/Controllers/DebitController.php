<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debit;
use Illuminate\Support\Facades\Validator;

class DebitController extends Controller
{
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_user' => 'required',
            'debit' => 'nullable',
            'status_withdrawal' => 'nullable',
            'date_withdrawal' => 'nullable',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->errors());
        } else {
            $debit = new Debit;
            $debit->id_user = $request->id_user;
            $debit->debit = $request->debit;
            $debit->status_withdrawal = $request->status_withdrawal;
            $debit->date_withdrawal = $request->date_withdrawal;

            if ($debit->save()) {
                return response()->json('Debit berhasil disimpan');
            } else {
                return response()->json('Debit gagal ditambahkan');
            }
        }
    }

    public function index()
    {
        $debits = Debit::all();

        $data = [
            'message' => 'Get method debit',
            'data' => []
        ];

        foreach ($debits as $debit) {
            $data['data'][] = [
                'id_user' => $debit->id_user,
                'debit' => $debit->debit,
                'status_withdrawal' => $debit->status_withdrawal,
                'date_withdrawal' => $debit->date_withdrawal,
                'status' => [
                    'id_status' => $debit->status_withdrawal,
                    'status' => ($debit->status_withdrawal == 'completed') ? 'completed' : 'pending'
                ]
            ];
        }

        return response()->json($data);
    }

    public function detail($id_user)
    {
        $debit = Debit::where('id_user', $id_user)->first();

        if ($debit) {
            $data = [
                'message' => 'Get method debit',
                'data' => [
                    [
                        'id_user' => $debit->id_user,
                        'debit' => $debit->debit,
                        'status_withdrawal' => $debit->status_withdrawal,
                        'date_withdrawal' => $debit->date_withdrawal,
                        'status' => [
                            'id_status' => $debit->status_withdrawal,
                            'status' => ($debit->status_withdrawal == 'completed') ? 'completed' : 'pending'
                        ]
                    ]
                ]
            ];

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
