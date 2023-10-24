<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        $data = [
            'message' => 'Get method customer',
            'data' => []
        ];

        foreach ($customers as $customer) {
            $data['data'][] = [
                'id_user' => $customer->id_user,
                'name' => $customer->name,
                'password' => $customer->password,
                'address' => $customer->address,
                'id_number' => $customer->id_number,
                'registration' => $customer->registration,
                'id_status' => $customer->id_status,
                'id_load' => $customer->id_load ?? '',
                'status' => [
                    'id_status' => $customer->id_status,
                    'status' => ($customer->id_status == 1) ? 'admin' : 'customer'
                ]
            ];
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_user' => 'required',
            'name' => 'required',
            'password' => 'required',
            'address' => 'nullable',
            'id_number' => 'required',
            'id_status' => 'nullable',
            'id_load' => 'nullable',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->errors());
        } else {
            $customer = new Customer;
            $customer->id_user = $request->id_user;
            $customer->name = $request->name;
            $customer->password = $request->password;
            $customer->address = $request->address;
            $customer->id_number = $request->id_number;
            $customer->registration = $request->registration;
            $customer->id_status = $request->id_status;
            $customer->id_load = $request->id_load;

            if ($customer->save()) {
                return response()->json('Customer berhasil disimpan');
            } else {
                return response()->json('Customer gagal ditambahkan');
            }
        }
    }

    public function detail($id_user)
    {
        $customer = Customer::where('id_user', $id_user)->first();

        if ($customer) {
            $data = [
                'message' => 'Get method customer',
                'data' => [
                    [
                        'id_user' => $customer->id_user,
                        'name' => $customer->name,
                        'password' => $customer->password,
                        'address' => $customer->address,
                        'id_number' => $customer->id_number,
                        'registration' => $customer->registration,
                        'id_status' => $customer->id_status,
                        'id_load' => $customer->id_load ?? '',
                        // 'status' => [
                        //     'id_status' => $customer->id_status,
                        //     'status' => ($customer->id_status == 1) ? 'admin' : 'customer'
                        // ]
                    ]
                ]
            ];

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
