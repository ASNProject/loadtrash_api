<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credit;
use App\Customer;
use App\TypeWaste;
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
            "message" => "Get method credit",
            "data" => []
        ];

        foreach ($credits as $credit) {
            // Load customer data for the credit
            $customer = Customer::where('id_user', $credit->id_user)->first();

            // Load type waste data for the credit
            $typeWaste = TypeWaste::where('id_type', $credit->id_type)->first();

            $data["data"][] = [
                "id" => $credit->id,
                "id_user" => $credit->id_user,
                "id_type" => $credit->id_type,
                "weight" => $credit->weight,
                "credit" => $credit->credit,
                "date_credit" => $credit->date_credit,
                "customer" => [
                    "id_user" => $customer->id_user,
                    "name" => $customer->name,
                    "password" => $customer->password,
                    "address" => $customer->address,
                    "id_number" => $customer->id_number,
                    "registration" => $customer->registration,
                    "id_status" => $customer->id_status,
                    "id_load" => $customer->id_load
                ],
                "type_waste" => [
                    "id_type" => $typeWaste->id_type,
                    "type" => $typeWaste->type,
                    "price" => $typeWaste->price
                ]
            ];
        }

        return response()->json($data);
    }

public function detail($id_user)
    {
        $credits = Credit::where('id_user', $id_user)->get();

        if ($credits->isNotEmpty()) {
            $data = [
                'message' => 'Get method credit',
                'data' => []
            ];

            foreach ($credits as $credit) {
                // Load customer data for the credit
                $customer = Customer::where('id_user', $credit->id_user)->first();

                // Load type waste data for the credit
                $typeWaste = TypeWaste::where('id_type', $credit->id_type)->first();

                $data['data'][] = [
                    'id' => $credit->id,
                    'id_user' => $credit->id_user,
                    'id_type' => $credit->id_type,
                    'weight' => $credit->weight,
                    'credit' => $credit->credit,
                    'date_credit' => $credit->date_credit,
                    'customer' => [
                        'id_user' => $customer->id_user,
                        'name' => $customer->name,
                        'password' => $customer->password,
                        'address' => $customer->address,
                        'id_number' => $customer->id_number,
                        'registration' => $customer->registration,
                        'id_status' => $customer->id_status,
                        'id_load' => $customer->id_load
                    ],
                    'type_waste' => [
                        'id_type' => $typeWaste->id_type,
                        'type' => $typeWaste->type,
                        'price' => $typeWaste->price
                    ]
                ];
            }

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

}
