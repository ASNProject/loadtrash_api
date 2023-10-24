<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debit;
use App\Customer;
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
        $debits = Debit::with('customer')->get();

        $data = [
            'message' => 'Get method debit',
            'data' => []
        ];

        foreach ($debits as $debit) {
            $data['data'][] = [
                'id' => $debit->id,
                'id_user' => $debit->id_user,
                'debit' => $debit->debit,
                'status_withdrawal' => $debit->status_withdrawal,
                'date_withdrawal' => $debit->date_withdrawal,
                'customer' => [
                    'id_user' => $debit->customer->id_user,
                    'name' => $debit->customer->name,
                    'password' => $debit->customer->password,
                    'address' => $debit->customer->address,
                    'id_number' => $debit->customer->id_number,
                    'registration' => $debit->customer->registration,
                    'id_status' => $debit->customer->id_status,
                    'id_load' => $debit->customer->id_load
                ]
            ];
        }

        return response()->json($data);
    }

    public function detail($id_user)
    {
        $debits = Debit::where('id_user', $id_user)->with('customer')->get();

        if ($debits->isNotEmpty()) {
            $data = [
                'message' => 'Get method debit',
                'data' => []
            ];

            foreach ($debits as $debit) {
                $data['data'][] = [
                    'id' => $debit->id,
                    'id_user' => $debit->id_user,
                    'debit' => $debit->debit,
                    'status_withdrawal' => $debit->status_withdrawal,
                    'date_withdrawal' => $debit->date_withdrawal,
                    'customer' => [
                        'id_user' => $debit->customer->id_user,
                        'name' => $debit->customer->name,
                        'password' => $debit->customer->password,
                        'address' => $debit->customer->address,
                        'id_number' => $debit->customer->id_number,
                        'registration' => $debit->customer->registration,
                        'id_status' => $debit->customer->id_status,
                        'id_load' => $debit->customer->id_load
                    ]
                ];
            }

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
