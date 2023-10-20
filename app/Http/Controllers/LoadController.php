<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use Illuminate\Support\Facades\Validator;

class LoadController extends Controller
{
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'code' => 'required',
            'password' => 'nullable',
            'value' => 'nullable',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->errors());
        } else {
            $load = new Load;
            $load->code = $request->code;
            $load->password = $request->password;
            $load->value = $request->value;

            if ($load->save()) {
                return response()->json('Load berhasil disimpan');
            } else {
                return response()->json('Load gagal ditambahkan');
            }
        }
    }

    public function index()
    {
        $loads = Load::all();

        $data = [
            'message' => 'Get method load',
            'data' => []
        ];

        foreach ($loads as $load) {
            $data['data'][] = [
                'code' => $load->code,
                'password' => $load->password,
                'value' => $load->value,
                'status' => [
                    'id_status' => $load->status, // Adjust to your actual status field name
                    'status' => $this->getStatusLabel($load->status) // Define the function to get the status label
                ]
            ];
        }

        return response()->json($data);
    }

    public function detail($code)
    {
        $load = Load::where('code', $code)->first();

        if ($load) {
            $data = [
                'message' => 'Get method load',
                'data' => [
                    [
                        'code' => $load->code,
                        'password' => $load->password,
                        'value' => $load->value,
                        'status' => [
                            'id_status' => $load->status, // Adjust to your actual status field name
                            'status' => $this->getStatusLabel($load->status) // Define the function to get the status label
                        ]
                    ]
                ]
            ];

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    // Add a function to get the status label based on the status ID
    private function getStatusLabel($statusId)
    {
        // Define your logic to retrieve status label based on status ID here
        return ($statusId == 1) ? 'admin' : 'customer';
    }
}
